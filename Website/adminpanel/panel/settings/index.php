<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster|Russo+One" rel="stylesheet">
<script src='Chart.min.js'></script>
<script src='Chart.js'></script>
<!-- START PHP -->
<?php
session_start();

//IDEA: PING MYSQL TO CHECK IF IS UP. IF GOOD, ALLOW CONNECTION CODE
// ADD UNLOAD VIEWER SCRIPT
// ADD NAMETAGS
// MAX VIEWERS IS 10. KICK PEOPLE JOINING AFTER THAT
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
window.onload = function() {
 var data_collection = "<?php echo $data_collection_condition ?>";
 var notifications = "<?php echo $notification_condition ?>";

if(notifications == "checked") {
  document.getElementById("chckid02").checked = true;
}


}



function showAccount() {
  document.getElementById("account-slider").style.width = "300px;";
}

function KeyPress(e) {
      var evtobj = window.event? event : e
      if (evtobj.keyCode == 16 && evtobj.ctrlKey) {
      document.getElementById('cmd-prompt').style.display = "inline";
      }
}

document.onkeydown = KeyPress;

function removeViewer() {
  alert("remove?");
}



function notifications() {
  if(Notification.permission !== "granted") {

    Notification.requestPermission().then(function(result) {
    if (result === 'denied') {
    console.log("SETTING: Notifications denied.");
    return;
    }
    if (result === 'default') {
    console.log("SETTING: Notifications dissmissed.");
    growl("You must allow iAuth to show notifications");
    return;
     }

     window.open("?setting_notification=true", "_self");
});


  } else {

  }
}

function growl(text) {
var growldiv = document.createElement("div");
growldiv.className = "growl";
growldiv.innerHTML = text;
document.body.appendChild(growldiv);
}

function redirect(location) {
  window.location = location;
}


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

.content {
  margin-left: 150px;
  margin-top: 110px;
}
</style>
<body onbeforeunload="removeViewer()">



<div class="viewing">
  <h6 style="margin: 0; font-weight: bold; font-style: italic;">CURRENTLY VIEWING</h6>
  <?php
  $vmt = 0;
  foreach($current as $value) {
    $select = "SELECT image FROM user_accounts WHERE email='{$value}'";
    $sr = $conn->query($select);
    while($row = $sr->fetch_assoc()) {
      $images[] = $row;
    }

  }



foreach($current as $value) {

$value_decrypted = decrypt($value);

$select = "SELECT * FROM `user_accounts` WHERE `email`='{$value}'";
$sr = $conn->query($select);
$img;
while($row = $sr->fetch_assoc()) {  $img =  decrypt($row["image"]);
}






   if($value_decrypted == decrypt($session_email)) {
     while($row = $sr->fetch_assoc()) {
       $img =  decrypt($row["image"]);
     }
    echo "
    <img data-toggle='tooltip' data-placement='left' title='You' style='width: 55px; height: 55px; float: left; margin-top: 5px; margin-right: 15px; border: 2px solid rgb(91,145,217);' src='{$img}' alt='Viewer {$vmt}' class='img-circle'></img>
";
   } else {

   echo "
   <img data-toggle='tooltip' data-placement='left' title='{$value_decrypted}' style='width: 55px; height: 55px; float: left; margin-top: 5px; margin-right: 15px;' src='{$img}' alt='Viewer {$vmt}' class='img-circle'></img>    ";  }

    if($vmt>=4) {
      echo "{$vmt} more users.";
      break;
    }
  $vmt++;
  }

   ?>

</div>
<div class="cmd-prompt" id="cmd-prompt">
  <h1 style="margin: 15px; font-size: 20px; margin-left: 0; padding-left: 15px; padding-bottom: 15px; border-bottom: 1px solid rgb(27,27,36); width: 100%">Debug Console</h1>
  <p id="errors" style="margin-left: 15px; overflow: scroll; overflow-x: hidden; height: 500px;">
  <?php
  if($conn->connect_errno) {
    echo "<p style='color: #ff4d4d'>Error connecting to MySQL try checking back later.</p><br>";
  } else {
       echo "[{$time}] MySQL Database connection successful!<br>";
       echo "[{$time}] Retreiving account for user <i>{$session_email}</i>...<br>";
       echo "[{$time}] Success! Loaded data for <strong>{$name}</strong>.<br>";

  }
  echo "<strong>VIEWER CONNECTIONS</strong><br>";
  $x = 0;
  foreach($current as $user) {

    echo "Account <strong>{$user}</strong> is connected.<br>";


    $x++;
    if($x>=10) {
    echo "<i style='color: #ff4d4d;'>Max users connected.</i>";
     break;
   }
  }

   ?>
      <input style="position: absolute; bottom: 0; left: 15px; bottom: 15px; width: 400px;"></input>
  </p>
</div>
<div class="whitespace"></div>
<div class="logo-container"></div>
<div class="arrow-right"></div>
<div class="arrow-right-inside"></div>
<div class="sidebar">
  <div id="logo" style="font-size: 68px;font-family: lobster; width: 100px; height: 100px;   font-size: 72px;background: -webkit-linear-gradient(#4286f4, #e242f4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"><center>i</center></div>
<div class="sidebar-icon sidebar-icon-active" data-toggle="tooltip" data-placement="right" title="Home"><span class="glyphicon glyphicon-home" style="font-size: 30px;" aria-hidden="true"></span></div>
<div onclick="redirect('settings')" class="sidebar-icon" data-toggle="tooltip" data-placement="right" title="Settings"><span class="glyphicon glyphicon-cog" style="font-size: 30px;" aria-hidden="true"></span></div>
<div onclick="redirect('users')" class="sidebar-icon" data-toggle="tooltip" data-placement="right" title="Volunteer&nbsp;Management"><span class="glyphicon glyphicon-user" style="font-size: 30px;" aria-hidden="true"><span class="badge" style=" font-family: arial; width: 20px; height: 20px; padding-top: 4px; padding-left: 6px; border-radius: 1110px; background: red;">4</span></span></div>
<div onclick="redirect('statistics')" class="sidebar-icon" data-toggle="tooltip" data-placement="right" title="Statistics"><span class="glyphicon glyphicon-signal" style="font-size: 30px;" aria-hidden="true"></span></div>
<div onclick="redirect('log')" class="sidebar-icon" data-toggle="tooltip" data-placement="right" title="User&nbsp;Log" style="margin-bottom: 21px;"><span class="glyphicon glyphicon-book" style="font-size: 30px;" aria-hidden="true"></span></div>
<a href="/e890/iauth/account/mhubauth.php" onclick="window.open('/e890/iauth/account/login/new.php?mhubauth=true', 'MHub', 'width=600, height=890');" class="sidebar-icon_mhub" data-toggle="tooltip" data-placement="right" title="MHub&nbsp;Admin&nbsp;Panel" style="padding-left: 15px; text-decoration: none;"><span style="font-family: Russo One; font-size: 25px;">M</span><span style="font-family: roboto; font-style: italic; font-size: 25px;">hub</span></a>
<center><a style="outline: none;" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" onclick="showAccount()" title="Your Account"
  data-content="
  <img  style='width: 75px; height: 75px; float: left;' src='<?php echo $usrimg; ?>' alt='Profile Picture' class='img-circle'></img>
  <p style='margin-left: 85px;'>
    <span id='span' style='margin-bottom: 0px;'><strong style='margin-bottom: 0px;'><?php echo $usrfull_name; ?></strong></span>
    <span id='span' style='margin-left: 2px; margin-top: -2px; font-size: 13px;'><?php echo $usrprivilege; ?></span>

  </p><br>
  <br>

<a href='logout.php'><button type='button' class='btn btn-danger' style='margin-left: 83px; margin-top: -44px;'>Sign Out</button></a><br><br><br><br>

  "><img data-toggle="popover" style="width: 60px; height: 60px; margin-top: 30px;" src="<?php echo $usrimg; ?>" alt="Profile Picture" class="img-circle"></img></a></center>

</div>

<h1 style="position: fixed; top: 10px; left: 150px;"><?php echo $name ?><sup style="font-size: 20px;"> BETA</sup></h1>

<!-- START CONTENT - Mhub tab is for updating/setting up wifi connection/enrolling/deleting/anything the demo software does. Settings are in the Settings tab -->

<div class="content">

  <!-- Error 0231 (No MHub Link Established) --><div class="alert alert-danger" role="alert" style=" width: 360px; border: 1px solid #ff4d4d; color: #ff4d4d; background:rgba(255, 77, 77, 0.1)">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    You have not linked an MHub&trade; to your account.</a>
  </div>

</div>

<!-- END CONTENT -->

</body>
