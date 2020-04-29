<?php
session_start();
include('funcs.php');
chkSsid();
// ini_set('display_errors', "On");
$m_id = $_POST["m_id"];
// $_SESSION['m_id'] = $_POST["m_id"];
// $m_id = $_POST[];

//2. DB接続します
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM schooma_market_table WHERE m_id= :id");
$stmt->bindValue(':id', $m_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  sql_error();
} else {
  $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>SchooMaにサインインしよう</title>
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/signin_next.css" />
</head>

<body>
  <header>
    <div class="logo">
      <span class="logoD">Schoo</span><span class="logoH">Ma</span>
    </div>
    <div class="shinki">
      <span><a href="index.php">トップに戻る</a></span>
    </div>
  </header>

  <main>

    <div class="kakoi">
      <div class="input-mail">
        <h1>マーケットプレイスの確認</h1>
        <span>マーケット情報はあなたが入ろうとしたものと一致していましたか？</span><br>
        <span style="color:red;">一致していた場合、参加ボタンをクリックしてください</span>
        <div class="flex-content">
          <div class="flex1">
            <p class="hidari">マーケット名</p>
            <div class="mkakoi">
              <p><?= $row['m_name'] ?></p>
            </div>
          </div>

          <div class="flex1">
            <p class="hidari">マーケット概要</p>
            <div class="mkakoi">
              <p><?= $row['m_bio'] ?></p>
            </div>
          </div>
        </div>
        <form action="com_market.php" method="get">
          <input type="hidden" name="m_id" value="<?= $m_id ?>">
          <input type="hidden" name="u_id" value="<?= $_SESSION['u_id'] ?>">
          <input class="loginBtn" type="submit" value="参加する">
        </form>
      </div>
    </div>
  </main>
</body>

</html>