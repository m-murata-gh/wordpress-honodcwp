<?php

/**
 * エラーメッセージページを表示する関数
 *
 * 不正なアクセス時やエラーなど
 */
function showErr($msg): void {

  // rsv-settings
  require_once __DIR__ . '/../conf/rsv-settings.php';

  // URL
  $rsvURL = $GLOBALS['rsv']['url']['backrsv'];
  $homeURL = $GLOBALS['rsv']['url']['backroot'];

  // エラーメッセージの表示
echo <<<HTML

<div class="rsv-contents-wrapper">

<p class="rsv-msg"><b><strong>※ERROR!※</strong></b><br>{$msg}<br><br>恐れ入りますが再度ご予約をお試しください。</p>
<button class="rsv-button--back" type="button"><a href="{$rsvURL}">Web予約トップに戻る</a></button>
<button class="rsv-button--back" type="button"><a href="{$homeURL}">ホームに戻る</a></button>

<div class="rsv-contents-wrapper">

HTML;

  return;
}
