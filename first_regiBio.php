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
  <link rel="stylesheet" href="css/first_regiBio.css" />
</head>

<body>
  <header>
    <div class="logo">
      <span class="logoD">Schoo</span><span class="logoH">Ma</span>
    </div>
    <div class="shinki">
      <span><a href="index.php">トップへ戻る</a></span>
    </div>
  </header>

  <main>
    <div class="kakoi">
      <div id="loginForm">
        <h1 class="loginForm">マーケット詳細登録画面</h1>
        <p class="caution"><?= $_SESSION['u_name'] ?>さん、おめでとうございます！！</p>
        <p class="caution"><?= $_SESSION['m_name'] ?>が作成できました！詳細を入力して、マーケットを公開しましょう！</p>
        <form action="first_regiBio_act.php" method="post" id="login">
          <div class="table">
            <table>
              <tr>
                <td class="hidari">マーケット概要</td>
                <td>
                  <textarea name="m_bio" id="m_bio" cols="30" rows="20" placeholder="このコミュニティマーケットは誰を対象にしているのか、どのような情報物を販売する目的で設立したかなどマーケットの概要をご入力ください"></textarea>
                </td>
              </tr>

            </table>
          </div>

          <input class="loginBtn" type="submit" value="公開する">
        </form>
      </div>

    </div>
  </main>
</body>

</html>
