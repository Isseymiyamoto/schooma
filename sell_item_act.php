<?php
session_start();
include('funcs.php');
chkSsid();

$i_name = $_POST["i_name"];
$i_price = $_POST["i_price"];
$u_id = $_SESSION["u_id"];
$i_bio = $_POST["i_bio"];
$i_image = $_POST["i_image"];
$i_pdf = $_POST["i_pdf"];
$m_id = $_SESSION["m_id"];

$pdo = db_conn();
//３．データ登録SQL作成
$sql = "INSERT INTO schooma_sell_table (i_name, i_price, u_id, i_bio, i_image, i_pdf, m_id)
  VALUES(:i_name, :i_price, :u_id, :i_bio, :i_image, :i_pdf, :m_id)";  //セキュリティ対策
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':i_name', $i_name, PDO::PARAM_STR);
$stmt->bindValue(':i_price', $i_price, PDO::PARAM_STR);
$stmt->bindValue(':u_id', $u_id, PDO::PARAM_STR);
$stmt->bindValue(':i_bio', $i_bio, PDO::PARAM_STR);
$stmt->bindValue(':i_image', $i_image, PDO::PARAM_STR);
$stmt->bindValue(':i_pdf', $i_pdf, PDO::PARAM_STR);
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
