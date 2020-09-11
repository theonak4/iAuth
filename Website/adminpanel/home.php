<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script>
window.onload = function() {
	var rows = document.getElementById("table").rows.length - 1;
	document.getElementById("table-length").value = rows;
}


</script>
<style>
a {
  border-top-right-radius: 0px; border-bottom-right-radius: 0px;
}
.content {
  margin-left: 375px;
  height: 100%;
  position: fixed;
  margin-top: 60px;
  padding: 50px;
  width: 75%;
  min-width: 50%;
}

.help {
  border: 1px solid #d3d3d3;
  border-radius: 4px;
  width: 300px;
  height: 100px;
  padding: 15px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  margin-top: 10px;
}

.topbar {
  margin-left: 330px;
  border-bottom: 1px solid #d3d3d3;
  height: 81px;
  padding: 25px;
		padding-top: 20px;
  position: fixed;
  width:  100%;
}

.uppergradient {
	background: linear-gradient(to right, #3d7ce2, #ad52e5);
	width: 335px;
	top: 0;
	left: 0;
	position: fixed;
	height: 5px;

}
</style>
<div class="uppergradient">
</div>
<input value="" id="table-length" style="display: none;"></input>
<div class="topbar" style="background: #f2f2f2;">
  <h4>Currently viewing <strong>Jefferson Elementary School</strong><a style="font-size: 13px; margin-left: 8px;">Not right?</a></h4>
  <p style="position: fixed; top: 10px; right: 15px;">Welcome, <strong style="margin-right: 10px;">Theo</strong> <img style="width: 60px; height: 60px;" src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcST96nE7L86BA7-edQrfdOkIpzsb1XwV0jaXP8GRlZAHv9Z6pcJt7cJVkIf" alt="..." class="img-circle"></p>
</div>
<div style=" position: fixed; top: 20px; padding-left: 20px; border-bottom: 1px solid #d3d3d3; width: 375px;;">
<img src="iAuth.png" style="padding-bottom: 15px;"></img>
</div>

<ul class="nav nav-pills nav-stacked" style="box-shadow: 0 7px 8px rgba(0, 0, 0, 0.10); position: fixed; width: 330px; padding-top: 25px; border-right: 1px solid #d3d3d3; height: 100%; top: 81px;">
  <li role="presentation" class="active" style="" style="border-top-right-radius: 0px;"><a href="#" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-left: 20px;">Home <span class="glyphicon glyphicon-home" style="float: right;" aria-hidden="true"></span></a></li>
  <li role="presentation" style="border-top-right-radius: 0px;"><a href="#" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-left: 20px;">Settings <span class="glyphicon glyphicon-cog" style="float: right;" aria-hidden="true"></span></a></li>
  <li role="presentation"><a href="#" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-left: 20px;">Volunteer Management <span class="badge" style="float: right; background: red;"><?php echo $volunteers ?></span></a></li>
  <li role="presentation"><a href="#" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-left: 20px;">Statistics <span class="glyphicon glyphicon-signal" style="float: right;" aria-hidden="true"></span></a></li>
	<li role="presentation"><a href="#" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-left: 20px;">User Log <span class="glyphicon glyphicon-book" style="float: right;" aria-hidden="true"></span></a></li>

  <div class="alert alert-success" role="alert" style="margin-left: 25px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-left: 20px; margin-top: 30px;"><strong>Updated Privacy Policy</strong><br>We've updated our terms and continued protection of your privacy. <br><br><a href="/iauth/privacy">Check it Out</a> <span style="float: right;"><span class="glyphicon glyphicon-remove" style="font-size: 10px; margin-top: 3px;" aria-hidden="true"></span></span> </div>

</ul>

<div class="content">
  <table class="table table-striped" style="margin-bottom: 0; padding-bottom: 0;" id="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Signed In</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $que = $conn->query('SELECT * FROM loggedin');
        $header=false;
					while ($row = $que->fetch_assoc()) {
	          $time = date("g:i a", strtotime($row["Time"]));
	          echo "<tr style=''><td>{$row['First_Name']}</td><td>{$row['Last_Name']}</td><td>{$time}</td></tr>";
	        }
      ?>
    </tbody>
  </table>
	<a style=""></a>
  <br>
	<br>

</div>
