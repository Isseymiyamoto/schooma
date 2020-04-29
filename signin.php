<?php
session_start();
include('funcs.php');
chkSsid();
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>SchooMaにサインインしよう</title>
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/signin.css" />
</head>

<body>
  <header>
    <div class="logo">
      <span class="logoD">Schoo</span><span class="logoH">Ma</span>
    </div>
    <div class="shinki">
      <span><a href="market_regi.php">マーケットプレイス新規作成</a></span>
    </div>
  </header>

  <main>

    <div class="kakoi">
      <div class="input-mail">
        <h1>既存のマーケットプレイスに参加する</h1>
        <span>友人や知人が作成したマーケットプレイスのIDを入力してください</span>
        <form action="signin_next.php" method="post">
          <input type="text" placeholder="コミュニティマーケットプレイスのIDを入力してください" id="comMaId" name="m_id" /><br />

          <input type="submit" class="sendBtn" value="送信する →" />
        </form>
        <span>マーケットプレイスの ID が不明な場合</span><br />
        <span><a href="#">マーケットプレイスを探す</a></span>
      </div>
    </div>
  </main>
</body>

</html>