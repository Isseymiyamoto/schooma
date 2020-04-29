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
  <link rel="stylesheet" href="css/market_regi.css" />
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
        <h1>新規マーケットプレイス登録画面</h1>
        <span>マーケットの情報を入力してください</span>
        <form action="market_regi_act.php" method="post">
          <div class="table">
            <table>
              <div class="hide-part">
                <tr>
                  <td class="hidari">マーケット名</td>
                  <td>
                    <input type="text" name="m_name" placeholder="マーケット名をご入力ください" />
                  </td>
                </tr>
                <tr>
                  <td class="hidari">マーケットID</td>
                  <td>
                    <input type="text" name="m_id" placeholder="他ユーザーがサインインするために必要なidとなります" />
                  </td>
                </tr>
                <tr>
                  <td class="hidari">マーケット作成者ID</td>
                  <td>
                    <p class="maker_name"><?= $_SESSION['u_id'] ?></p>
                  </td>
                </tr>
              </div>

            </table>
          </div>
          <input type="submit" value="登録する" id="resiBtn">
        </form>

      </div>
    </div>
  </main>
</body>

</html>