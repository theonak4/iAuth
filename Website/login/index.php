<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster|Russo+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Racing+Sans+One" rel="stylesheet">
<title>iAuth Account Login</title>
<?php

// ALERT CHECKS
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

/* GRAB URL */ $url = $_SERVER["REQUEST_URI"];
error_reporting(0);
$cookie;
if($_COOKIE['p89_email'] == null) {
  $cookie = null;
} else {
  $cookie = decrypt(decrypt($_COOKIE['p89_email']));
}

?>


<style>
body,html {
  background: rgb(27,27,36);
   color: rgb(138,141,183);
  font-family: Roboto;
  font-weight: lighter;
}
.background {
  position: fixed;
  z-index: -1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.logincontent {
  width: 500px;
  height: 550px;

  margin: 50px;
  background: rgb(40,41,54);
  border-top: 0;
  background: white;


}

.loggedout {
  width: 500px;
  height: 50px;
  border: 1px solid rgb(91,145,217);
  color: rgb(91,145,217);
  font-family: arial;
  padding: 10px;
  font-size: 19px;
}

.mhub {
  width: 500px;
  background: rgba(91,145,217, 0.1);
  border: 1px solid rgb(91,145,217);
  color: rgb(91,145,217);
  font-family: arial;
  padding: 10px;
  font-size: 19px;
}

.fillin {
  width: 500px;
  background: rgba(255,77,77, 0.1);
  border: 1px solid #ff4d4d;
  color: rgb(255,77,77);
  font-family: arial;
  padding: 10px;
  font-size: 19px;
}



input[type='text'] {
  width: 300px;
  padding-left: 7px;
  border: 1px solid rgb(138,141,183);
  padding: 10px;
  color: rgb(138,141,183);
  outline: none;
  padding-left: 1px;
  font-size: 20px;
  width: 400px;
  border-left: 0;
  border-right: 0;
  border-top: 0;
  background: transparent;
}

input[type='password'] {
  width: 300px;
  padding-left: 7px;
  border: 1px solid rgb(138,141,183);
  padding: 10px;
  color: rgb(138,141,183);
  outline: none;
  padding-left: 1px;
  font-size: 20px;
  width: 400px;
  border-left: 0;
  border-right: 0;
  border-top: 0;
  background: transparent;
}

.border-top {
  position: relative;
  top: 0;
  left: 0;
  background: linear-gradient(to right, #3d7ce2, #ad52e5);
  height: 5px;
  width: 100%;
}

.ad {
  position: fixed;
  top: 100px;
  z-index: -1;
  border: 1px solid #d3d3d3;
  width: 1700px;
  left: 50px;
  height: 750px;
  margin-left: 50px;
}

.footer {
  bottom: 0;
  left: 0;
  position: fixed;
  height: 40px;
  width: 100%;
  padding: 10px;
  padding-right: 30px;
  background: rgb(40,41,54);
}

.getstarted {
  position: fixed;
  top: 840px;
  left: 99px;
}

.error-password {
  padding: 7px;
  width: 150px;
  background: #f44242;
  position: fixed;
  z-index: 999;
  color: white;
  border: 1px solid #f44242;
  border-radius: 5px;
  margin-top: 211px;
  margin-left: 410px;
  visibility: hidden;
  transition: visibility 1s;
}

.arrow-left-error-password {
  width: 0;
  height: 0;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  position: fixed;
  margin-top: 218.5px;
  margin-left: 400px;
  border-right:10px solid #f44242;
  visibility: hidden;
  transition: visibility 1s;
}

input[type='checkbox'] {
  display: none;
}

input[type="checkbox"] + label span {
  display: inline-block;
  width: 29px;
  height: 29px;
  margin: -2px 5px 0 0;
  vertical-align: middle;
  background: #36374a;
  border: 0;
  border-radius: 5px;
  cursor: pointer;
}
input[type="checkbox"]:checked + label span {
  background: rgb(74, 161, 114);
  border: 3px solid #36374a;
}

.cancel_btn {
  color: #ff4d4d;
  border: 1px solid #ff4d4d;
  background: rgba(255,77,77, 0.1);
  padding: 10px;
  width: 150px;
}


</style>
<script>


window.onload = function() {
  checkError();
  var emailcookie = "<?php echo $cookie ?>";
  document.getElementById("email").value = emailcookie;
  document.getElementById("email").style.color = "rgb(74, 161, 114)";
  checkError();
}

function checkError() {
  var url = "<?php echo $url ?>";
  if(url.includes('?incorrect=true') == true) {
    document.getElementById("password").style.borderColor = "#ff4d4d";
    document.getElementById("password_Tag").style.color = "#ff4d4d";
    document.getElementById("password_Tag").innerHTML = "INCORRECT PASSWORD";
  } else if(url.includes('?logout=true') == true) {
    document.getElementById("loggedout").style.display = "block";
  } else if(url.includes('?mhubauth=true') == true) {
    document.getElementById("mhub").style.display = "block";
    document.getElementById("login-form").action = "/e890/iauth/account/login/mhub-auth.php";
    document.getElementById("logincontent").style.marginTop = "60px";
    document.title = "MHub Login";
        document.getElementById("btn89_cancel").style.display = "block";
  } else if(url.includes('?fillin=true') == true) {
    document.getElementById("fillin").style.display = "block";
    document.getElementById("email_Tag").style.color = "#ff4d4d";
    document.getElementById("email").style.borderColor = "#ff4d4d";
    document.getElementById("password_Tag").style.color = "#ff4d4d";
    document.getElementById("password").style.borderColor = "#ff4d4d";
  }
}

</script>
<div class="arrow-left-error-password" id="arrow-left-error-password"></div>
<div class="error-password" id="error-password">
  <center>Incorrect Password</center>
</div>
<center>
<div class="logincontent" id="logincontent" style="box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12); background: rgb(40,41,54);   margin-top: 200px;">
  <div class="border-top"></div><br>
  <center><h1 style="color: rgb(138,141,183); font-family: Russo One; font-size: 50px; margin-bottom: 0;"><span style="font-family: lobster">i</span>Auth</h1><br><h3 style="margin-top: 5px;">Login to your Account</h3>
    <br>
<form id="login-form" action="check-login.php" method="POST">
  <h6 id="email_Tag" style="margin: 0; float: left; margin-left: 50px; position: fixed; padding-bottom: 10px;">EMAIL</h6>
  <input id="email" type="text" placeholder="" onfocus="" name="Email" style="margin-top: 10px; margin-bottom: 20px;" autocomplete="off" onkeyup="this.style.color='rgb(138,141,183)'"></input>
    <h6 id="password_Tag" style="margin: 0; float: left; margin-left: 50px; position: fixed; padding-bottom: 10px;">PASSWORD</h6>
  <input id="password" placeholder="" type="password" style="margin-top: 10px;" name="Password" autocomplete="off"></input>
  <br>
  <br>
  <button onclick="test()" type="submit" class="btn btn-primary" style="padding: 5px; width: 300px; font-size: 20px; background: rgb(74, 161, 114); border: 1px solid rgb(74, 161, 114);">Login</button>
</form>

 <div style="float: left; margin-left: 100px;">
  <input type="checkbox" id="c1" name="cc" />
  <label for="c1"><span></span> <strong>Remember Me </strong></label>
</div>
  <br>
  <br>
  <br>
  <div style="background: rgba(0,0,0, 0.4); width: 500px; height: 100px; position: fixed; z-index: 0;"></div>
  </center>
    <h4 style="color: #fce449; font-weight: lighter; float: left; margin-left: 2.5%; margin-top: 16px; margin-bottom: 0;">Maintenance Notice</h4>
    <h5 style="color: rgb(138,141,183); font-weight: lighter; float: left; margin-left: 2.5%; float: left; text-align: left; width: 95%">Our databases and login systems will be down from 6:00 PM (PST) to 9:00 PM (PST) for critical updates. Thank you for your understanding.</h5>
</div>
</center>

<center>
  <div class="loggedout" id="loggedout" style="display: none;">
    You have been successfully logged out!
  </div>
</center>

<center>
  <div class="mhub" id="mhub" style="display: none;">
    Please log back in to <br> access the MHub Admin Panel.
  </div>
</center>

<center>
  <div class="fillin" id="fillin" style="display: none;">
    Please fill in the inputs <br> highlighted in red.
  </div>
</center>
<br>
<br>
<center>
  <button class="cancel_btn" id="btn89_cancel" onclick="window.location.href = 'closemhubauth.php'" style="display: none;">
    Cancel
  </button>
</center>
<!--
<div class="ad">

</div>
-->


<div class="footer">
  <span style="float: right;"> <a href="/iauth/privacy" style="color: rgb(91,145,217);">Privacy Policy</a> - <a style="color:rgb(91,145,217);">For Developers</a> </span>
  <span style="float: left;">&copy; & &trade; 2017 <span style="font-family: 'Racing Sans One'; font-weight: bold; font-style: italic; letter-spacing: 0.5px;">unix</span> interactive</span>
</div>
