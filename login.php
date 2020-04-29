<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>SchooMaにサインインしよう</title>
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/login.css" />
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
        <h1 class="loginForm">ログイン画面 -login-</h1>
        <p class="caution">登録時に入力いただいたユーザーIDとパスワードを入力してください</p>
        <form action="login_act.php" method="post" id="login">
          <div class="table">
            <table>
              <tr>
                <td class="hidari">ユーザーID</td>
                <td class="migi">
                  <input type="text" name="u_id" placeholder="ユーザーIDをご入力ください。登録いただいたメールアドレスです。" />
                </td>
              </tr>
              <tr>
                <td class="hidari">パスワード</td>
                <td class="migi">
                  <input type="password" name="u_pw" placeholder="パスワードをご入力ください" />
                </td>
              </tr>

            </table>
          </div>

          <input class="loginBtn" type="submit" value="ログイン">
        </form>
      </div>

    </div>
  </main>
</body>

</html>