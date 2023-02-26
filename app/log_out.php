<?php
session_start();
session_destroy();

header("Location: http://localhost/login_mypage/web/php/login.php");
?>