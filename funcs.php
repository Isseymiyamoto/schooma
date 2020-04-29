<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
  try {
    return new PDO('mysql:dbname=i-btes_schooma_db;charset=utf8;host=mysql57.i-btes.sakura.ne.jp', 'i-btes', 'zof67082150');
    // return new PDO('mysql:dbname=schooma_db;charset=utf8;host=localhost', 'root', 'root');
  } catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
  }
}

//SQLエラー
function sql_error()
{
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:" . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
  header("Location: " . $file_name);
  exit();
}

//セッションチェック関数
function chkSsid()
{
  if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
    //if文の条件式→変数がセットされていること、そして NULL でないことを検査するissetを用いて、ユーザーがchk_ssidを持っているか。or chk_ssidはsession_idと一致しているか
    exit("Login Error!");
  } else {
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}
