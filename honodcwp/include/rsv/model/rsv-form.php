<?php

// rsv-settings
require_once __DIR__ . '/../conf/rsv-settings.php';

// 不正アクセスチェック
accessFileCheck();
if (validateRsvDatetime()) {
  // DateTimeオブジェクトの作成
  $dateObj = new DateTime($_GET['rsv_datetime']);

  // DB接続開始
  $dbh = connectDB();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validateInput();
    // DispSpotオブジェクトの作成
    $dispSpot = new DispSpot($dbh, $dateObj, $_POST);
    $dispSpot->setSESSION();
  } else {
    // DispSpotオブジェクトの作成
    $dispSpot = new DispSpot($dbh, $dateObj, $_POST);
    // 入力エラー変数の初期化
    $_SESSION['inputErr'] = [];
  }

  // 表示
  // 表示内容の判定
  switch ($_POST['show'] ?? '') {
    case '':
    case 'input':
      showInput($dispSpot);
      break;
    case 'confirm':
      accessPostCheck();
      if (! $_SESSION['inputErr']) {
        showConfirm($dispSpot);
      } else {
        showInput($dispSpot);
      }
      break;
    case 'executed':
      accessPostCheck();
      try {
        if ($dispSpot->updateRecord($dbh)) { // 更新成功
          showExecuted($dispSpot);
        }
      } catch (Exception $e) { // 更新失敗
        showErr('ご予約に失敗しました。<br>' . $e->getMessage());
      } finally {
        // DB接続解除
        $dbh = null;
      }
      break;
  }

 return;
}
