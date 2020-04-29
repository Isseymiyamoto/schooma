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
      <div class="input-mail" style="height: 600px">
        <h1>新規ユーザー登録画面</h1>
        <span>ご自身の情報を入力してください</span>
        <form action="user_regi_act.php" method="post">
          <div class="table">
            <table>
              <tr>
                <td class="hidari">ユーザー名</td>
                <td>
                  <input type="text" name="u_name" placeholder="ユーザー名をご入力ください" />
                </td>
              </tr>
              <tr>
                <td class="hidari">メールアドレス</td>
                <td>
                  <input type="text" name="u_id" placeholder="ユーザーIDとなります" />
                </td>
              </tr>
              <tr>
                <td class="hidari">パスワード</td>
                <td>
                  <input type="password" name="u_pw" placeholder="パスワードをご入力ください" />
                </td>
              </tr>
              <tr>
                <td class="hidari">自己紹介</td>
                <td>
                  <input type="text" name="u_bio" placeholder="簡単に自己紹介を書きましょう" />
                </td>
              </tr>
            </table>
          </div>
          <input type="submit" value="登録する" id="resiBtn">
        </form>

      </div>
    </div>
  </main>
</body>

</html>