<?php
// ini_set('display_errors', "On");
session_start();
include('funcs.php');
chkSsid();


$u_id = $_GET["u_id"];

//2. DB接続します
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM schooma_user_table WHERE u_id=:u_id");
$stmt->bindValue(":u_id", $u_id, PDO::PARAM_INT);
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
      <span><a href="index.php">トップページに戻る</a></span>
    </div>
  </header>

  <main>
    <div class="kakoi">
      <div class="input-mail">
        <h1>ユーザー登録情報の更新</h1>
        <span>ご自身の情報を入力してください</span>
        <form action="profile_update.php" method="post">
          <div class="table">
            <table>
              <tr>
                <td class="hidari">ユーザー名</td>
                <td>
                  <input type="text" name="u_name" value="<?= $row['u_name'] ?>" />
                </td>
              </tr>
              <tr>
                <td class="hidari">メールアドレス</td>
                <td>
                  <input type="text" name="u_id" placeholder="ユーザーIDとなります" value="<?= $row['u_id'] ?>" />
                </td>
              </tr>
              <tr>
                <td class="hidari">パスワード</td>
                <td>
                  <input type="password" name="u_pw" placeholder="パスワードをご入力ください" value="<?= $row['u_pw'] ?>" />
                </td>
              </tr>
              <tr>
                <td class="hidari">自己紹介</td>
                <td>
                  <input type="text" name="u_bio" placeholder="簡単に自己紹介を書きましょう" value="<?= $row['u_bio'] ?>" />
                </td>
              </tr>
            </table>
          </div>
          <input type="submit" value="更新する" id="resiBtn">
        </form>

      </div>
    </div>
  </main>
</body>

</html>