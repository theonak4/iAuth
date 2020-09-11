<?php
session_start();
$_SESSION["loggedin"] = false;
$_SESSION = [];
session_unset();
session_destroy();
header("Location: /e890/iauth/account/login/new.php?logout=true")

 ?>
