<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster|Russo+One" rel="stylesheet">
<script src='Chart.min.js'></script>
<meta charset="UTF-8">
<script src='Chart.js'></script>
<!-- START PHP -->
<?php
session_start();
error_reporting(0);

if($_SESSION["privilege"] == "SuperUser") {
  $value = "block";
} else {
  $value = "none";
}
?>
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

.legal {
  bottom: 0;
  left: 0;
  position: fixed;
  height: 30px;
  width: 100%;
  font-size: 10px;
  padding: 10px;
  padding-right: 30px;
  background: rgb(40,41,54);
}

.override {
  background: transparent;
  border: 1px solid #ff4d4d;
  color: #ff4d4d;
  border-radius: 5px;
  margin-left: 10px;
}

.loginbtn {
   font-size: 25px;
   text-decoration: none;
   border: 1px solid rgb(74, 161, 114);
   color: rgb(74, 161, 114);
   padding: 10px;
   padding-left: 20px;
   padding-right: 20px;
   border-radius: 2px;
   transition: 1s;
}

.loginbtn:hover {
     color: rgb(74, 161, 114);
     text-decoration: none;
     margin-left: 10px;
    box-shadow: 0 2px 2px rgb(74, 161, 114);

}
</style>


<div style="font-size: 30px; margin-top: 320px; float: left; margin-left: 150px;"> <!-- 370 margin-top -->
<h1 style=" margin: 0;font-size: 68px;font-family: lobster;  font-size: 72px;background: linear-gradient(to right, #4286f4, #e242f4, #e242f4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">i<span style="font-family: 'Russo One'">Auth</span></h1>
This page requires a permission<br>
that you do not have. <br>
<br>
<span style="font-family: monospace">Please login to retry</span>
<br>
<br>

<br>
<a class="loginbtn" href="/e890/iauth/account/login/new.php">Login</a>

</div>
<br>
<center><span class="glyphicon glyphicon-lock" aria-hidden="true" style="font-size: 40px; display: none;"></span></center>
<br>
<br>
<br>

<center style="display: none;">
<a style="font-size: 30px; text-decoration: none; border: 1px solid rgb(74, 161, 114); color: rgb(74, 161, 114); border-radius: 5px; padding: 10px; padding-left: 50px; padding-right: 50px;" href="/e890/iauth/account/login/new.php">Login</a>
</center>
<br>
<br>
<br>
<br>
<center id="superuser" style="display: <?php echo $value ?>">
  Authorize Administrative override
  <button class="override">Override &raquo;</button>
</center>
<div class="legal">
  Copyright (c) 2016 Unified Softwares&trade; All Rights Reserved.

</div>
