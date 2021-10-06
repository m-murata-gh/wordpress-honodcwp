<?php

function showHeader(string $title = ''): void {

  if ($title) {
    $innerTitle = $title . '｜ほの歯科クリニック HONO DENTAL CLINIC｜宝殿駅近くの歯医者 - 加古川市米田町';
  } else {
    $innerTitle = 'ほの歯科クリニック HONO DENTAL CLINIC｜宝殿駅近くの歯医者 - 加古川市米田町';
  }

echo <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  <title>{$innerTitle}</title>
  <link rel="stylesheet" href="{$GLOBALS['urlIndex']}assets/css/main.css">
  <link rel="icon" type="image/x-icon" href="{$GLOBALS['urlIndex']}assets/images/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="{$GLOBALS['urlIndex']}assets/images/apple-touch-icon.png">
  <script defer src="{$GLOBALS['urlIndex']}assets/js/libs/jquery-3.4.1.min.js"></script>
  <script defer src="{$GLOBALS['urlIndex']}assets/js/libs/smooth-scroll/smooth-scroll.js"></script>
  <script defer src="{$GLOBALS['urlIndex']}assets/js/common.js"></script>
</head>
<body class="hmbg-modal-body">

<!-- [pc-header] -->
<header id="pc-header" class="pc-header structure">
  <div class="inner--wide pc-header__inner">
    <div class="logo pc-header__logo"><a href="{$GLOBALS['urlIndex']}"><h1><img src="{$GLOBALS['urlIndex']}assets/images/logo_navy.svg" alt="ほの歯科クリニック HONO DENTAL CLINIC"></h1></a></div>
    <!-- /.logo -->
    <div class="tel-num pc-header__tel-num"><img src="{$GLOBALS['urlIndex']}assets/images/tel-num.svg"></div>
    <!-- /.tel-num -->
    <nav class="pc-nav pc-header__pc-nav">
      <ul class="pc-nav__list">
        <li><a href="{$GLOBALS['urlIndex']}">ホーム</a>
        <li><a href="{$GLOBALS['urlNews']}">お知らせ</a>
        <li><a href="{$GLOBALS['urlGreeting']}">ご挨拶</a>
        <li><a href="{$GLOBALS['urlMedical']}">診療科目</a>
        <li><a href="{$GLOBALS['urlClinic']}">医院紹介</a>
        <li><a href="{$GLOBALS['urlAccess']}">アクセス</a>
        <li><a href="{$GLOBALS['urlReserve']}">Web予約</a>
      </ul>
    </nav>
  </div>
  <!-- /.inner--wide -->
</header>
<!-- /.pc-header -->

<!-- [sp-header] -->
<header id="sp-header" class="sp-header hmbg-modal-header">
  <div class="structure">
    <div class="inner sp-header__inner-1">
      <div class="logo--sm"><a href="{$GLOBALS['urlIndex']}"><h1><img src="{$GLOBALS['urlIndex']}assets/images/logo_navy.svg" alt="ほの歯科クリニック HONO DENTAL CLINIC"></h1></a></div>
      <!-- /.logo -->
      <!-- [hmbg-btn] -->
      <div id="hmbg-btn" class="hmbg-btn sp-header__hmbg-btn">
        <div class="hmbg-btn__frame">
          <div class="hmbg-btn__area">
            <div class="hmbg-btn__central">
              <div class="hmbg-btn__line"><span></span><span></span><span></span></div>
              <!-- /.hmbg-btn__line -->
              <div class="hmbg-btn__caption"><i>MENU</i></div>
              <!-- /.hmbg-btn__caption -->
            </div><!-- /.hmbg-btn__central -->
          </div><!-- /.hmbg-btn__area -->
        </div><!-- /.hmbg-btn__frame -->
      </div><!-- /.hmbg-btn -->
    </div><!-- /.inner sp-header__inner-1 -->
  </div><!-- /.structure -->
  <div class="structure sp-header__structure-2">
    <div class="inner sp-header__inner-2">
      <!-- [hmbg-menu] -->
      <div id="hmbg-menu" class="hmbg-menu sp-header__hmbg-menu">
        <div class="hmbg-menu__area">
          <nav class="hmbg-menu__list">
            <ul>
              <div class="call-reserve sp-header__call-reserve">
                <ul>
                  <li><a href="tel:0794XXXXXX">電話する</a>
                  <li><a href="{$GLOBALS['urlReserve']}">Web予約</a>
                </ul>
              </div>
              <!-- /.call-reserve -->
              <li><a href="{$GLOBALS['urlIndex']}">ホーム</a>
              <li><a href="{$GLOBALS['urlNews']}">お知らせ</a>
              <li><a href="{$GLOBALS['urlGreeting']}">ご挨拶</a>
              <li><a href="{$GLOBALS['urlMedical']}">診療科目</a>
              <li><a href="{$GLOBALS['urlClinic']}">医院紹介</a>
              <li><a href="{$GLOBALS['urlAccess']}">アクセス</a>
            </ul>
          </nav>
          <!-- /.hmbg-menu__list -->
        </div>
        <!-- /.hmbg-menu__area -->
      </div>
      <!-- /.hmbg-menu -->
    </div><!-- /.inner sp-header__inner-2 -->
  </div><!-- /.structure sp-header__structure-2 -->
</header>
<!-- /.sp-header -->

HTML;
}
