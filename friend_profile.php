<?php
// ini_set('display_errors', "On");
session_start();
include('funcs.php');
chkSsid();


$u_id = $_GET["u_id"];

//2. DB接続します
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM schooma_user_table WHERE u_id=:u_id");
$stmt->bindValue(":u_id", $u_id, PDO::PARAM_STR);
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
  <link rel="stylesheet" href="css/user_regi.css" />
</head>

<body>
  <header>
    <div class="logo">
      <span class="logoD">Schoo</span><span class="logoH">Ma</span>
    </div>
    <div class="shinki">
      <span><a href="signin.php">マーケットに戻る</a></span>
    </div>
  </header>

  <main>
    <div class="kakoi">
      <div class="input-mail" style="height: 400px">
        <h1>友達のユーザー情報</h1>

        <div class="table">
          <table>
            <tr>
              <td class="hidari">ユーザー名</td>
              <td>
                <p><?= $row['u_name'] ?></p>
              </td>
            </tr>
            <tr>
              <td class="hidari">メールアドレス</td>
              <td>
                <p><?= $row['u_id'] ?></p>
              </td>
            </tr>
            <tr>
              <td class="hidari">自己紹介</td>
              <td>
                <p><?= $row['u_bio'] ?></p>
              </td>
            </tr>
          </table>
        </div>


      </div>
    </div>
  </main>
</body>

</html>