<?php

function setCategory($categories) :array {
  $categoryHTMLs = [];
  foreach ( $categories as $category ) {
    // カテゴリーのCSSクラス決定
    if ($category->cat_name == '重要') {
      $classHTML = 'label--important';
    } else {
      $classHTML = 'label';
    }
    $classHTML .= ' vertical-posts__label';
    if (is_home()) { // ブログ一覧ページの場合さらにクラス追加
      $classHTML .= ' vertical-posts--article__label';
    }
    if (is_home()) { // ブログ一覧ページの場合div
      $tagHTML = 'div';
    } else { // フロントページの場合dt
      $tagHTML = 'dt';
    }
    $output = '<' . $tagHTML . ' class="' . $classHTML . '">' . $category->name . '</' . $tagHTML . '>';
    $categoryHTMLs[] = $output;
  }
  return $categoryHTMLs;
}
