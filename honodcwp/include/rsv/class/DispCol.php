<?php

/**
 * 表示する列データのクラス
 *
 * 1日分の列のDateObjectやtimeTableなどのデータを格納する
 * DBから1日分の列データを取得する(データがDBにない場合は新規に挿入する)
 */

class DispCol
{
  protected $dbh;
  public $dateObj;
  protected $timeTable;
  public $isPublicHoliday;
  public $isPrivateHoliday;
  public $timeTableType;
  public $status;
  public $records = [];

  public function __construct(PDO $dbh, DateTime $dateObj, array $timeTable)
  {
    $this->dbh = $dbh;
    $this->dateObj = $dateObj;
    $this->timeTable = $timeTable;
    $this->isPublicHoliday = isPublicHoliday($dbh, $dateObj);
    $this->isPrivateHoliday = isPrivateHoliday($dbh, $dateObj);
    $this->timeTableType = $this->getTimeTableType($dateObj, $timeTable);
    $this->status = $this->getStatus($this->timeTableType, $timeTable);
  }

  // TimeTableTypeの取得(closed, full_open, pmshort_open)
  protected function getTimeTableType(DateTime $dateObj, array $timeTable): string
  {
    $type = null;
    if ($this->isPublicHoliday || $this->isPrivateHoliday) {
      // 祝日または私的休日
      $type = 'closed';
    } else {
      // 平日...曜日によって判定 (日0月1火2水3木4金5土6)
      switch ($dateObj->format('w')) {
        case 0: // 日
        case 3: // 水
          $type = 'closed';
          break;
        case 1: // 月
        case 4: // 木
          $type = 'full_open';
          break;
        case 2: // 火
        case 5: // 金
        case 6: // 土
          $type = 'pmshort_open';
          break;
        default:
          $type = null;
          break;
      }
    }
    return $type;
  }

  // statusの取得($status{['time']['status']})
  protected function getStatus(string $timeTableType, array $timeTable): array
  {
    // closed
    // full_open 9:30-20:00
    // pmshort_open 9:30-18:00
    //
    // 0	9:30
    // 1	10:00
    // 2	10:30
    // 3	11:00
    // 4	11:30
    // 5	12:00 closed
    // 6	12:30 closed
    // 7	13:00 closed
    // 8	13:30 closed
    // 9	14:00
    // 10	14:30
    // 11	15:00
    // 12	15:30
    // 13	16:00
    // 14	16:30
    // 15	17:00
    // 16	17:30
    // 17	18:00 closed(*pmshort_open)
    // 18	18:30 closed(*pmshort_open)
    // 19	19:00 closed(*pmshort_open)
    // 20	19:30 closed(*pmshort_open)
    //
    // 〇...allowed, ×...disallowed, 休診...closed

    // TimeTableTypeによってステータスを格納
    $arr = [];
    switch ($timeTableType) {
      case 'closed':
       for ($i = 0; $i <= 20; $i++) {
         $arr[$i]['time'] = $timeTable[$i];
         $arr[$i]['status'] = 'closed';
       }
       break;
      case 'full_open':
        for ($i = 0; $i <= 4; $i++) {
          $arr[$i]['time'] = $timeTable[$i];
          $arr[$i]['status'] = 'allowed';
        }
        for ($i = 5; $i <= 8; $i++) {
          $arr[$i]['time'] = $timeTable[$i];
          $arr[$i]['status'] = 'closed';
        }
        for ($i = 9; $i <= 20; $i++) {
          $arr[$i]['time'] = $timeTable[$i];
          $arr[$i]['status'] = 'allowed';
        }
      break;
     case 'pmshort_open':
       for ($i = 0; $i <= 4; $i++) {
         $arr[$i]['time'] = $timeTable[$i];
         $arr[$i]['status'] = 'allowed';
       }
       for ($i = 5; $i <= 8; $i++) {
         $arr[$i]['time'] = $timeTable[$i];
         $arr[$i]['status'] = 'closed';
       }
       for ($i = 9; $i <= 16; $i++) {
         $arr[$i]['time'] = $timeTable[$i];
         $arr[$i]['status'] = 'allowed';
       }
       for ($i = 17; $i <= 20; $i++) {
         $arr[$i]['time'] = $timeTable[$i];
         $arr[$i]['status'] = 'closed';
       }
       break;
    }
    return $arr;
  }

  // レコードの取得と、DispColインスタンスにレコードを保存
  public function getRecords(PDO $dbh): void
  {
    $arr = [];
    // sql内で使用する変数を設定
    $inSqlTableName = 'reserve';
    $inSqlDisplayDate = $this->dateObj->format('Y-m-d');
    $inSqlDisplayTime = [];
    $inSqlDisplayStatus = [];
    $inSqlUpdateTime = date('Y-m-d H:i:s');
    $statusCt = count($this->status);
    for ($j = 0; $j <= $statusCt - 1; $j++) {
      $inSqlDisplayTime[$j] = $this->status[$j]['time'];
      $inSqlDisplayStatus[$j] = $this->status[$j]['status'];
    }

    for ($j = 0; $j <= $statusCt - 1; $j++) {
      // 該当日付の各予約時間のレコードを取得
      $sqlSelect = "
        SELECT *
        FROM $inSqlTableName
        WHERE display_date = '$inSqlDisplayDate'
          AND display_time = '$inSqlDisplayTime[$j]'
      ";
      $sthSelect = $dbh->prepare($sqlSelect);
      $sthSelect->execute();
      $resultSelect = $sthSelect->fetchAll();

      $ct = count($resultSelect);
      switch ($ct) {
        case 1: // レコードが重複なく存在
          break;
        case 0: // レコードが存在しない
        // 該当日付の各予約時間のレコードを挿入
          $sqlInsert = "
            INSERT INTO $inSqlTableName (
              display_date,
              display_time,
              display_status,
              update_time
            )
            SELECT *
            FROM ( SELECT
              '$inSqlDisplayDate',
              '$inSqlDisplayTime[$j]',
              '$inSqlDisplayStatus[$j]',
              '$inSqlUpdateTime'
            )
            AS TMP
            WHERE NOT EXISTS (
              SELECT display_date
              FROM $inSqlTableName
              WHERE display_date = '$inSqlDisplayDate'
                AND display_time = '$inSqlDisplayTime[$j]'
            )
          ";
          $sthInsert = $dbh->prepare($sqlInsert);
          $sthInsert->execute();
          $sthSelect->execute();
          $resultSelect = $sthSelect->fetchAll();
          break;
        default: // レコードが重複して存在している
          throw new Exception('レコードの重複エラー。');
      }
      $arr[$j] = (array)$resultSelect[0] ?? ''; // レコードのオブジェクトを配列に変換して格納
    }
    $this->records = $arr; // DispColインスタンスにレコードを保存
  }
}
