<?php

session_start();

function encrypt($data) {
  $cryptKey = 'hY71B111v7d8YDH9xT809u';
  $dataencoded = base64_encode(mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5($cryptKey), $data, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
  return( $dataencoded );
}
function decrypt($data) {
    $cryptKey = 'hY71B111v7d8YDH9xT809u';
    $datadecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $data ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $datadecoded );
}


//GRAB USER INPUTS
$email = encrypt($_POST["Email"]);
$password = encrypt($_POST["Password"]);

$_SESSION["email"] = encrypt($email);
$_SESSION["password"] = encrypt($password);

//SESSION VARIABLES
$_SESSION["email"] = encrypt($email);
$_SESSION["loggedin"];


if($email == "" || $password == "") {
  //EMPTY VALUE ERROR
  header("Location: http://localhost/e890/unixinteractive/login/?se=FillIn");
  $_SESSION["loggedin"] = false;
} else {
	$conn = new mysqli("127.0.0.1", "root", "e8jj3jhhaw", "iauth");
  $check = "SELECT * from user_accounts WHERE email LIKE '{$email}' AND password LIKE '{$password}'";
  $result = $conn->query($check);






  	if (!$result->num_rows >= 1) {


    // FALSE
    $_SESSION["loggedin"] = false;
    echo "false";
      header("Location:  http://localhost/e890/iauth/account/login/new.php?incorrect=true");


    } else {


      $privilege;
      while($value = $result->fetch_assoc()) {
        $privilege = $value["privilege"];
      }

        $_SESSION["user"] = encrypt($email);
        $_SESSION["privilege"] = encrypt($privilege);
      $_SESSION["loggedin"] = true;

      setcookie('p89_email', encrypt($email));
      echo "true";

header("Location: http://localhost/e890/newbls/adminpanel/new/loadingpage.php?loginrealm=unixmain");







  }
}


 ?>
