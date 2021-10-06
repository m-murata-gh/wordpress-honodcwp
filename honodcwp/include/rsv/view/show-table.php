<?php

function showTable(TableMaker $tableMaker): void {

// スケジュール
echo <<<HTML
<div class="rsv-schedule">
HTML;

// タイトル部分
echo <<<HTML
<div class="rsv-title rsv-schedule__rsv-title">
<h3>ご予約日時選択</h3>
<p>明日以降、約3か月先までのご予約が可能です。</p>
</div><!-- /.rsv-title -->
HTML;

// スケジュール部分開始
echo <<<HTML
<div class="rsv-contents-wrapper">
HTML;
// スケジュールの週リンク部分
// 前の1週間へのリンク
echo <<<HTML
<div class="rsv-weeklink rsv-schedule__rsv-weeklink">
HTML;
// 前の1週間へのリンク
echo $tableMaker->prevLink();
// 次の1週間へのリンク
echo $tableMaker->nextLink();
echo <<<HTML
</div><!-- /.rsv-weeklink -->
HTML;

// スケジュールのカレンダー部分
echo <<<HTML
<div class="rsv-calendar rsv-schedule__rsv-calendar">
HTML;
// table始まり
echo <<<HTML
<table>
HTML;

// thead始まり
// thead1行目
echo <<<HTML
<thead>
  <tr>
    <th rowspan="2">
HTML;
// <th> 月の表示
$tableMaker->thMonth();

// thead2行目
echo <<<HTML
  <tr>
HTML;
// <th> 日にち,曜日,祝日の表示
$tableMaker->thDay();

// thead終わり
echo <<<HTML
</thead>
HTML;

// tbody始まり
// tbody1行目-1列目
echo <<<HTML
<tbody>
  <tr>
    <th>
      <table class="rsv-calendar__time-table">
        <tbody>
HTML;
// <tr><th> 予約時間の表示
echo $tableMaker->trThTimeTable();
echo <<<HTML
        </tbody>
      </table>
HTML;

// tbody1行目-2~8列目(1~7日目)
for ($colCt = 0; $colCt <= 6; $colCt++) {
  echo <<<HTML
    <td>
      <table class="rsv-calendar__status-table">
        <tbody>
HTML;
// <tr><td> 予約ステータスの表示
echo $tableMaker->trTdStatus();
echo <<<HTML
        </tbody>
      </table>
HTML;
}

// tbody,table終わり
echo <<<HTML
  </tbody>
</table>
</div><!-- /.rsv-calendar -->
</div><!-- /.rsv-contents-wrapper -->
</div><!-- /.rsv-schedule -->
HTML;

return;
}
