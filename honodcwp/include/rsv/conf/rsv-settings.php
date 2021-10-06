<?php

// common-settings
require_once __DIR__ . '/../../../include/common/conf/settings.php';

/**
 * 環境設定
 */
// dev= 0, prod = 1
// const ENV = 0;
// common/conf/settings.phpで設定済み

/**
 * timezone
 */
// date_default_timezone_set('Asia/Tokyo');
// common/conf/settings.phpで設定済み

/**
 * url変数
 */
// if (ENV) {
//   // prod
//   $root = 'https://honodc.murata2021.website/';
// } else {
//   // dev
//   $root = 'http://localhost/honodc/public/';
// }
// WordPress
$wproot = get_template_directory_uri() . '/';
$wphome = home_url() . '/';

// URL設定
const URL_RSV_INDEX = ''; // <- 相対URL
$GLOBALS['rsv']['url']['backrsv'] = $wphome . 'reserve/'; // エラー時、予約画面トップに戻るボタンのURL
$GLOBALS['rsv']['url']['backroot'] = $wphome; // 予約完了後、ホームに戻るボタンのURL

// URLパラpage_ctの最大値設定
const MAX_PAGE_COUNT = 11;

// DB設定
if (ENV) {
  // prod
  $GLOBALS['rsv']['db']['host'] = 'host';
  $GLOBALS['rsv']['db']['name'] = 'name';
  $GLOBALS['rsv']['db']['username'] = 'username';
  $GLOBALS['rsv']['db']['pass'] = 'pass';
} else {
  // dev
  $GLOBALS['rsv']['db']['host'] = 'host';
  $GLOBALS['rsv']['db']['name'] = 'name';
  $GLOBALS['rsv']['db']['username'] = 'username';
  $GLOBALS['rsv']['db']['pass'] = 'pass';
}

// 関数呼び出し
require_once __DIR__ . '/../model/my-functions.php';
require_once __DIR__ . '/../view/show-rsv-header.php';
require_once __DIR__ . '/../view/show-rsv-footer.php';
require_once __DIR__ . '/../view/show-err.php';
require_once __DIR__ . '/../view/show-table.php';
require_once __DIR__ . '/../view/show-input.php';
require_once __DIR__ . '/../view/show-confirm.php';
require_once __DIR__ . '/../view/show-executed.php';

// クラス呼び出し
require_once __DIR__ . '/../class/DispCol.php';
require_once __DIR__ . '/../class/TableMaker.php';
require_once __DIR__ . '/../class/DispSpot.php';
