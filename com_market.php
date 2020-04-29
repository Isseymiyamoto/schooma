<?php
session_start();
include('funcs.php');
chkSsid();

$m_id = $_GET['m_id'];
$u_id = $_GET['u_id'];
$_SESSION["m_id"] = $_GET['m_id'];

//2. DB接続します
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM schooma_market_table WHERE m_id=:m_id");
$stmt->bindValue(":m_id", $m_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  sql_error();
} else {
  $row = $stmt->fetch();
}


// ユーザーとマーケットを紐付ける
$stmt1 = $pdo->prepare("SELECT count(*) schooma_user_market_table WHERE u_id=:u_id AND m_id=:m_id");  //セキュリティ対策
$stmt1->bindValue(':u_id', $u_id, PDO::PARAM_STR);
$stmt1->bindValue(':m_id', $m_id, PDO::PARAM_STR);
$status1 = $stmt1->execute();

if ($status1 == 0) {
  $sql2 = "INSERT INTO schooma_user_market_table (u_id, m_id)
  VALUES(:u_id, :m_id)";  //セキュリティ対策
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->bindValue(':u_id', $u_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt2->bindValue(':m_id', $m_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $status2 = $stmt2->execute();
}

// if ($status2 == false) {
//   sql_error();
// }

// schooma_user_market_tableからそのマーケットにひもづくユーザーを全部引っ張ってくる。かつschooma_user_tableから紐づいたユーザーの情報を結合する
$stmt3 = $pdo->prepare("SELECT schooma_user_market_table.m_id , schooma_user_table.u_name, schooma_user_table.u_coin, schooma_user_table.u_bio, schooma_user_table.u_id FROM schooma_user_market_table JOIN schooma_user_table USING (u_id) WHERE m_id=:m_id");
// $stmt3 = $pdo->prepare("SELECT schooma_user_market_table.m_id , schooma_user_table.u_name FROM schooma_user_market_table JOIN schooma_user_table ON schooma_user_market_table.u_id = schooma_user_table.u_mail WHERE m_id=:m_id");
// $stmt3->bindValue(':u_id', $u_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt3->bindValue(':m_id', $m_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status3 = $stmt3->execute();

if ($status == false) {
  $error = $stmt3->errorInfo();
  exit("SQLError:" . $error[2]);
}

// ユーザー一覧部分を作る
$view = "";
$view .= "<div class='users1'>";
while ($strong = $stmt3->fetch(PDO::FETCH_ASSOC)) {
  $view .= "<p>";
  $view .= '<a href="friend_profile.php?u_id=' . $strong['u_id'] . '">';
  $view .= $strong["u_name"] . "さん</a></p>";
}
$view .= "</div>";

// ログインユーザーの情報
$sql4 = "SELECT * FROM schooma_user_table WHERE u_id=:u_id";
$stmt4 = $pdo->prepare($sql4);
$stmt4->bindValue(':u_id', $u_id, PDO::PARAM_STR);
$status4 = $stmt4->execute();

if ($status == false) {
  sql_error();
}
//4. 抽出データ数を取得
$val = $stmt4->fetch();

//schooma_user_market_tableからログインユーザーが入っているidだけ取り出して、そのマーケット名をとる
$stmt5 = $pdo->prepare("SELECT schooma_market_table.m_name , schooma_market_table.m_id FROM schooma_user_market_table JOIN schooma_market_table USING (m_id) WHERE u_id=:u_id");
$stmt5->bindValue(':u_id', $u_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status5 = $stmt5->execute();

if ($status == false) {
  $error = $stmt5->errorInfo();
  exit("SQLError:" . $error[2]);
} else {
  $market = "";
  while ($mmm = $stmt5->fetch(PDO::FETCH_ASSOC)) {
    // $market .= "<div class='box1'>" . $mmm["m_name"] . "</div>";
    $market .= "<div class='box1'>";
    $market .= '<a href="com_market.php?m_id=' . $mmm['m_id'] . '&u_id=' . $u_id . '">' . $mmm["m_name"] . "</a></div>";
  }
}

?>





<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/com_market.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title><?= $row["m_name"] ?>へようこそ</title>
</head>

<body>
  <div class="flex-contents">
    <div class="market-bar">
      <?= $market ?>
      <div class="plus_market" id="make_event">+</div>

    </div>
    <div class="menu-bar">
      <div class="user_content">
        <h1><?= $row["m_name"] ?></h1>
        <p>○ <?= $_SESSION["u_name"] ?></p>
        <div class="user_modal">
          <div class="flex-user">
            <img src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt="">
            <span><?= $_SESSION["u_name"] ?></span>
          </div>
          <div class="menu_selcet">
            <ul>
              <li><a href="profile.php?u_id=<?= $u_id ?>">プロフィール&変更</a></li>
              <li id="sell_item">アイテムの販売を行う</li>
              <li>販売アイテムリスト</li>
              <li>購入アイテムリスト</li>
              <li>残高：<?= $val["u_coin"] ?>コイン</li>
              <li>メンバーを招待</li>
              <li><a href="logout.php">ログアウト</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="user-meibo">
        <div class="users">
          <p>USERS 一覧</p>
          <div class="users1">
            <?= $view ?>
          </div>
        </div>
      </div>
    </div>
    <div class="item-contents">
      <div class="header-logo">
        <h1>アイテム一覧</h1>
        <div class="item-list">
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>
          <div class="one-item">
            <img src="img/test1.jpeg" alt="" class="photos">
            <div class="info">
              <a href="item_detail.php" class="purchase">詳細をみる</a>
              <p>item: MySQLチートシート</p>
              <p>Maker: スギエモンさん</p>
              <p>Price: 300コイン</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  <script>
    $("#make_event").on("click", function() {
      location.href = "signin.php";
    })

    $('.user_content').on('click', function() {
      $('.user_modal').fadeIn('slow');
    })

    $('#sell_item').on('click', function() {
      location.href = "sell_item.php";
    })

    $('.photos').on('hover', function() {
      $(".purchase").fadeIn("slow");
    })

    $(document).on('click', function(e) {
      // ２．クリックされた場所の判定
      if (!$(e.target).closest('.user_modal').length && !$(e.target).closest('.user_content').length) {
        $('.user_modal').fadeOut();
      }
      // else if ($(e.target).closest('.user_content').length) {
      //   // ３．ポップアップの表示状態の判定
      //   if ($('.user_modal').is(':hidden')) {
      //     $('.user_modal').fadeIn();
      //   } else {
      //     $('.user_modal').fadeOut();
      //   }
      // }
    });
  </script>


</body>

</html>