<?php

get_template_part('settings');
get_header();

echo <<<HTML

<main>
  <section>
    <header class="page-title structure--no-padding">
      <div class="inner--wide">
        <div class="heading heading--pagetitle heading--clinic-pagetitle articles__heading"><h2 class="heading__txt">医院紹介</h2></div>
        <!-- /.heading -->
      </div><!-- /.inner--wide -->
    </header><!-- /.structure -->

    <aside class="page-breadcrumbs structure">
      <div class="inner">
        <ul class="breadcrumbs articles__breadcrumbs">
          <li class="before-icon--house"><a href="{$GLOBALS['urlIndex']}">ホーム</a></li>
          <li><a href="{$GLOBALS['urlClinic']}">医院紹介</a></li>
        </ul>
      </div><!-- /.inner -->
    </aside><!-- /.structure -->

    <div id="article1" class="id-link-wrapper">
    <div class="page-section structure">
      <div class="inner">
        <article class="article">
          <header class="article__heading">
            <h3>キッズスペース</h3>
            <p>Kids space</p>
          </header><!-- /.article__heading -->
          <div class="article__image img-kids-space"></div><!-- /.article__image -->
          <div class="article__paragraph">
            <p>キッズスペース内には、お子様が楽しく歯磨きの習慣をつけられるようになるような絵本やDVDをご用意しています。<br>
            お子様とご一緒に楽しんでいただきながら、ゆったりお過ごしいただければと思います。
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
            <h3>クリーニングスペース</h3>
            <p>Cleaning space</p>
          </header><!-- /.article__heading -->
          <div class="article__image article__image--even img-cleaning-space"></div><!-- /.article__image -->
          <div class="article__paragraph">
            <p>患者様のプライバシーに配慮し、ユニットごとにパーテーションで区切っています。ほかの患者様の視線を気にせず、安心して診療をお受けいただけます。<br>
            またスペースが広いのでベビーカーなど大きな荷物を置くこともできます。
          </div><!-- /.article__image -->
        </article><!-- /.article -->
      </div><!-- /.inner -->
    </div><!-- /.structure -->
    </div><!-- /.id-link-wrapper -->

    <div id="article3" class="id-link-wrapper">
    <div class="page-section page-section--last structure">
      <div class="inner">
        <article class="article">
          <header class="article__heading">
            <h3>ウォーターサーバー</h3>
            <p>Water server</p>
          </header><!-- /.article__heading -->
          <div class="article__image img-water-server"></div><!-- /.article__image -->
          <div class="article__paragraph">
            <p>来院された患者さんに喉を潤してもらって、少しでも快適な時間を過ごしていただきたいという思いで設置しました。<br>
            診療前後の緊張や不安を和らげ、少しでもリラックスしていただけるように、どうぞ遠慮なく召し上がってください。
          </div><!-- /.article__image -->
        </article><!-- /.article -->
      </div><!-- /.inner -->
    </div><!-- /.structure -->
    </div><!-- /.id-link-wrapper -->

  </section>
</main>

HTML;

get_footer();
