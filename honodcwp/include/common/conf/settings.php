<?php

/**
 * 環境設定
 */
// dev= 0, prod = 1
const ENV = 0;

/**
 * timezone
 */
date_default_timezone_set('Asia/Tokyo');

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

// URL設定(各ページのリンク用)
// $GLOBALS['root'] = $root;
$GLOBALS['wproot'] = $wproot;
// トップページ
$GLOBALS['urlIndex'] = $wphome;
// お知らせ
$GLOBALS['urlNews'] = $wphome . 'news/';
  // // #article1
  // $GLOBALS['urlNewsArticle1'] = $wproot . 'news/#article1';
  // // #article2
  // $GLOBALS['urlNewsArticle2'] = $wproot . 'news/#article2';
  // // #article3
  // $GLOBALS['urlNewsArticle3'] = $wproot . 'news/#article3';
// ご挨拶
$GLOBALS['urlGreeting'] = $wphome . '#greeting';
// 診療科目
$GLOBALS['urlMedical'] = $wphome . 'medical/';
  // #article1
  $GLOBALS['urlMedicalArticle1'] = $wphome . 'medical/#article1';
  // #article2
  $GLOBALS['urlMedicalArticle2'] = $wphome . 'medical/#article2';
  // #article3
  $GLOBALS['urlMedicalArticle3'] = $wphome . 'medical/#article3';
  // #article4
  $GLOBALS['urlMedicalArticle4'] = $wphome . 'medical/#article4';
  // #article5
  $GLOBALS['urlMedicalArticle5'] = $wphome . 'medical/#article5';
// 医院紹介
$GLOBALS['urlClinic'] = $wphome . 'clinic/';
  // #article1
  $GLOBALS['urlClinicArticle1'] = $wphome . 'clinic/#article1';
  // #article2
  $GLOBALS['urlClinicArticle2'] = $wphome . 'clinic/#article2';
  // #article3
  $GLOBALS['urlClinicArticle3'] = $wphome . 'clinic/#article3';
// アクセス
$GLOBALS['urlAccess'] = $wphome . '#access';
// Web予約
$GLOBALS['urlReserve'] = $wphome . 'reserve/';

// 関数呼び出し
// ヘッダー
require_once __DIR__ . '/../../../include/common/view/show-header.php';
// フッター
require_once __DIR__ . '/../../../include/common/view/show-footer.php';
