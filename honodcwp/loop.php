<?php

$articleNum = 1;

if (is_front_page()) { // フロントページの場合
  $news_query = new WP_Query(
  	array(
  		'post_type'      => 'post',
  		'posts_per_page' => 3
  	)
  );

  if ($news_query->have_posts()) {
    while ($news_query->have_posts()) {
      $news_query->the_post();
      $titleHTML = get_the_title();
      $timeHTML = get_post_time('Y.m.d(D)', false, $post);
      $categories = get_the_category();

      if ( $categories ) {
        $categoryHTMLs = setCategory($categories);
      }
echo <<<HTML
  <div><a class="vertical-posts__item cf" href="{$GLOBALS['urlNews']}#article{$articleNum}">
    <dt class="vertical-posts__date"><time>{$timeHTML}</time></dt>
HTML;
      foreach ( $categoryHTMLs as $categoryHTML ) {
        echo $categoryHTML;
      }
echo <<<HTML
    <dd class="vertical-posts__title">{$titleHTML}</dd>
    <dd class="vertical-posts__paragraph">
HTML;
      the_excerpt();
echo <<<HTML
    </dd>
  </a></div><!-- /.vertical-posts__item -->
HTML;

      $articleNum++;
    }
  }
  wp_reset_postdata();

} elseif (is_home()) { // ブログ一覧ページの場合
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      $titleHTML = get_the_title();
      $timeHTML = get_post_time('Y.m.d(D)', false, $post);
      $categories = get_the_category();

      if ( $categories ) {
        $categoryHTMLs = setCategory($categories);
      }
echo <<<HTML
  <div id="article{$articleNum}" class="id-link-wrapper">
    <article class="vertical-posts__item cf vertical-posts--article__item">
      <div class="vertical-posts__date vertical-posts--article__date"><time>{$timeHTML}</time></div>
HTML;
      foreach ( $categoryHTMLs as $categoryHTML ) {
        echo $categoryHTML;
      }
echo <<<HTML
      <h3 class="vertical-posts__title vertical-posts--article__title">{$titleHTML}</h3>
      <div class="vertical-posts__paragraph vertical-posts--article__paragraph">
HTML;
      the_content();
echo <<<HTML
              </div><!-- /.vertical-posts__paragraph -->
            </article><!-- /.vertical-posts__item -->
          </div><!-- /.id-link-wrapper -->
HTML;
      $articleNum++;
    }
  }
}
