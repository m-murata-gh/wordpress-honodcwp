<?php

// rsv-settings
require_once __DIR__ . '/../conf/rsv-settings.php';

// 不正アクセスチェック
accessFileCheck();

// パラメータがあればページ番号を設定
$pageCt = intval($_GET['page_ct'] ?? 0);

// 表示する日付オブジェクト(7日間)を設定
$todayObj = new DateTime();
$startDayObj = clone $todayObj->modify('+1 day');
$dispDate = [];
$dispDate = setDispDate($startDayObj, $pageCt);

// 予約時間(9:30,10:00,10:30,...,19:30)を設定
$timeTable = [];
$timeTable = setTimeTable();

// DB接続開始
$dbh = connectDB();

// DBデータ取得
$dispCols = [];
for ($i = 0; $i <= 6; $i++) {
  // DispColインスタンスを作成
  $dispCols[$i] = new DispCol($dbh, $dispDate[$i], $timeTable);
  // レコードを取得
  $dispCols[$i]->getRecords($dbh);

// DEBUG
// echo '<pre>';
// print_r($dispCols[$i]->records);
// echo '<pre>';

}

// DB接続解除
$dbh = null;

// TableMakerインスタンスを作成
$tableMaker = new TableMaker($dispCols, $pageCt, $timeTable);

// rsvラッパー開始
showRsvHeader();

// 予約フォームの表示
showTable($tableMaker);

// rsvラッパー終了
showRsvFooter();
