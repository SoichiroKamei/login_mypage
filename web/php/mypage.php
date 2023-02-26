<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['mail'])) {
  try {
    $pdo = new PDO("mysql:dbname=lesson1; host=localhost;","root","");
  } catch(PDOException $e) {
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインしてください。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>");
  }
  
  $stmt = $pdo->prepare("SELECT * FROM login_mypage WHERE mail = ? && password = ?;");
  $stmt->bindValue(1,$_POST['mail']);
  $stmt->bindValue(2,$_POST['password']);
  $stmt->execute();
  $pdo = NULL;
  
  foreach ($stmt as $row) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
  }
  
  if(empty($_SESSION['mail'] || $_SESSION['password'])) {
    header("Location:login_error.php");
  }
  
  if(isset($_POST['login_keep'])) {
    $_SESSION['login_keep'] = $_POST['login_keep'];
  }
}

if(isset($_SESSION['mail']) && isset($_SESSION['login_keep'])) {
  setcookie('mail', $_SESSION['mail'], time()+60*60*24*7);
  setcookie('password', $_SESSION['password'], time()+60*60*24*7);
  setcookie('login_keep', $_SESSION['login_keep'], time()+60*60*24*7);
  }elseif(empty($_SESSION['login_keep'])) {
  setcookie('mail', time()-1);
  setcookie('password', time()-1);
  setcookie('login_keep', time()-1);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" type="text/css" href="../css/mypage.css">
</head>

<body>
  <header>
    <img src="../../image/4eachblog_logo.jpg">
    <div class="login"><a href="../../app/log_out.php">ログアウト</a></div>
  </header>

  <main>
    <div class="confirm">
      <h1>会員情報</h1>
      <p class="greet">こんにちは！ <?php echo $_SESSION['name'] ?>さん</p>
      <div class="profile_pic">
          <img src="<?php echo $_SESSION['picture'] ?>">
      </div>
      <div class="basic_info">
        <p>氏名: <?php echo $_SESSION['name'] ?></p>
        <p>メール: <?php echo $_SESSION['mail'] ?></p>
        <p>パスワード: <?php echo $_SESSION['password'] ?></p>
      </div>
      <div class="comments">
          <?php echo $_SESSION['comments'] ?>
      </div>
        <div class="button">
          <form action="mypage_hensyu.php">
            <input type="submit" class="edit_button" value="編集する">
          </form>
        </div>
  </main>
  <footer>
    © 2018 InterNous.inc. All rights reserved
  </footer>
</body>

</html>