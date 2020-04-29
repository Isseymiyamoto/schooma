<?php
session_start();
include('funcs.php');
chkSsid();



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/sell_item.css" />
  <title>アイテムを販売しよう</title>
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
      <div class="input-mail">
        <h1>新規アイテム販売登録画面</h1>
        <span>販売したいアイテムの情報を入力してください</span>
        <form action="sell_item_act.php" method="post">
          <div class="table">
            <table>
              <div class="hide-part">
                <tr>
                  <td class="hidari">アイテム名</td>
                  <td>
                    <input type="text" name="i_name" placeholder="アイテム名をご入力ください" />
                  </td>
                </tr>
                <tr>
                  <td class="hidari">プライス</td>
                  <td>
                    <input type="text" name="i_price" placeholder="販売価格を決めましょう" />
                  </td>
                </tr>
                <tr>
                  <td class="hidari">販売者ID</td>
                  <td>
                    <p class="maker_name"><?= $_SESSION['u_id'] ?></p>
                  </td>
                </tr>
                <tr>
                  <td class="hidari">アイテム概要</td>
                  <td>
                    <input type="text" name="i_bio" placeholder="簡単にアイテム概要をご入力ください" />
                  </td>
                </tr>
                <tr>
                  <td class="hidari">アイテムイメージ（プレビュー）</td>
                  <td>
                    <input type="file" name="i_image" />
                  </td>
                </tr>
                <tr>
                  <td class="hidari">アイテム本体
                  </td>
                  <td>
                    <input type="file" name="i_pdf" />
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

</html>