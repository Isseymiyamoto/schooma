<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$u_name = $_POST["u_name"];
$u_id = $_POST["u_id"];
$u_pw = $_POST["u_pw"];
$u_bio = $_POST["u_bio"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "INSERT INTO schooma_user_table (u_name, u_id, u_pw, u_bio)
  VALUES(:u_name, :u_id, :u_pw, :u_bio)";  //セキュリティ対策
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':u_name', $u_name, PDO::PARAM_STR);
$stmt->bindValue(':u_id', $u_id, PDO::PARAM_STR);
$stmt->bindValue(':u_pw', $u_pw, PDO::PARAM_STR);
$stmt->bindValue(':u_bio', $u_bio, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error();
} else {
  //５．top.phpへリダイレクト
  redirect("login.php");
}
