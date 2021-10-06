<?php

/**
 * セッションの構成を設定する関数
 *
 * session.auto_startは無効化しておく。session_start()の前に呼び出すこと。
 */
function iniSession(): void {
  // ini_set('session.cookie_secure', 'On'); // https Only
  ini_set('session.cookie_httponly', 'On');
  return;
}

/**
 * 不正なアクセスをチェックする関数(直接アクセスされたくないファイルに記述)
 *
 * $_SESSION['accessFlg']が1ならアクセス可。
 * 呼び出し元ファイルでフラグ管理すること。
 */
function accessFileCheck(): void {
  $flg = $_SESSION['access_file_flg'] ?? 0;
  if ($flg !== 1) {
    showErr('不正なアクセスです。');
    exit();
  }
  return;
}

/**
 * 不正なアクセスをチェックする関数(日時クエリパラメータがある場合のみアクセス許可したい箇所に記述)
 *
 * $_GET['rsv_datetime']
 */
function accessRsvDatetimeCheck(): void {
  if (! isset($_GET['rsv_datetime']) || $_GET['rsv_datetime'] == '') {
    throw new Exception('不正なアクセスです。');
  }
  return;
}

/**
 * 不正なアクセスをチェックする関数(フォーム送信ボタンからのみアクセス許可したい所に記述)
 *
 * POST
 */
function accessPostCheck(): void {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    throw new Exception('不正なアクセスです。');
  }
  return;
}

/**
 * バリデーション関数 $_GET
 *
 * $_GET['rsv_datetime']が有効ならT/無効ならFを返す。
 */
function validateRsvDatetime(): bool {
  $addWeek = (MAX_PAGE_COUNT + 1);
  $rangeStart = new DateTime('+1 day');
  $rangeEnd = new DateTime("+{$addWeek} week");
  $min = $rangeStart->format('Ymd0930');
  $max = $rangeEnd->format('Ymd1930');

  // 予約可能期間内かチェック
  $input = filter_input(INPUT_GET, 'rsv_datetime', FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'max_range' => $max]]);
  if ($input) {
    // 予約時間が適切かチェック
    $time = substr($input, -4, 2) . ':' . substr($input, -2, 2);
    $timeTable = setTimeTable();
    if (in_array($time, $timeTable)) {
      $bool = true;
    } else {
      $bool = false;
    }
  } else {
    $bool = false;
  }

  if (! $bool) {
    throw new Exception('不正な予約日時です。');
  }
  return $bool;
}

/**
 * バリデーション関数 $_POST
 *
 * $_POSTのインプット内容が有効ならT/無効ならFを返す。
 * $_SESSION['inputErr']にエラーメッセージを格納する。
 */
function validateInput(): bool {
  $_SESSION['inputErr'] = [];

  // 区分
  if (! isset($_POST['pati-type'])) {
    $_POST['pati-type'] = '';
  }
  if (! $_POST['pati-type']) {
    $_SESSION['inputErr']['pati-type']
      = '初診か再診のどちらかを選択してください。';
  }
  // 診察券番号
  if (! isset($_POST['pati-id'])) {
    $_POST['pati-id'] = '';
  }
  $_POST['pati-id'] = htmlspecialchars(str_replace([" ", "　"], "", $_POST['pati-id']));
  $ptn = '/^\d{7}$/';
  $isMatch = preg_match($ptn, $_POST['pati-id']);
  if (! $isMatch && $_POST['pati-type'] === '再診') {
    $_SESSION['inputErr']['pati-id']
      = '7桁の数字を入力してください。';
    $_SESSION['inputHold']['pati-id'] = $_POST['pati-id'];
  }
  // お名前
  $_POST['pati-name'] = htmlspecialchars(str_replace([" ", "　"], "", $_POST['pati-name']));
  if (! $_POST['pati-name']) {
    $_SESSION['inputErr']['pati-name']
      = 'お名前を入力してください。';
    $_SESSION['inputHold']['pati-name'] = $_POST['pati-name'];
  }

  // 電話番号
  $_POST['pati-phone'] = htmlspecialchars(str_replace([" ", "　", "-", "‐"], "", $_POST['pati-phone']));
  $_POST['pati-phone'] =  mb_convert_kana($_POST['pati-phone'], "a");
  $ptn = '/^\d{10,11}$/';
  $isMatch = preg_match($ptn, $_POST['pati-phone']);

  if (! $isMatch) {
    $_SESSION['inputErr']['pati-phone']
      = '電話番号を入力してください。';
    $_SESSION['inputHold']['pati-phone'] = $_POST['pati-phone'];
  }

  // メールアドレス
  $_POST['pati-mail'] = htmlspecialchars(str_replace([" ", "　"], "", $_POST['pati-mail']));
  $post = filter_var($_POST['pati-mail'], FILTER_VALIDATE_EMAIL);
  if ($_POST['pati-mail'] !== '' && $post === false) {
    $_SESSION['inputErr']['pati-mail']
      = '正しいメールアドレスを入力してください。';
    $_SESSION['inputHold']['pati-mail'] = $_POST['pati-mail'];
  }

  if (count($_SESSION['inputErr'])) {
    $bool = false;
  } else {
    $bool = true;
  }
  return $bool;
}

/**
 * <strong></strong>で包み、返す関数。inputチェックのエラー表示で使用。
 */
function tagStrong($str, $id = '') {
  $html = '';
  if ($str && $id) {
    $html = "<strong id=\"{$id}\">" . $str . '</strong>';
  } elseif ($str) {
    $html = '<strong>' . $str . '</strong>';
  }
  return $html;
}

/**
 * DB接続用の関数
 *
 * DBに接続し、DBハンドラを返す。
 * DB接続解除はメインスクリプト等で別途すること。
 */
function connectDB(): PDO {
  // DB設定
  $host = $GLOBALS['rsv']['db']['host'];
  $dbName = $GLOBALS['rsv']['db']['name'];
  $user = $GLOBALS['rsv']['db']['username'];
  $pass = $GLOBALS['rsv']['db']['pass'];

  // DB接続
  try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
  } catch (PDOException $e) {
    print 'DB接続エラー: ' . $e->getMessage();
    exit();
  }

  // DBエラー時例外設定
  $dbh-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // フェッチモード設定:オブジェクトとしての行
  $dbh-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  return $dbh;
}

/**
 * 表示する1週間を設定する関数
 *
 * (スタート日*ページ番号)の日付から7日分のDateObjectを配列にして返す。
 */
function setDispDate(DateTime $startDayObj, int $pageCt): array {
  $add = $pageCt * 7;
  $dateObj = $startDayObj->modify("+$add day");
  $arr = [];
  for ($i = 0; $i <= 6; $i++) {
    $arr[$i] = clone $dateObj;
    $dateObj = $dateObj->modify("+1 day");
  }
  return $arr;
}

/**
 * ヘッダーとなる予約時間を設定する関数
 *
 * 30分おきの予約時間文字列を配列にして返す。
 */
function setTimeTable(): array {
  $start = new DateTime('09:30');
  $addMinute = 30;
  $arr = [];
  for ($i = 0; $i <= 20; $i++) {
    $arr[$i] = $start->format('H:i');
    $start->modify("+$addMinute minute");
  }
  return $arr;
}

/**
 * 祝日かを判定する関数
 *
 * 祝日テーブルに問い合わせて、T/Fを返す。
 */
function isPublicHoliday(PDO $dbh, DateTime $dateObj): bool {
  $inSqlTableName = 'public_holiday';
  $inSqlYmd = $dateObj->format('Y-m-d');
  $sql = "SELECT * FROM $inSqlTableName WHERE date = '$inSqlYmd'";
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();

  if (count($result) === 0) {
    return false;
  } else {
    return true;
  }
}

/**
 * 私的な休日かを判定する関数
 *
 * 私的な休日テーブルに問い合わせて、T/Fを返す。
 */
function isPrivateHoliday(PDO $dbh, DateTime $dateObj): bool {
  $inSqlTableName = 'private_holiday';
  $inSqlYmd = $dateObj->format('Y-m-d');
  $sql = "SELECT * FROM $inSqlTableName WHERE date = '$inSqlYmd'";
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();

  if (count($result) === 0) {
    return false;
  } else {
    return true;
  }
}

/**
 * 曜日を日本語に変換する関数
 *
 * 0(日)~6(土)を変換して返す
 */
function convJpnWeek(int $weekNum): string {
  $week = [];
  $week = ['日', '月', '火', '水', '木', '金', '土'];
  $str = $week[$weekNum];
  return $str;
}

/**
 * 表示記号を変換する関数
 *
 * display_status(allowed, disallowed, closed)の値を画面表示用の記号に変換して返す。
 */
function convDispStatus(string $status): string {
  switch ($status) {
    case 'allowed':
      $str = '〇';
      break;
    case 'disallowed':
      $str = '×';
      break;
    case 'closed':
      $str = '‐';
      break;
  }
  return $str;
}
