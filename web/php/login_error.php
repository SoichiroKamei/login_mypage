<?php
session_start();

if(isset($_SESSION['mail'])) {
  header("Location: http://localhost/login_mypage/web/php/mypage.php");
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>
  <header>
    <img src="../../image/4eachblog_logo.jpg">
    <div class="login"><a href="login.php">ログイン</a></div>
  </header>

  <main>
    <form action="mypage.php" method="post" enctype="multipart/form-data">
      <div class="form_contents">
        <div class="error_text">
          <label>メールアドレスまたはパスワードが間違っています。</label>
        </div>
        <div class="mail">
          <label>メールアドレス</label><br>
          <input type="text" class="formbox" size="40" name="mail">
        </div>
        <div class="password">
          <label>パスワード</label><br>
          <input type="password" class="formbox" size="40" name="password">
        </div>
        <div class="keep_login">
          <label><input type="checkbox" class="keep_login_button" size="40" name="login_keep" value="login_keep" <?php if(isset($_COOKIE['login_keep'])){ echo "checked='checked'";
            }?>>
          ログイン状態を保持する</label>
        </div>
        <div class="login_button">
          <input type="submit" class="submit_button" size="35" value="ログイン">
        </div>
      </div>
    </form>
  </main>

  <footer>
    © 2018 InterNous.inc. All rights reserved
  </footer>


</body>

</html>