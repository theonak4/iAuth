<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster|Russo+One" rel="stylesheet">
<script src='Chart.min.js'></script>
<script src='Chart.js'></script>
<!-- START PHP -->
<?php
session_start();

//IDEA: PING MYSQL TO CHECK IF IS UP. IF GOOD, ALLOW CONNECTION CODE
// ADD onUNLOAD  REMOVE VIEWER SCRIPT
// ADD NAMETAGS
// MAX VIEWERS IS 10. KICK PEOPLE JOINING AFTER THAT redirect to error.php?error=kicked Page says. Sorry! This Admin Panel has too many viewers. Please try to join at a later time. Back to login >>
// SCRIPT LIKE if($viwers.length>10) {
// redirect(error-kick.php);
// }
// IF TWO ACCOUNTS HAVE THE SAME DATABBASE, UPDATE ACCOUNT BY ADDING A COMMA AFTER EACH

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



if(session_status() === PHP_SESSION_ACTIVE) {
  if($_SESSION["loggedin"] == false || $_SESSION["loggedin"] == "" || $_SESSION["loggedin"] == null) {
    header("Location: /e890/newbls/adminpanel/error");
  } else {

  }
} else {
    header("Location: /e890/newbls/adminpanel/error");
}

$conn = new mysqli("127.0.0.1", "root", "e8jj3jhhaw", "iauth");




$session_email = decrypt($_SESSION["email"]);
$name;
//FETCH DB NAME
$fetchname = "SELECT * FROM user_accounts WHERE email='{$session_email}'";
$qfetchname = $conn->query($fetchname);
while($value = $qfetchname->fetch_assoc()) {
  $name = decrypt($value["associated_db"]);
}



$qname = "SELECT * FROM dbs WHERE name='{$name}' LIMIT 1";
$que = $conn->query($qname);
$time = date("h:i:sa");

$viewers;
while ($row = $que->fetch_assoc()) { // GRAB CURRENT VIEWING
  $viewers = $row["viewing"];
}


if($viewers==null || $viewers=="" || $viewers==" ") { // IF NO VIEWERS, ADD CURRENT VIEWER
   $viewing = $session_email;
} else {
  $email_encrypted = $session_email;
  $viewing = $viewers . ", $email_encrypted";
}

if(strpos($viewers, ",") !== false) {
  $current = explode(',', $viewers);
} else {
$current = array($viewers);
}
//$current = explode(',', $viewers);
$checkin = "SELECT * FROM dbs WHERE name='$name'";
$rcheckin = $conn->query($checkin);

while($row = $rcheckin->fetch_assoc())  {
  if(strpos($row["viewing"], $session_email) !== false) {
  } else {
    $addviewer = "UPDATE dbs SET viewing='{$viewing}' WHERE name='$name'";

    $conn->query($addviewer);

  }
}


// SETTINGS TOGGLES
$datacollection = false;
$logindelay = false;
// STATISICS DATA
$logins = array("3", "10", "5", "25", "10", "0", "0");

$fselect = "SELECT * FROM user_accounts WHERE email='{$session_email}' LIMIT 1";
$fsr = $conn->query($fselect);
$usrimg = "";
$usrfull_name = "";
$usrprivilege = "";
while($row = $fsr->fetch_assoc()) {
  $usrimg = decrypt($row["image"]);
  $usrfull_name = decrypt($row["full_name"]);
  $usrprivilege = decrypt($row["privilege"]);

}


// FETCH UNID
$qunid = "SELECT * FROM unid_manager WHERE name='{$name}'";
$runid = $conn->query($qunid);

$unid;
while($row = $runid->fetch_assoc()) {
  $unid = $row["UNID"];
}


//SETTING UPDATERS
$fulllink = $_SERVER['REQUEST_URI'];
if(strpos($fulllink, "?setting_notification=true")) {
  $query = "UPDATE settings_manager SET settings='1' WHERE unid='{$unid}'";
  $conn->query($query);
  header("Location: index.php");
}

//SETTING CONDITIONS

$qsettings = "SELECT * FROM settings_manager WHERE unid='{$unid}'";
$rsettings = $conn->query($qsettings);

$data_collection_condition;
$notification_condition;

while($row = $rsettings->fetch_assoc()) {
  if($row["data_collection"] == false) {
    $data_collection_condition = "";
  } else {
    $data_collection_condition = "checked";
  }

  if($row["notifications"] == false) {
    $notification_condition = "";
  } else {
    $notification_condition = "checked";
  }
}


?>
<!-- END PHP -->
<script>


</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$(function () {
  $('[data-toggle="popover"]').popover({ html : true });
});

window.onbeforeunload = function(){
   alert("close");
}
</script>

<style>
/* ELEMENT STYLES */
body,html {
  background: rgb(27,27,36);
   color: rgb(138,141,183);
  font-weight: lighter;
  animation: fadein 3s;
}
.notifications {
  background: rgb(40,41,54);
  position: fixed;
  right: 68;
  bottom: 15;
  border: 0;
  border-radius: 5px;
  width: 300px;
  height: 50px;
}
.whitespace {
  position: fixed;
  z-index: 9999;
  width: 1px;
  height: 26px;
  background: rgb(40,41,54);
  top: 126px;
  left: 99px;
}
.tooltip {
  position: inherit;
	z-index: 999;
}
.sidebar {
	border-right: 1px solid #15161e;
	height: 100%;
	width: 100px;
	position: fixed;
  background: rgb(40,41,54);
  z-index: 998;
	top: 0;
}



.sidebar-icon {
	width: 100px;
	height: 75px;
	border-bottom: 1px solid #15161e;
	padding: 21px;
	padding-left: 33px;
	cursor: pointer;
}

.sidebar-icon_mhub {
	width: 100px;
	height: 75px;
	border-bottom: 1px solid #15161e;
  margin-top: 21px;
	padding: 21px;
	cursor: pointer;
  animation: colorfade 2s infinite;
  text-decoration: none;
}

@keyframes colorfade {
  0% { color: rgb(138,141,183); }
  20% { color: rgb(138,141,183); }
  30% { color: rgb(74, 161, 114); }
  40% { color: rgb(74, 161, 114); }
  50% { color: rgb(74, 161, 114); }
  60% { color: rgb(74, 161, 114); }
  70% { color: rgb(138,141,183); }
  80% { color: rgb(138,141,183); }
  90% { color: rgb(138,141,183); }
  100% { color: rgb(138,141,183); }
}
.sidebar-icon:hover {

  width: 99px;
	box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12);
}
.sidebar-icon-active {

   width: 99px;
}
.popover{
    width: 350px;

}
.arrow-right {
  width: 0;
  height: 0;
  border-top: 15px solid transparent;
  border-bottom: 15px solid transparent;

  border-left: 15px solid #15161e;
	position: fixed;
	left: 99px;
	top: 124px;
}
.arrow-right-inside {
  width: 0;
  height: 0;
  border-top: 13px solid transparent;
  border-bottom: 13px solid transparent;

  border-left: 14px solid rgb(40,41,54);
	position: fixed;
	left: 99px;
	z-index: 999;
	top: 126px;
}
#logo {

	border-bottom: 1px solid #15161e;
}
.volunteers {
	position: fixed;
	top: 100px;
	width: 1175px;
	left: 150px;
	 box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12);
	 z-index: 1;
}
.log {
	position: fixed;
	top: 100px;
	width: 500px;
	left: 1350px;
	 box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12);
	 z-index: 1;
}
.settings {
	position: fixed;
	top: 380px;
	width: 576px;
	left: 150px;
	 box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12);
	 z-index: 1;
}
.cmd-prompt {
   display: none;
    background: rgb(40,41,54);
    position: fixed;
    bottom: 10;
    right: 10;
    width: 500px;
    height: 600px;
    border-radius: 5px;
    z-index: 999;
    border: 1px solid rgb(27,27,36);
}
.statistics {
	position: fixed;
	top: 380px;
	width: 576px;
	left: 750px;
	 box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12);
	 z-index: 1;
}
.oldsettings {
	position: fixed;
	top: 10px;
  width: 100px;
  height: 100px;
  border: 0;
  border-radius: 1100px;
	left: 150px;
  padding-top: 24.9px;
  color: white;
  background: #4d4dff;
  font-size: 50px;
	 z-index: 1;
   cursor: pointer;
   transition: 1s;
}
.oldsettings:hover {
  box-shadow: inset 0 7px 8px rgba(0, 0, 0, 0.32);
}
/* SWITCHES */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 3px;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: rgb(74, 161, 114);;
}
input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}
input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
.slider.round {
  border-radius: 34px;
}
.slider.round:before {
  border-radius: 50%;
}
#span {
  display: block;
}
.panel-footer {
  border: 1px solid rgb(27,27,36);
  background: rgb(40,41,54);
  box-shadow: 0;
  margin: 0;
  width: 100%;
  border-left: 0;
  border-right: 0;
  border-bottom: 0;
}
.panel {
  border: 1px solid rgb(27,27,36);
  background: rgb(40,41,54);
}
table, td {
  border-color: #15161e;
}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #2b2c3b;
}
.table-hover tbody tr td, .table-hover tbody tr thead {
    border-color: #21212c;
}
a {
  color: rgb(91,145,217);
  text-decoration: none;
  cursor: pointer;
}
.popover {
    background: rgb(40,41,54);
}
.popover-title{
    background: rgb(40,41,54);
    border-bottom: 1px solid #15161e;
}
.popover.right .arrow:after {
  border-right-color: rgb(40,41,54);
}
.viewing {
  position: fixed;

  width: 500px;
  height: 75px;
  top: 15;
  right: 69;
}

.account-slider {
  height: 300px;
  border: 1px solid #15161e;

  background: rgb(40,41,54);
  position: fixed;
  left: 0;
  margin-top: 476px;
  z-index: 997;
  transition: 3s;
}


.growl {
  left:  -500px;;
  z-index: 999;
  bottom: 20px;
  position: fixed;
  min-width: 300px;
  max-width: 500px;
  padding: 10px;
  border-radius: 3px;
  background:#ff3333;
  color: white;
  font-size: 16px;
  animation: zoomin 1s, disappear 5s;
  animation-fill-mode: forwards;
  margin-top: 20px;
}
@keyframes zoomin {
  from { left: -500px; }
  to {left: 20px;}
}
@keyframes disappear {
  0% { opacity: 1; }
  10% { opacity: 1; }
  20% { opacity: 1; }
  30% { opacity: 1; }
  40% { opacity: 1; }
  50% { opacity: 1; }
  60% { opacity: 1; }
  70% { opacity: 0.9; }
  80% { opacity: 0.5; }
  90% {opacity: 0;}
  100% {opacity: 0;}
}

.leftgrowlbar {
  background: #e60000;
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
  position: absolute;
  height: 100%;
  float: left;
  width: 5px;
}
.begin {
  color: #4aa172;
  background: rgba(74, 161, 114, 0.1);
  border: 1px solid #4aa172;
  font-weight: bold;
  font-size: 30px;
  padding: 20px;
  width: 300px;
  border-radius: 5px;
  margin-top: 40px;
}

@-moz-keyframes fadein { /* Firefox */
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-webkit-keyframes fadein { /* Safari and Chrome */
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
</style>
<center style="margin-top: 300px; letter-spacing: 1px;"><h1 style="font-size: 45px; font-weight: lighter; font-family: montserrat;">Welcome to</h1></center>
<center><h1 style=" margin: 0;font-size: 68px;font-family: lobster;  font-size: 72px;background: linear-gradient(to right, #4286f4, #4286f4, #e242f4, #e242f4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">i<span style="font-family: 'Russo One'">Auth</span></center>
<center style="font-size: 20px; font-style: italic; margin-top: 100px;">Thank you for purchasing iAuth. We see its your first time.<br>To finish setting up your account we need to validate <br>some information.</center>
<center><a href="step1"><button class="begin">Continue</button></a></center>
