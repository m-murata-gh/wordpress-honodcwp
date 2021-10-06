<?php
/**
 * common/controller
 *
 * include/common/controller.php
 */

// settings
require_once __DIR__ . '/conf/settings.php';

// IE
$ua = $_SERVER['HTTP_USER_AGENT'];
if (stristr($ua, 'Trident') || stristr($ua, 'MSIE')) {
echo <<<HTML
<p><strong>このサイトはInternet Explorerに対応していません。<br>
Edge、Safari、Google Chrome、Firefoxなどのモダンブラウザでご覧ください。</strong></p>
HTML;
  exit();
}
