<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<script>
window.onload = function() {
  document.getElementById("progress").style.width = "10%";
  document.getElementById("1").style.display = "inline";
  setTimeout(steptwo, 1000);
}

function steptwo() {
  document.getElementById("progress").style.width = "40%";
    document.getElementById("1").style.display = "none";
  document.getElementById("2").style.display = "inline";
  setTimeout(stepthree, 2000);
}

function stepthree() {
  document.getElementById("progress").style.width = "80%";
    document.getElementById("2").style.display = "none";
  document.getElementById("3").style.display = "inline";
  setTimeout(stepfour, 1000);

}

function stepfour() {
  document.getElementById("progress").style.width = "90%";
    document.getElementById("3").style.display = "none";
  document.getElementById("4").style.display = "inline";
  setTimeout(stepfive, 500);
}

function stepfive() {
  document.getElementById("progress").style.width = "100%";
    document.getElementById("4").style.display = "none";
  document.getElementById("5").style.display = "inline";
  setTimeout(redirect, 500);
}

function redirect() {
  window.location = "index.php"
}
</script>
<style>
@-webkit-keyframes fade-in{
from{
    opacity:1;
}
to{
    opacity:0;

}
}

h4 {
-webkit-animation:fade-in 2s infinite;
}

</style>
<center style="margin-top: 320px;">
  <img src="iauth.png"></img>
<div class="progress" style="width: 500px;">
  <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:  0%; transition: width 2s;"  id="progress">
  </div>
</div>
<h4 id="1" style="display: none;">Logging In...</h4>
<h4 id="2" style="display: none;">Contacting Server...</h4>
<h4 id="3" style="display: none;">Connecting to MySQL...</h4>
<h4 id="4" style="display: none;">Establishing SSL...</h4>
<h4 id="5" style="display: none;">Complete!</h4>
</center>
