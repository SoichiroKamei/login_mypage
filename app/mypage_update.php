<?php
require "DB.php";
mb_internal_encoding("utf8");
session_start();

try {
  $db = new DB();
  $pdo = $db->connect();
} catch(PDOException $e) {
  die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインしてください。</p>
  <a href='http://localhost/login_mypage/web/php/login.php'>ログイン画面へ</a>");
}

$stmt = $pdo->prepare("update login_mypage set name = ?, mail = ?, password = ?, comments = ?  where id = ? ");
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);
$stmt->execute();

$stmt = $pdo->prepare("SELECT * FROM login_mypage where name = ? && mail = ? && password = ? && comments = ?;");
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
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

header('Location: http://localhost/login_mypage/web/php/mypage.php');
