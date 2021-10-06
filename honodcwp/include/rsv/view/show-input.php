<?php

function showInput(DispSpot $dispSpot): void {

  // 来院日時
  $dispDateWeekTime = $dispSpot->dispDateWeekTime;
  // 区分
  if (! isset($_SESSION['inputHold'])) {
    $_SESSION['inputHold'] = [];
    $_SESSION['inputHold']['pati-type'] = null;
    $_SESSION['inputHold']['pati-id'] = null;
    $_SESSION['inputHold']['pati-name'] = null;
    $_SESSION['inputHold']['pati-phone'] = null;
    $_SESSION['inputHold']['pati-mail'] = null;
  }
  $shoshinChecked
    = ($_SESSION['inputHold']['pati-type'] == "初診") ? 'checked' : '' ;
  $saishinChecked
    = ($_SESSION['inputHold']['pati-type'] == "再診") ? 'checked' : '';
  $errPatiType = tagStrong($_SESSION['inputErr']['pati-type'] ?? null);
  // 診察券番号
  $patiId
    = ($_SESSION['inputHold']['pati-type'] == "再診") ? $_SESSION['inputHold']['pati-id'] : '';
  $errPatiId = tagStrong(($_SESSION['inputErr']['pati-id'] ?? null), 'err-pati-id');
  // お名前
  $patiName
    = $_SESSION['inputHold']['pati-name'];
  $errPatiName = tagStrong($_SESSION['inputErr']['pati-name'] ?? null);
  // 電話番号
  $patiPhone
    = $_SESSION['inputHold']['pati-phone'];
  $errPatiPhone = tagStrong($_SESSION['inputErr']['pati-phone'] ?? null);
  // メールアドレス
  $patiMail
    = $_SESSION['inputHold']['pati-mail'];
  $errPatiMail = tagStrong($_SESSION['inputErr']['pati-mail'] ?? null);

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
  $query = "?req=schedule";
  $prevURL .= $query;

  // 表示
  echo <<<HTML

<div class="rsv-contents-wrapper">

<table class="rsv-confirm-table">
<tr>
  <th>来院日時
  <td>{$dispDateWeekTime}
</table>

<form class="rsv-input-form">
<p>◆お客様情報を入力してください。<br>
(診察券をお持ちの方は「再診」を選択してください。)</p>
<label>
  <input id="shoshin-radio" type="radio" name="pati-type" value="初診" {$shoshinChecked}><span>初診</span>
</label>
<label>
  <input id="saishin-radio" type="radio" name="pati-type" value="再診" {$saishinChecked}><span>再診</span>
</label>
{$errPatiType}

<fieldset id="pati-saishin-field" class="rsv-input-form__rsv-field">
  <legend>再診の方</legend>
  <label><span>診察券番号*</span>
    <input id="pati-id-input" type="text" name="pati-id" value="{$patiId}" size="14em" placeholder="例:2001001">
  </label>
  {$errPatiId}
</fieldset>

<fieldset id="pati-info-field" class="rsv-input-form__rsv-field">
  <legend>患者様情報</legend>
  <label><span>お名前*</span>
    <input type="text" name="pati-name" value="{$patiName}" placeholder="例:山田一郎">
  </label>
  {$errPatiName}
  <label><span>電話番号*</span>
    <input type="text" name="pati-phone" value="{$patiPhone}" size="14em" placeholder="例:09010002000">
  </label>
  {$errPatiPhone}
  <label><span>メールアドレス<br>(任意)</span>
    <input type="text" name="pati-mail" value="{$patiMail}" size="32em" placeholder="例:example@gmail.com">
  </label>
  {$errPatiMail}
</fieldset>

<button class="rsv-button" type="submit" formaction="{$nextURL}" formmethod="POST" name="show" value="confirm">予約内容確認画面へ</button>
<button class="rsv-button--back" type="submit" formaction="{$prevURL}" formmethod="POST" name="show" value="">前の画面に戻る</button>
</form>

</div><!-- /.rsv-contents-wrapper -->

HTML;
  return;
}
