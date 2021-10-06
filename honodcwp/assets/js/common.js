'use strict';

window.onload = function() {

let body = document.body;
let hmbgHeader = document.getElementById('sp-header');
let hmbgBtn = document.getElementById('hmbg-btn');
let hmbgMenu = document.getElementById('hmbg-menu');

/**
 * ハンバーガーメニュー
 *
 * body, hmbgHeader, hmbgBtn, hmbgMenu
 */

// hmbgBtnをクリックしてhmbgBtn, hmbgMenuのactive状態を切り替える
hmbgBtn.addEventListener('click', (e) => {
  // 正常な動作のために以下の並び順は変えないこと!
  body.classList.toggle('is-active-hmbg');
  hmbgHeader.classList.toggle('is-active-hmbg');
  hmbgHeader.scrollIntoView(); // hmbgHeaderスクロール位置の初期化(※hmbgHeaderをアクティブ化直後に記述すること)
  hmbgBtn.classList.toggle('is-active-hmbg');
  hmbgMenu.classList.toggle('is-active-hmbg');
  e.stopPropagation();
}, false);

// メニュー以外の画面をどこでもクリックすると、メニューを閉じる仕様にする
function removeHmbgClass() {
  const hmbgElements = [body, hmbgHeader, hmbgBtn, hmbgMenu];
  hmbgElements.forEach(element => {
      element.classList.remove('is-active-hmbg');
    }
  );
}
hmbgMenu.addEventListener('click', (e) => {
  removeHmbgClass();
  e.stopPropagation();
}, false);
body.addEventListener('click', (e) => {
  if (hmbgBtn.classList.contains('is-active-hmbg')) {
    removeHmbgClass();
    e.stopPropagation();
  };
}, false);


// /**
//  * #フラグメント付きのURLにリンクした時のスクロール挙動
//  *
//  * スクロール関数(3.)の発生タイミングは以下の通りとした。
//  * 同ページ#A→#A ... 1.#リンククリック時
//  * 同ページ#A→#B ... 1.#リンククリック時
//  * 別ページ→ #あり or 同ページ#なし→#あり ... 2.ページ読み込み時
//  */
//
// // 1.#リンクのクリックイベントリスナを追加
// let linkElements = document.querySelectorAll('a[href*="#"]');
// linkElements.forEach(element =>
//   element.addEventListener('click', (e) => {
//     e.preventDefault();
//     console.log('クリック'); // DEBUG:
//
//     // ページ遷移を伴う場合はページ読み込み時に発火させる(2.)ので、ページ遷移を伴わない場合のみこのクリックイベント(1.)でスクロールを実行する
//     let reg = /#.*$/; // hash reg
//     let locHref = location.href;
//     let linkHref = element.getAttribute('href');
//
//     if (locHref.replace(reg, '') === linkHref.replace(reg, '')) {
//       // スマホメニューのモーダル化クラス(ヘッダーの高さが100%になっている)を削除
//       hmbgHeader.classList.remove('is-active-hmbg');
//
//       // #hashを取得
//       let linkHash = reg.exec(linkHref);
//
//       // URLを変更
//       location.assign(linkHref);
//       // スクロール実行
//       hashScroll(linkHash[0]);
//     } else {
//       // URLを変更
//       location.assign(linkHref);
//     }
//   }, false)
// );
//
// // 2.ページ読み込み時に#フラグメントがついてるか判定
// let locHash = location.hash;
// if (locHash) {
//   console.log('読み込み時'); // DEBUG:
//   console.log(locHash); // DEBUG:
//   hashScroll(locHash);
// }
//
// // 3.スクロール関数(自身のURLから#フラグメントidを取得し、スクロール値を計算＋スクロール)
// function hashScroll(hash) {
//   let elementId = hash.substring(1); // #を取り除く
//
//   // ヘッダーの高さを取得
//   let pcHeader = document.getElementById('pc-header');
//   let spHeader = document.getElementById('sp-header');
//   let headerHeight = pcHeader.offsetHeight + spHeader.offsetHeight;
//
//   // #フラグメントidの要素のトップ位置を取得
//   let elementTop = document.getElementById(elementId).offsetTop;
//
//   // #フラグメントidの場所までスクロール
//   let targetTop = elementTop - headerHeight;
//   window.scrollTo(0, targetTop);
//
//   console.log('スクロール'); // DEBUG:
// }


/**
 * SmoothScroll
 *
 * jQuery使用
 */

// #フラグメント
var scroll = new SmoothScroll('a[href*="#"]', {
speed: 500
});

// topに戻る
var scrollBtn = $('#scroll-top');
scrollBtn.hide();
$(window).scroll(function () {
  if ($(this).scrollTop() > 700) {
    scrollBtn.fadeIn();
  } else {
    scrollBtn.fadeOut();
  }
});
scrollBtn.click(function () {
  $('body, html').animate({ scrollTop: 0 }, 500);
  return false;
});


/**
 * rsv-common.js
 *
 * インプットフォームの状態変化に伴うスクリプト
 */

// ?req=formを含むURLでのみ走らせる
if (/\?req=form.*/.test(location.search)) {

  let shoshinRadio = document.getElementById('shoshin-radio');
  let saishinRadio = document.getElementById('saishin-radio');
  let patiSaishinField = document.getElementById('pati-saishin-field');
  let patiInfoField = document.getElementById('pati-info-field');
  let patiIdInput = document.getElementById('pati-id-input');
  let errPatiId = document.getElementById('err-pati-id');

  // ページ読み込み時のラジオボタン状態チェック
  radioChange();

  // イベントの追加
  shoshinRadio.addEventListener('change', (e) => {
    radioChange()
  }, false);
  saishinRadio.addEventListener('change', (e) => {
    radioChange()
  }, false);

  function radioChange() {
    if(shoshinRadio.checked) {
      // 再診フィールドのs-activeクラスを削除
      patiSaishinField.classList.remove('is-active');
      // 患者情報フィールドにis-activeクラスを追加
      patiInfoField.classList.add('is-active');
      // 診察番号インプットをdisabled
      patiIdInput.setAttribute('disabled', true);
      // 診察券番号とエラーメッセージを消す
      patiIdInput.innerHTML = '';
      patiIdInput.setAttribute('value', '');
      if(errPatiId) {
        errPatiId.remove();
      }
    } else if(saishinRadio.checked) {
      // 再診フィールドにis-activeクラスを追加
      patiSaishinField.classList.add('is-active');
      // 患者情報フィールドにis-activeクラスを追加
      patiInfoField.classList.add('is-active');
      // 診察番号インプットのdisabledを削除
      patiIdInput.removeAttribute('disabled');
    }
    return;
  }
}

}();
