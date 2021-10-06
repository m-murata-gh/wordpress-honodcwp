<?php

get_template_part('settings');
get_header();

echo <<<HTML

<!-- [sp-aside] -->
<aside class="sp-aside structure">
  <div class="inner">
    <div class="call-reserve sp-aside__call-reserve">
      <ul>
        <li><a href="tel:0794XXXXXX">電話する</a>
        <li><a href="{$GLOBALS['urlReserve']}">Web予約</a>
      </ul>
    </div>
    <!-- /.call-reserve -->
  </div>
  <!-- /.inner -->
</aside>
<!-- /.sp-aside -->

<!-- [mv] -->
<section class="mv structure--no-padding">
  <div class="inner--wide mv__inner--wide">
    <div class="carousel mv__carousel">
      <div class="carousel__src-1"></div>
      <div class="carousel__src-2"></div>
      <div class="carousel__src-3"></div>
    </div>
    <!-- /.mv__carousel -->
    <div class="leaf-msg mv__leaf-msg">
      <div class="leaf-msg__inner">
        <div class="leaf-msg__item--sm"><img src="{$GLOBALS['wproot']}assets/images/leaf-msg-sm.svg" alt=""></div><!-- /.leaf-msg__item--lg -->
        <div class="leaf-msg__item--lg"><img src="{$GLOBALS['wproot']}assets/images/leaf-msg-lg.svg" alt=""></div><!-- /.leaf-msg__item--lg -->
      </div><!-- /.leaf-msg__inner -->
    </div>
    <!-- /.mv__leaf-msg -->
    <div class="balloon-msg mv__balloon-msg">
      <div class="balloon-msg__inner">
        <ul>
          <li class="before-icon--rhombus">宝殿駅より車で5分
          <li class="before-icon--rhombus">フレッシュながさわ北隣
          <li class="before-icon--rhombus">月・木曜は夜8時まで開院
        </ul>
      </div><!-- /.balloon-msg__inner -->
    </div>
    <!-- /.mv__balloon-msg -->
    <div class="time-table--has-padding mv__time-table--has-padding">
      <div class="time-table__inner">
        <table>
          <thead>
            <tr>
              <th>診療時間
              <td>月
              <td>火
              <td>水
              <td>木
              <td>金
              <td>土
              <td>日
              <td>祝
          <tbody>
            <tr>
              <th>9:30～12:00
              <td>●
              <td>●
              <td>－
              <td>●
              <td>●
              <td>●
              <td>－
              <td>－
            <tr>
              <th>14:00～20:00
              <td>●
              <td>▲
              <td>－
              <td>●
              <td>▲
              <td>▲
              <td>－
              <td>－
        </table>
        <p>▲…14:00～18:00
        <p>【休診日】水曜・日曜・祝日
      </div>
      <!-- /.time-table__inner -->
    </div>
    <!-- /.time-table--has-pc-bgc -->
  </div>
  <!-- /.inner--wide -->
</section>
<!-- /.mv -->

<main>
  <!-- [news] -->
  <section class="news structure">
    <div class="inner news__inner">
      <div class="heading heading--news news__heading"><h2 class="heading__txt">お知らせ</h2></div>
      <!-- /.heading -->
      <div class="news__contents">
        <dl class="vertical-posts">
HTML;

get_template_part('loop');

echo <<<HTML
        </dl>
      </div>
      <!-- /.news__contents -->
    </div>
    <!-- /.inner -->
  </section>

  <!-- [greeting] -->
  <div id="greeting" class="id-link-wrapper">
  <section class="greeting structure">
    <div class="inner greeting__inner">
        <div class="heading heading--greeting greeting__heading"><h2 class="heading__txt">ご挨拶</h2></div>
        <!-- /.heading -->
        <div class="greeting__contents">
          <p>はじめまして。ほの歯科クリニック院長の保野太郎と申します。<br>
          ほの歯科クリニックは加古川市米田町にある地域密着型の歯科医院です。<br>
          当院では、優しさのある対応とコミュニケーションを大切にしており、患者様が要望される治療に沿った選択肢をご提案し、納得のいく治療法をご選択いただきます。<br>
          スタッフ一同、患者様の気持ちに寄り添って、みなさまのお口の健康をサポートいたします。
        </div>
        <!-- /.greeting__contents -->
    </div>
    <!-- /.inner -->
  </section>
  </div><!-- /.id-link-wrapper -->

  <!-- [medical] -->
  <section class="medical structure">
    <div class="inner">
      <div class="heading heading--medical"><h2 class="heading__txt">診療科目</h2>
      </div><!-- /.heading -->
      <ul class="medical__contents">
        <li><a class="circle circle--ippan" href="{$GLOBALS['urlMedicalArticle1']}"><span>一般歯科</span></a>
        <li><a class="circle circle--syouni" href="{$GLOBALS['urlMedicalArticle2']}"><span>小児歯科</span></a>
        <li><a class="circle circle--sisyuu" href="{$GLOBALS['urlMedicalArticle3']}"><span>歯周病</span></a>
        <li><a class="circle circle--yobou" href="{$GLOBALS['urlMedicalArticle4']}"><span>予防歯科</span></a>
        <li><a class="circle circle--ireba" href="{$GLOBALS['urlMedicalArticle5']}"><span>義歯・入れ歯</span></a>
        <li><div class="circle--dummy" href=""><span>dummy</span></div>
      </ul><!-- /.medical__contents -->
    </div>
    <!-- /.inner -->
  </section>

  <!-- [clinic] -->
  <section class="clinic structure">
    <div class="inner clinic__inner">
      <div class="heading heading--clinic clinic__heading"><h2 class="heading__txt">医院紹介</h2></div>
      <!-- /.heading -->

      <ul class="place clinic__place">
        <li><a class="skew-card skew-card--kids-space" href="{$GLOBALS['urlClinicArticle1']}"><span class="skew-card__text-bg"></span><span class="skew-card__text">キッズスペース</span></a>
        <li><a class="skew-card skew-card--cleaning-space" href="{$GLOBALS['urlClinicArticle2']}"><span class="skew-card__text-bg"></span><span class="skew-card__text">クリーニングスペース</span></a>
        <li><a class="skew-card skew-card--water-server" href="{$GLOBALS['urlClinicArticle3']}"><span class="skew-card__text-bg"></span><span class="skew-card__text">ウォーターサーバー</span></a>
      </ul>

      <div class="profile clinic__profile">
        <div class="profile__photo"></div>
        <!-- /.profile__photo -->
        <div class="profile__name">
          <dt>院長</dt>
          <dd>保野 太郎</dd>
        </div><!-- /.profile__name -->
      </div><!-- /.profile -->

      <dl class="history clinic__history">
        <div class="history__dl-inner cf">
          <dt>所属</dt>
          <dd>日本歯科医師学会</dd>
          <dd>日本歯内療法会</dd>
          <dd>日本デンタルインプラント学会</dd>
        </div><!-- /.history__dl-inner -->

        <div class="history__dl-inner cf">
          <dt>経歴</dt>
          <dd>
            <table>
              <tr>
                <th>平成22年
                <td>兵庫歯科大学歯学部卒業
              <tr>
                <th>平成24年
                <td>兵庫加古川病院 麻酔科にて研修
              <tr>
                <th>平成29年
                <td>ほの歯科クリニック開院 現在に至る
            </table>
          </dd>
        </div><!-- /.history__dl-inner -->
      </dl>
    </div>
    <!-- /.inner -->
  </section>

  <!-- [access] -->
  <div id="access" class="id-link-wrapper">
  <section class="access structure">
    <div class="inner access__inner">
      <div class="heading heading--access access__heading"><h2 class="heading__txt">アクセス</h2></div>
      <!-- /.heading -->

      <dl class="access__list">
        <dt class="leaf-dotted-line"><span>電車でお越しの場合</span></dt>
        <dd class="before-icon--rhombus">JR宝殿駅徒歩14分</dd>
        <dt class="leaf-dotted-line"><span>バスでお越しの場合</span></dt>
        <dd class="before-icon--rhombus">神姫バス「米田」停留所で下車、徒歩3分</dd>
        <dd class="before-icon--rhombus">じょうとんバス「公民館前」停留所で下車、徒歩6分</dd>
        <dt class="leaf-dotted-line"><span>お車でお越しの場合</span></dt>
        <dd class="before-icon--rhombus">フレッシュながさわ北隣</dd>
        <dd class="before-icon--rhombus">駐車場8台完備</dd>
      </dl>
      <!-- /.access__list -->

      <div class="access__google-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3276.843203341806!2d134.8099283155137!3d34.78472238622065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3554d8809399b2c5%3A0x9adba3e30d9a8217!2z5a6d5q6_6aeF!5e0!3m2!1sja!2sjp!4v1584633590496!5m2!1sja!2sjp"></iframe>
      </div>
    </div>
    <!-- /.inner -->
  </section>
  </div><!-- /.id-link-wrapper -->

</main>

HTML;

get_footer();
