<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<script src='Chart.min.js'></script>
<script src='Chart.js'></script>
<!-- START PHP -->
<?php
session_start();

if(!(isset($_SESSION["loggedin"]))) {
  // Session Does not Exist Which means user has not loggedin.
  header("Location: /iauth/account/login");
} else {
  if($_SESSION["loggedin"] == 0) {
    // Sesssion exists, but user has failed login
    header("Location: /iauth/account/login");
  } else {
    // Session exists and user has loggedin successfully;
    $email = $_SESSION["email"];
    $token = $_SESSION["token"];

    $conn = new mysqli("75.85.176.92:3306", "xdata", "Theo2003", "iauth");
    $authquery = "SELECT * FROM tokens WHERE email='{$email}' LIMIT 1";
    $authr = $conn->query($authquery);

    while($row = $authr->fetch_assoc()) {
      $demail = $row["email"];
      $dtoken = $row["token"];
        }

    if($email = $demail && $token = $dtoken) {

    } else {
      header("Location: /iauth/account/login");
    }

  }
}
// SETTINGS TOGGLES
$datacollection = false;
$logindelay = false;
// STATISICS DATA
$logins = array("3", "10", "5", "25", "10", "0", "0");
?>
<!-- END PHP -->
<script>
window.onload = function() {
  var datacollection = "<?php echo $datacollection ?>";
  var logindelay = "<?php echo $logindelay ?>";

  if(datacollection == true) {
    document.getElementById("setting_datacollection").checked = true;
  } else {
    document.getElementById("setting_datacollection").checked = false;
  }

  if(logindelay == true) {
    document.getElementById("setting_logindelay").checked = true;
  } else {
    document.getElementById("setting_logindelay").checked = false;
  }


}
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$(function () {
  $('[data-toggle="popover"]').popover({ html : true });
})
</script>

<style>
/* ELEMENT STYLES */
.whitespace {
  position: fixed;
  z-index: 9999;
  width: 1px;
  height: 26px;
  background: white;
  top: 126px;
  left: 99px;
}
.tooltip {
  position: inherit;
	z-index: 999;
}
.sidebar {
	border-right: 1px solid #d3d3d3;
	height: 100%;
	width: 100px;
	position: fixed;
  z-index: 999;
	top: 0;
}
.sidebar-icon {
	width: 100px;
	height: 75px;
	border-bottom: 1px solid #d3d3d3;
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

  border-left: 15px solid #d3d3d3;
	position: fixed;
	left: 99px;
	top: 124px;
}
.arrow-right-inside {
  width: 0;
  height: 0;
  border-top: 13px solid transparent;
  border-bottom: 13px solid transparent;

  border-left: 14px solid white;
	position: fixed;
	left: 99px;
	z-index: 999;
	top: 126px;
}
#logo {

	border-bottom: 1px solid #d3d3d3;
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
  background-color: #00b300;
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



</style>
<div class="whitespace"></div>
<div class="logo-container"></div>
<div class="arrow-right"></div>
<div class="arrow-right-inside"></div>
<div class="sidebar">
  <div id="logo" style="font-size: 68px;font-family: lobster; width: 100px; height: 100px;   font-size: 72px;background: -webkit-linear-gradient(#4286f4, #e242f4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"><center>i</center></div>
<div class="sidebar-icon sidebar-icon-active" data-toggle="tooltip" data-placement="right" title="Home"><span class="glyphicon glyphicon-home" style="font-size: 30px;" aria-hidden="true"></span></div>
<div class="sidebar-icon" data-toggle="tooltip" data-placement="right" title="Settings"><span class="glyphicon glyphicon-cog" style="font-size: 30px;" aria-hidden="true"></span></div>
<div class="sidebar-icon" data-toggle="tooltip" data-placement="right" title="Volunteer&nbsp;Management"><span class="glyphicon glyphicon-user" style="font-size: 30px;" aria-hidden="true"><span class="badge" style=" font-family: arial; width: 20px; height: 20px; padding-top: 4px; padding-left: 6px; border-radius: 1110px; background: red;">4</span></span></div>
<div class="sidebar-icon" data-toggle="tooltip" data-placement="right" title="Statistics"><span class="glyphicon glyphicon-signal" style="font-size: 30px;" aria-hidden="true"></span></div>
<div class="sidebar-icon" data-toggle="tooltip" data-placement="right" title="User&nbsp;Log"><span class="glyphicon glyphicon-book" style="font-size: 30px;" aria-hidden="true"></span></div>
<center><a style="outline: none;" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Welcome, <strong><span class='label label-danger'>Site Admin</span> Theo</strong>!"
  data-content="
  <img  style='width: 75px; height: 75px; float: left;' src='http://3.bp.blogspot.com/-19GVoMdwoFo/Vj1Ccmi6MCI/AAAAAAAADL0/5Cz-PeAdGIQ/s640/Anonymous-facbook-profile-picture.jpg' alt='Profile Picture' class='img-circle'></img>
  <p style='margin-left: 85px;'>
    <span id='span' style='margin-bottom: 0px;'><strong style='margin-bottom: 0px;'>Theo Nakfoor</strong></span>
    <span id='span' style='margin-left: 2px; margin-top: -2px; font-size: 13px;'>iAuth Admin</span>

  </p><br>
<button type='button' class='btn btn-warning' style='margin-left: 83px; margin-top: -54px;'>My Account</button>

  <br>
  <button type='button' class='btn btn-default'>Sign Out</button>
  <a style='margin-left: 8px; cursor: pointer; text-decoration: none;'>Switch Accounts
  </a>
  "><img data-toggle="popover" style="width: 60px; height: 60px; margin-top: 20px;" src="http://3.bp.blogspot.com/-19GVoMdwoFo/Vj1Ccmi6MCI/AAAAAAAADL0/5Cz-PeAdGIQ/s640/Anonymous-facbook-profile-picture.jpg" alt="Profile Picture" class="img-circle"></img></a></center>

</div>

<h1 style="position: fixed; top: 10px; left: 150px;">Control Panel <strong>Home</strong></h1>

<div class="panel panel-default statistics">
  <div class="panel-body">
    <canvas id="myChart" width="300" height="200"></canvas>
    <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Monday", "Tuesday", "Wednsday", "Thursday", "Friday", "Saturday", "Sunday"],
            datasets: [{
              label: '# of Logins',
                          data: ['<?php echo $logins[0] ?>', '<?php echo $logins[1] ?>', '<?php echo $logins[2] ?>', '<?php echo $logins[3] ?>', '<?php echo $logins[4] ?>', '<?php echo $logins[5] ?>', '<?php echo $logins[6] ?>'],
                          backgroundColor: "rgba(255, 99, 132, 0.2)",
                          borderColor: "rgba(255,99,132,1)",
                          borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>
    <p style="float: left;">Show logins over the last&nbsp;&nbsp;</p><div id="select-date" class="form-group" style="width: 200px; float: left;">
  <select class="form-control" id="sel1">
    <option>7 Days</option>
    <option>2 Weeks</option>
    <option>Month</option>
  </select>
</div>
  </div>
  <div class="panel-footer" style="font-size: 17px;">Statistics  <span id="download-arrow" class="glyphicon glyphicon-upload" style="float: right; transform: rotate(90deg); transition: 1s;" aria-hidden="true"></span></div>
</div>

<div class="panel panel-default settings">
  <div class="panel-body">
    <!-- DATA COLLECTION -->
    <label class="switch" style="float: right;">
<input id="setting_datacollection" type="checkbox">
<div class="slider"></div>
</label>
      <strong>Allow Data Collection</strong> <!-- IF OFF REQUIRE RESTART -->
      <h6 style="margin-top: 0;">Allow iAuth to collect data to better <br>enhance your experience.</h6>
    <!-- END DATA COLLECTION -->

    <!-- LOGIN DELAY -->
    <label class="switch" style="float: right;">
<input id="setting_logindelay" type="checkbox">
<div class="slider"></div>
</label>
      <strong>Login Delay</strong>
      <h6 style="margin-top: 0;">Set a delay for how fast users can sign <br>in using an MHub.</h6>
    <!-- END LOGIN DELAY -->
    <strong>Software Update</strong>
    <h6 style="margin-top: 0;">There is an available update for your MHub.</h6>


   <a>View More Settings</a>
  </div>
  <div class="panel-footer" style="font-size: 17px;">Settings  <span id="download-arrow" class="glyphicon glyphicon-upload" style="float: right; transform: rotate(90deg); transition: 1s;" aria-hidden="true"></span></div>
</div>

<div class="panel panel-default log">
  <div class="panel-body" style="height: 721px;">
    <ul class="list-group">
 <center><span class="glyphicon glyphicon-inbox" style="font-size: 45px; color: #d3d3d3; margin-top: 150px;" aria-hidden="true"></span><br><h2 style="color: #d3d3d3;">You have no recent log reports.</h2></center>



</ul>
  </div>
  <div class="panel-footer" style="font-size: 17px;">Log  <span id="download-arrow" class="glyphicon glyphicon-upload" style="float: right; transform: rotate(90deg); transition: 1s;" aria-hidden="true"></span></div>
</div>

<div class="panel panel-default volunteers">
  <div class="panel-body">
		<table class="table table-hover">
	 <thead>
		 <tr>
			 <th>First Name</th>
			 <th>Last Name</th>
			 <th>Time Logged In</th>
		 </tr>
	 </thead>
	 <tbody>
		 <tr>
             <td>Theo</td>
						 <td>Nakfoor</td>
						 <td>4:00 PM</td>
		 </tr>
		 <tr>
			 <td>Test</td>
			 <td>Nakfoor</td>
			 <td>1:00 PM</td>
		 </tr>
		 <tr>
			 <td>Test</td>
			 <td>Nakfoor</td>
			 <td>1:00 PM</td>
		 </tr>
	 </tbody>
 </table>
  </div>
  <div class="panel-footer" style="font-size: 17px;">Volunteer Management  <span id="download-arrow" class="glyphicon glyphicon-upload" style="float: right; transform: rotate(90deg); transition: 1s;" aria-hidden="true"></span></div>
</div>

<ol class="breadcrumb" style="position: fixed; bottom: -5px; left: 115px; min-width: width: 260px;">
  <li><a href="#" style="">Control Panel</a></li>
  <li class="active">Home</li>
</ol>
