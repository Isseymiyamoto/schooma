<?php
// ini_set('display_errors', "On");
session_start();
include('funcs.php');
chkSsid();
//1. POSTデータ取得
$u_name = $_POST["u_name"];
$u_id = $_POST["u_id"];
$u_pw = $_POST["u_pw"];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE schooma_user_table SET u_name=:u_name, u_id=:u_id, u_pw=:u_pw WHERE u_id=:u_id";  //セキュリティ対策
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':u_name', $u_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_id', $u_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_pw', $u_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)s
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error();
} else {
  redirect("login.php");
}
