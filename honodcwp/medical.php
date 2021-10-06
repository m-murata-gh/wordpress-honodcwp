<?php

get_template_part('settings');
get_header();

echo <<<HTML

<main>
  <section>
    <header class="page-title structure--no-padding">
      <div class="inner--wide">
        <div class="heading heading--pagetitle heading--medical-pagetitle articles__heading"><h2 class="heading__txt">診療科目</h2></div>
        <!-- /.heading -->
      </div><!-- /.inner--wide -->
    </header><!-- /.structure -->

    <aside class="page-breadcrumbs structure">
      <div class="inner">
        <ul class="breadcrumbs articles__breadcrumbs">
          <li class="before-icon--house"><a href="{$GLOBALS['urlIndex']}">ホーム</a></li>
          <li><a href="{$GLOBALS['urlMedical']}">診療科目</a></li>
        </ul>
      </div><!-- /.inner -->
    </aside><!-- /.structure -->

    <div id="article1" class="id-link-wrapper">
    <div class="page-section structure">
      <div class="inner">
        <article class="article">
          <header class="article__heading">
            <h3>一般歯科</h3>
            <p>General dentistry</p>
          </header><!-- /.article__heading -->
          <div class="article__image img-ippan"></div><!-- /.article__image -->
          <div class="article__paragraph">
            <p>患者さんのお口の中の状態、治療内容、治療計画をわかりやすく説明をし、納得していただき、患者さん参加型の治療を心掛けています。<br>
            治療終了後は患者さん一人一人にあわせたメンテナンス方法を説明しています。
          </div><!-- /.article__image -->
        </article><!-- /.article -->
      </div><!-- /.inner -->
    </div><!-- /.structure -->
    </div><!-- /.id-link-wrapper -->

    <div id="article2" class="id-link-wrapper">
    <div class="page-section page-section--even structure">
      <div class="inner">
        <article class="article">
          <header class="article__heading">
            <h3>小児歯科</h3>
            <p>Pediatric dentistry</p>
          </header><!-- /.article__heading -->
          <div class="article__image article__image--even img-syouni"></div><!-- /.article__image -->
          <div class="article__paragraph">
            <p>虫歯を治療し、痛みを取り除く事は当たり前ですが、当院では、お子様が幼稚園や小学校や習い事へ通う様に、「お友達や先生に会いに行く」感覚で楽しく通院していただける環境づくりに努めています。<br>
            診療を待っている間はお子様が退屈しない様に、キッズルームにはたくさんのおもちゃやDVDをご用意しています。
          </div><!-- /.article__image -->
        </article><!-- /.article -->
      </div><!-- /.inner -->
    </div><!-- /.structure -->
    </div><!-- /.id-link-wrapper -->

    <div id="article3" class="id-link-wrapper">
    <div class="page-section structure">
      <div class="inner">
        <article class="article">
          <header class="article__heading">
            <h3>歯周病</h3>
            <p>Periodontal disease</p>
          </header><!-- /.article__heading -->
          <div class="article__image img-sisyuu"></div><!-- /.article__image -->
          <div class="article__paragraph">
            <p>初期の歯周病はほとんど自覚症状がありません。進行するとお口の中のトラブルだけではなく、糖尿病、動脈硬化、肺炎など全身への影響も出てきます。<br>
            中高年の80％以上の方がかかっている病気といわれています。<br>
            歯周病を予防したりコントロールをすることは、単に歯や口の健康を守るだけでなく、全身の健康を維持することにもつながります。
          </div><!-- /.article__image -->
        </article><!-- /.article -->
      </div><!-- /.inner -->
    </div><!-- /.structure -->
    </div><!-- /.id-link-wrapper -->

    <div id="article4" class="id-link-wrapper">
    <div class="page-section page-section--even structure">
      <div class="inner">
        <article class="article">
          <header class="article__heading">
            <h3>予防歯科</h3>
            <p>Preventive dentistry</p>
          </header><!-- /.article__heading -->
          <div class="article__image article__image--even img-yobou"></div><!-- /.article__image -->
          <div class="article__paragraph">
            <p>「虫歯が治ったから、もう安心。」「別に歯が痛くないから歯医者は必要ない。」と思っていませんか？<br>
            虫歯・歯周病の治療は大事ですが、「虫歯・歯周病にならないための予防と再発防止」こそ、いつまでも健康な歯で有り続けるための一番の治療法です。<br>
            当院では、「今ある歯を大切にしていただきたい」想いから、予防に特に力を入れています。
          </div><!-- /.article__image -->
        </article><!-- /.article -->
      </div><!-- /.inner -->
    </div><!-- /.structure -->
    </div><!-- /.id-link-wrapper -->

    <div id="article5" class="id-link-wrapper">
    <div class="page-section page-section--last structure">
      <div class="inner">
        <article class="article">
          <header class="article__heading">
            <h3>義歯・入れ歯</h3>
            <p>Denture</p>
          </header><!-- /.article__heading -->
          <div class="article__image img-ireba"></div><!-- /.article__image -->
          <div class="article__paragraph">
            <p>入れ歯には部分的に歯を失った場合に使用する「部分入れ歯」と、全ての歯や大部分の歯を失っ場合に使用する「総入れ歯」の2種類があります。<br>
            さらにそれぞれに保険診療のものと自由診療（自費診療）のものがあります。<br>
            今の入れ歯への不満や不便だと思う点、新しく入れ歯を作る方へは不安やどのような機能を求めているかなど、お悩み・ご要望やお気持ちをしっかり伺い、お口の状況を確認したのちに患者さま一人ひとりに適切な入れ歯をご提案します。
          </div><!-- /.article__image -->
        </article><!-- /.article -->
      </div><!-- /.inner -->
    </div><!-- /.structure -->
    </div><!-- /.id-link-wrapper -->

  </section>
</main>

HTML;

get_footer();
