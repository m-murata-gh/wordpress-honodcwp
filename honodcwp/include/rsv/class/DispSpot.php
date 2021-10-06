<?php

/**
 * 表示する予約枠データのクラス
 *
 * 1予約枠分のREQUESTデータやPOSTデータ,DateObjectなどを格納する
 * 予約→DBレコードを更新する
 */

class DispSpot
{
  protected $dbh;
  public $dateObj;
  public $httpPost;
  public $rsvDatetime; // URLパラメータ用202106210930
  public $dispDateWeekTime; // 2021年6月21日(月)  9:30
  public $records = [];

  public function __construct(PDO $dbh, DateTime $dateObj, array $httpPost)
  {
    $this->dbh = $dbh;
    $this->dateObj = $dateObj;
    $this->httpPost = $httpPost;
    $this->rsvDatetime = $this->dateObj->format('YmdHi');
    $this->dispDateWeekTime = $this->dispDateWeekTime();
  }

  /**
   * dateObjの予約日時を画面表示用の文字列に変換する関数
   *
   * dateObjの値を画面表示用の文字列に変換して返す。
   * 例: 202106210930  →  2021年6月21日(月)  9:30
   */

  protected function dispDateWeekTime(): string
  {
    $dateObj = clone $this->dateObj;
    $dispDate = $dateObj->format('Y年n月j日');
    $dispWeek = '(' . convJpnWeek($dateObj->format('w')) . ')';
    $dispTime = $dateObj->format('G:i');
    $dispDateWeekTime = $dispDate . $dispWeek . '<span class="disp-time">' . $dispTime . '</span>';

    return $dispDateWeekTime;
  }

  // 入力内容をセッション変数に保存
  public function setSESSION(): void
  {
    // 来院日時
    $_SESSION['dispDateWeekTime']
      = $this->dispDateWeekTime;
    // 区分
    $_SESSION['inputHold']['pati-type']
      = $this->httpPost['pati-type'] ?? '';
    // 診察券番号
    $_SESSION['inputHold']['pati-id']
      = $this->httpPost['pati-id'] ?? '';
    // お名前
    $_SESSION['inputHold']['pati-name']
      = $this->httpPost['pati-name'] ?? '';
    // 電話番号
    $_SESSION['inputHold']['pati-phone']
      = $this->httpPost['pati-phone'] ?? '';
    // メールアドレス
    $_SESSION['inputHold']['pati-mail']
      = $this->httpPost['pati-mail'] ?? '';
    return;
  }

  // レコードの更新 成功したらT、失敗したらFを返す。
  public function updateRecord(PDO $dbh): bool
  {
    // sql内で使用する変数を設定
    $inSqlTableName = 'reserve';
    $inSqlDisplayDate = $this->dateObj->format('Y-m-d');
    $inSqlDisplayTime = $this->dateObj->format('H:i');
    $inSqlUpdateTime = date('Y-m-d H:i:s');
    $inSqlPatiType = $this->httpPost['pati-type'];
    $inSqlPatiId = $this->httpPost['pati-id'];
    $inSqlPatiName = $this->httpPost['pati-name'];
    $inSqlPatiPhone = $this->httpPost['pati-phone'];
    $inSqlPatiMail = $this->httpPost['pati-mail'];

    // SELECT
    $sqlSelect = "
      SELECT display_date
      FROM $inSqlTableName
      WHERE display_date = '$inSqlDisplayDate'
        AND display_time = '$inSqlDisplayTime'
    ";

    // UPDATE
    $sqlUpdate = "
      UPDATE $inSqlTableName
      SET
        display_status = 'disallowed',
        update_time = '$inSqlUpdateTime',
        patient_type = '$inSqlPatiType',
        patient_id = '$inSqlPatiId',
        patient_name = '$inSqlPatiName',
        patient_phone = '$inSqlPatiPhone',
        patient_mail = '$inSqlPatiMail'
      WHERE display_date = '$inSqlDisplayDate'
        AND display_time = '$inSqlDisplayTime'
        AND display_status = 'allowed'
    ";

    // 該当日付の各予約時間のレコードを取得
    $sthSelect = $dbh->prepare($sqlSelect);
    $sthSelect->execute();
    $resultSelect = $sthSelect->fetchAll();

    $ct = count($resultSelect);
    switch ($ct) {
      case 1:  // レコードが重複なく存在
        // レコードを予約済みに更新
        $sthUpdate = $dbh->prepare($sqlUpdate);
        $sthUpdate->execute();
        if ($sthUpdate->rowCount() === 1) { // 更新成功
          return true;
        } else { // 更新失敗
          throw new Exception('レコードの更新エラー。');
          return false;
        }
        break;
      case 0: // レコードが存在しない
        throw new Exception('レコードの不存在エラー。');
        return false;
        break;
      default: // レコードが重複して存在している
        throw new Exception('レコードの重複エラー。');
        return false;
    }
  }
}
