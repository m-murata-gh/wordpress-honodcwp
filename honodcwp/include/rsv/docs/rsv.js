'use strict';

window.onload = function() {

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
