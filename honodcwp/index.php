<?php

get_template_part('settings');
get_header();

echo <<<HTML

<main>
  <section>
    <header class="page-title structure--no-padding">
      <div class="inner--wide">
        <div class="heading heading--pagetitle heading--news-pagetitle articles__heading"><h2 class="heading__txt">お知らせ</h2></div>
        <!-- /.heading -->
      </div><!-- /.inner--wide -->
    </header><!-- /.structure -->

    <aside class="page-breadcrumbs structure">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="before-icon--house"><a href="{$GLOBALS['urlIndex']}">ホーム</a></li>
          <li><a href="{$GLOBALS['urlNews']}">お知らせ</a></li>
        </ul>
      </div><!-- /.inner -->
    </aside><!-- /.structure -->

    <div class="page-section structure">
      <div class="inner">
        <div class="vertical-posts vertical-posts--article">
HTML;

get_template_part('loop');

echo <<<HTML
        </div><!-- /.vertical-posts -->

        <div class="pagenation">
HTML;
if (function_exists('wp_pagenavi')) {
  wp_pagenavi();
}
echo <<<HTML
        </div>
        <!-- /.pagenation -->

      </div><!-- /.inner -->
    </div><!-- /.structure -->
  </section>
</main>

HTML;

get_footer();
