<?php

class TableMaker
{
  protected $dispCols;
  protected $pageCt;
  public $timeTable;

  public function __construct(array $dispCols, int $pageCt, array $timeTable)
  {
    $this->dispCols = $dispCols;
    $this->pageCt = $pageCt;
    $this->timeTable = $timeTable;
  }

  // 前の1週間へのリンク
  public function prevLink(): string 
  {
    $pageCt = $this->pageCt;
    if ($pageCt === 0) {
      $str = "<div class=\"link-button link-button--off\"><span class=\"prev\">前の1週間へ</span></div><!-- /.link-button -->";
    } else {
      $pageCt--;
      $URL = URL_RSV_INDEX;
      $query = "?req=schedule";
      $query .= "&page_ct={$pageCt}";
      $URL .= $query;
      $str = "<div class=\"link-button\"><a href=\"{$URL}\" class=\"prev\">前の1週間へ</a></div><!-- /.link-button -->";
    }
    return $str;
  }

  // 次の1週間へのリンク
  public function nextLink(): string
  {
    $pageCt = $this->pageCt;
    if ($pageCt === MAX_PAGE_COUNT) {
      $str = "<div class=\"link-button link-button--off\"><span class=\"next\">次の1週間へ</span></div><!-- /.link-button -->"
      ;
    } else {
      $pageCt++;
      $URL = URL_RSV_INDEX;
      $query = "?req=schedule";
      $query .= "&page_ct={$pageCt}";
      $URL .= $query;
      $str = "<div class=\"link-button\"><a href=\"{$URL}\" class=\"next\">次の1週間へ</a></div><!-- /.link-button -->";
    }
    return $str;
  }

  // <th> 月の表示
  public function thMonth(): void
  {
    $dispCols = $this->dispCols;
    $ct = count($dispCols) -1;
    // colspanの計算
    $colspan = 1;
    for ($i = 0; $i <= $ct; $i++) {
      $dateObj = clone $dispCols[$i]->dateObj;
      $compDateObj = clone $dispCols[$i]->dateObj;
      $compDateObj = $compDateObj->modify('+1 day');
      $month = intval($dateObj->format('m'));
      $compMonth = intval($compDateObj->format('m'));
      if (($month !== $compMonth) || ($i === 6)) {
        $innerHTML = $dateObj->format('Y年n月');
        // HTMLを表示
        echo  <<<HTML
<th colspan="{$colspan}">{$innerHTML}
HTML;
        $colspan = 1;
        continue;
      }
      $colspan++;
    }
    return;
  }

  // <th> 日にちと曜日の表示
  public function thDay(): void
  {
    $dispCols = $this->dispCols;
    $ct = count($dispCols) -1;
    for ($i = 0; $i <= $ct; $i++) {
      $dateObj = clone $dispCols[$i]->dateObj;

      // 日にち設定
      $day = $dateObj->format('j');
      // 曜日,祝日設定
      $weekNum = intval($dateObj->format('w'));
      $week = convJpnWeek($weekNum);
      $arr = [];
      $arr = ['sun', '', '', '', '', '', 'sat'];
      $class = $arr[$weekNum];
      if ($dispCols[$i]->isPublicHoliday) {
        $week = '祝';
        $class = 'pub-hol';
      }
      $innerHTML = $day;
      $innerHTML .= "<br>";
      $innerHTML .= "(";
      $innerHTML .= $week;
      $innerHTML .= ")";
      // 曜日クラス設定
      $classHTML = '';
      if ($class) {
        $classHTML = " class=\"{$class}\"";
      }
      // HTMLを表示
      echo  <<<HTML
<th{$classHTML}>{$innerHTML}
HTML;
    }
    return;
  }

  // <tr><td> 予約時間の表示
  public function trThTimeTable(): void
  {
    $timeTable = $this->timeTable;
    $ct = count($timeTable) -1;
    for ($i = 0; $i <= $ct; $i++) {
      $innerHTML = $timeTable[$i];
      // HTMLを表示
      echo  <<<HTML
<tr><th>{$innerHTML}
HTML;
    }
    return;
  }

  // <tr><td> 予約ステータスの表示
  protected static $colCt = 0; // trTdStatus()の呼び出し回数をカウント

  public function trTdStatus(): void
  {
    $dispCols = $this->dispCols;
    $dateObj = clone $dispCols[self::$colCt]->dateObj;
    $records = $dispCols[self::$colCt]->records; // *
    $ct = count($records) -1;
    for ($i = 0; $i <= $ct; $i++) {
      $innerHTML = convDispStatus($records[$i]['display_status']);

      if ($records[$i]['display_status'] === 'allowed') {
        $rsvDate = $dateObj->format('Ymd');
        $rsvTime = new DateTime($records[$i]['display_time']);
        $rsvTime = $rsvTime->format('Hi');
        $rsvTime = str_replace(':', '', $rsvTime);
        $URL = URL_RSV_INDEX;
        $query = "?req=form";
        $query .= "&rsv_datetime={$rsvDate}{$rsvTime}";
        $URL .= $query;
        // HTMLを表示
        echo  <<<HTML
<tr><td class ="on-cell"><a href="{$URL}">{$innerHTML}</a>
HTML;
      } else {
      // HTMLを表示
      echo  <<<HTML
<tr><td class ="off-cell">{$innerHTML}
HTML;
      }
    }
    self::$colCt++;
    return;
  }
}
