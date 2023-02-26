<?php
mb_internal_encoding("utf8");
session_start();
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
    <div class="login"><a href="login.php">ログイン</a></div>
  </header>

  <main>
    <div class="confirm">
      <h1>会員情報</h1>
      <p class="greet">こんにちは！
        <?php echo $_SESSION['name'] ?>さん
      </p>
      <div class="profile_pic">
        <img src="<?php echo $_SESSION['picture'] ?>">
      </div>
      <form action="../../app/mypage_update.php" method="post" enctype="multipart/form-data">
        <div class="basic_info">
          <p>氏名: <input type="text" class="formbox" size="40" value="<?php echo $_SESSION['name'] ?>" name="name" required></p>
          <p>メール: <input type="text" class="formbox" size="40" value="<?php echo $_SESSION['mail'] ?>" name="mail"
              pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></p>
          <p>パスワード: <input type="password" class="formbox" size="40" value="<?php echo $_SESSION['password'] ?>"  name="password"
              pattern="^[a-zA-Z0-9]{6,}$" required></p>
        </div>
        <div class="comments">
          <textarea rows="5" cols="45" name="comments"><?php echo $_SESSION['comments'] ?></textarea>
        </div>
        <div class="button">
            <input type="submit" class="edit_button" value="この内容に変更する">
        </div>
      </form>
  </main>

  <footer>
    © 2018 InterNous.inc. All rights reserved
  </footer>

</body>

</html>