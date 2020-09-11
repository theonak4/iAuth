<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster|Russo+One" rel="stylesheet">
<?php
$name = "Jefferson Elementary School";
 ?>
<script>
window.onload = function() {
  //document.getElementById("loadingbarprogress").style.width = "0%";
  setTimeout(steptwo, 1000);
}

function steptwo() {
//  document.getElementById("loadingbarprogress").style.width = "40%";
  document.getElementById("statusmessage").innerHTML = "Contacting Server...";
  setTimeout(stepthree, 2000);
}

function stepthree() {
//  document.getElementById("loadingbarprogress").style.width = "80%";
    document.getElementById("statusmessage").innerHTML = "Connecting to MySQL...";
  setTimeout(stepfour, 1000);

}

function stepfour() {
//  document.getElementById("loadingbarprogress").style.width = "90%";
    document.getElementById("statusmessage").innerHTML = "Establishing Secure Connection...";
  setTimeout(stepfive, 500);
}

function stepfive() {
//document.getElementById("loadingbarprogress").style.width = "100%";
  document.getElementById("statusmessage").innerHTML = "Loading Adminpanel for <?php echo $name ?>...";
  setTimeout(redirect, 500);
}

function redirect() {
  window.location = "index.php"
}
</script>
<style>

.statusmessage {
  animation: fade-in 1.5s infinite;
}

.loader {
    border: 4px solid #16161d;
    border-top: 4px solid #4aa172;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    animation: spin 0.5s linear infinite;
    margin-top: 150px;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
@-webkit-keyframes fade-in{
30% {opacity:1;}
70% {opacity:0;}
100% {opacity: 1;}
}
body,html {
  background: rgb(27,27,36);
   color: rgb(138,141,183);
  font-family: Roboto;
  font-weight: lighter;
}
h4 {
-webkit-animation:fade-in 2s infinite;
}

.progressbar {
  width: 700px;
  background: rgb(40,41,54);
  border: 4px solid rgb(40,41,54);
  border-radius: 5px;
  height: 20px;

}

.progress {
  height: 20px;
  background: rgb(74, 161, 114);
  color: rgb(27,27,36);
  border: 0;
  border-radius: 5px;
  float: left;
  transition: 2s;
}

.loadingbar {
  width: 700px;
  height: 5px;
  background: #16161d;
  margin-top: 250px;
}

.loadingbarprogress {
  height: 5px;
  background: linear-gradient(to right,#4aa172, #62b789, #4aa172);
  float: left;
  transition: 2s;
}

</style>
<center style="margin-top: 320px;">
  <center><h1 style=" margin: 0;font-size: 68px;font-family: lobster;  font-size: 72px;background: linear-gradient(to right, #4286f4, #4286f4, #e242f4, #e242f4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">i<span style="font-family: 'Russo One'">Auth</span></h1>
  <center><h5 class="statusmessage" id="statusmessage" style="margin: 0; font-size: 20px; font-weight: lighter;">Confirming Login...</h5></center>

<!--
<div class="progressbar">
   <div id="progress" class="progress"></div>
  </div>
</div>
<div class="loadingbar">
  <div class="loadingbarprogress" id="loadingbarprogress"></div>
</div>
-->
<center>
<div class="loader">
</div>
<h4 id="1" style="display: none;">Confirming Login...</h4>
<h4 id="2" style="display: none;">Contacting Server...</h4>
<h4 id="3" style="display: none;">Connecting to MySQL...</h4>
<h4 id="4" style="display: none;">Establishing SSL...</h4>
<h4 id="5" style="display: none;">Complete!</h4>
</center>
