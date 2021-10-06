<?php
/**
 * rsv/rsv-controller
 *
 * public/reserve/index.php <- include/rsv/controller.php
 */

// rsv-settings
require_once __DIR__ . '/conf/rsv-settings.php';

// IE
$ua = $_SERVER['HTTP_USER_AGENT'];
if (stristr($ua, 'Trident') || stristr($ua, 'MSIE')) {
echo <<<HTML
<p><strong>このサイトはInternet Explorerに対応していません。<br>
Edge、Safari、Google Chrome、Firefoxなどのモダンブラウザでご覧ください。</strong></p>
HTML;
  exit();
}

// session
iniSession();
session_start();

// アクセス許可フラグを立てる
$_SESSION['access_file_flg'] = 1;

// ページヘッダーの表示
// showHeader('Web予約');
get_header();

// rsvラッパー開始
showRsvHeader();

echo <<<HTML
<main>
  <section>
    <header class="page-title structure--no-padding">
      <div class="inner--wide">
        <div class="heading heading--pagetitle heading--reserve-pagetitle articles__heading"><h2 class="heading__txt">Web予約</h2></div>
        <!-- /.heading -->
      </div><!-- /.inner--wide -->
    </header><!-- /.structure -->

    <aside class="page-breadcrumbs structure">
      <div class="inner">
        <ul class="breadcrumbs articles__breadcrumbs">
          <li class="before-icon--house"><a href="{$GLOBALS['urlIndex']}">ホーム</a></li>
          <li><a href="{$GLOBALS['urlReserve']}">Web予約</a></li>
        </ul>
      </div><!-- /.inner -->
    </aside><!-- /.structure -->

    <div class="page-section structure">
      <div class="inner">
HTML;

// 表示ページの判定
try {
  if (count($_REQUEST) === 0) {
    $req = 'schedule';
  } else { // reqクエリあり、または不正なクエリ
    $req = $_REQUEST['req'] ?? 'error';
    if ($req === 'schedule') {
      // パラメータがあればページ番号を設定
      $pageCt = intval($_GET['page_ct'] ?? 0);
      // $_GET['page_ct']が予約可能期間内でない場合->不正なクエリ
      if ($pageCt > MAX_PAGE_COUNT) {
        $req = 'error';
      }
    }
  }
  switch ($req) {
    case 'schedule':
      $rsvFile = __DIR__ . '/model/rsv-schedule.php';
      break;
    case 'form':
      $rsvFile = __DIR__ . '/model/rsv-form.php';
      break;
    case 'error': // 不正なクエリ
    default:
      throw new Exception('ページが存在しません。');
  }

  // 予約システムの表示
  include $rsvFile;

} catch (Exception $e) {
  showErr($e->getMessage());
} finally {

// rsvラッパー終了
showRsvFooter();

echo <<<HTML
      </div><!-- /.inner -->
    </div><!-- /.structure -->

  </section>
</main>
HTML;

  // ページフッターの表示
  // showFooter();
  get_footer();

  // アクセス許可フラグを削除
  $_SESSION['access_file_flg'] = 0;

}
