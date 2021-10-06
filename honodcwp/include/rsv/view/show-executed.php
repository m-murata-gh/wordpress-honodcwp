<?php

function showExecuted(DispSpot $dispSpot): void {

  // 来院日時
  $dispDateWeekTime = $dispSpot->dispDateWeekTime;

  // 区分
  $patiType = $dispSpot->httpPost['pati-type'] ?? '';
  // 診察券番号
  $patiId = $dispSpot->httpPost['pati-id'] ?? '';
  // お名前
  $patiName = $dispSpot->httpPost['pati-name'];
  // 電話番号
  $patiPhone = $dispSpot->httpPost['pati-phone'];
  // メールアドレス
  $patiMail = $dispSpot->httpPost['pati-mail'];

  // URL
  $rsvURL = $GLOBALS['rsv']['url']['backrsv'];
  $homeURL = $GLOBALS['rsv']['url']['backroot'];

  // 来院日時
  $dispDateWeekTime = $dispSpot->dispDateWeekTime;

// 表示
echo <<<HTML

<div class="rsv-contents-wrapper">

<p class="rsv-msg--confirm"><b>ご予約を確定いたしました。</b></p>

<table class="rsv-confirm-table">
  <tr>
    <th>来院日時
    <td>{$dispDateWeekTime}
</table>

<table class="rsv-confirm-table">
  <tr>
    <th>区分
    <td>{$patiType}
HTML;

if ($patiType === '再診') {
echo <<<HTML
  <tr>
    <th>診察券番号
    <td>{$patiId}
HTML;
}

echo <<<HTML
  <tr>
    <th>お名前
    <td>{$patiName}
  <tr>
    <th>電話番号
    <td>{$patiPhone}
  <tr>
    <th>メールアドレス
    <td>{$patiMail}
</table>

<p class="rsv-msg">※初診の方は、当日ご予約時間の15分前にお越しください。<br>
※キャンセル・変更はお電話で承っております。<strong></p>

<button class="rsv-button--back" type="button"><a href="{$rsvURL}">Web予約トップに戻る</a></button>
<button class="rsv-button--back" type="button"><a href={$homeURL}>ホームに戻る</a></button>

</div><!-- /.rsv-contents-wrapper -->

HTML;
  return;
}
