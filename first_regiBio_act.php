<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
session_start();

$m_bio = $_POST["m_bio"];
$m_id = $_SESSION["m_id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
// $sql = "UPDATE schooma_market_table (m_name, m_id, m_maker_id)
//   VALUES(:m_name, :m_id, :m_maker_id)";  
$stmt = $pdo->prepare("UPDATE schooma_market_table SET m_bio=:m_bio WHERE m_id=:m_id");
$stmt->bindValue(':m_bio', $m_bio, PDO::PARAM_STR);
$stmt->bindValue(':m_id', $m_id, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error();
} else {
  //５．top.phpへリダイレクト
  redirect("signin.php");
}
