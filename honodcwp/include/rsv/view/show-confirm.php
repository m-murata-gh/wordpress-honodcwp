<?php

function showConfirm(DispSpot $dispSpot): void {

  // 来院日時
  $dispDateWeekTime = $dispSpot->dispDateWeekTime;

  // 区分
  $patiType = $dispSpot->httpPost['pati-type'] ?? '';
  // 診察券番号
  $patiId = $dispSpot->httpPost['pati-id'] ?? '';
  // お名前
  $patiName = $dispSpot->httpPost['pati-name'] ?? '';
  // 電話番号
  $patiPhone = $dispSpot->httpPost['pati-phone'] ?? '';
  // メールアドレス
  $patiMail = $dispSpot->httpPost['pati-mail'] ?? '';

  // form action URL
  // 予約日時URLパラメータ
  $rsvDatetime = $dispSpot->rsvDatetime;
  // 次画面
  $nextURL = URL_RSV_INDEX;
  $query = "?req=form";
  $query .= "&rsv_datetime={$rsvDatetime}";
  $nextURL .= $query;
  // 前画面
  $prevURL = URL_RSV_INDEX;
  $query = "?req=form";
  $query .= "&rsv_datetime={$rsvDatetime}";
  $prevURL .= $query;

  // 表示
echo <<<HTML

<div class="rsv-contents-wrapper">

<p class="rsv-msg--confirm"><b><strong>まだご予約は完了していません。</strong></b><br>ご予約内容の最終確認をしてください。</p>

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

<p class="rsv-msg"><strong>上記内容でご予約いたします。<br>
よろしければ、「予約を確定する」ボタンを押してください。</strong></p>

<form>
<input type="hidden" name="pati-type" value="{$patiType}">
<input type="hidden" name="pati-id" value="{$patiId}">
<input type="hidden" name="pati-name" value="{$patiName}">
<input type="hidden" name="pati-phone" value="{$patiPhone}">
<input type="hidden" name="pati-mail" value="{$patiMail}">
<button class="rsv-button" type="submit" formaction="{$nextURL}" formmethod="POST" name="show" value="executed">予約を確定する</button>
<button class="rsv-button--back" type="submit" formaction="{$prevURL}" formmethod="POST" name="show" value="input">入力内容を変更する</button>
</form>

</div><!-- /.rsv-contents-wrapper -->

HTML;

  return;
}
