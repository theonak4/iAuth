<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster|Russo+One" rel="stylesheet">
<?php
	$conn = new mysqli("127.0.0.1", "root", "e8jj3jhhaw", "iauth");
  $sql = "SELECT * FROM session_manager WHERE db='Jefferson Elementary'";
  $result = $conn->query($sql);
	// Read the cache
  $id;
  while($row = $result->fetch_assoc()) {
    $id = $row['id'];
  }
	// Grab UserInfo
	$uinfo = "SELECT * FROM fp_users WHERE parent_db='Jefferson Elementary'";
	$uresult = $conn->query($uinfo);
	$user_first;
	$user_last;
	while($row = $uresult->fetch_assoc()) {
    $user_first = $row["first_name"];
		$user_last = $row["last_name"];
	}
	echo $user_first;
	echo $user_last;
	// Insert
	$time = time();
	$insert = "INSERT INTO loggedin_jeffersonelementary(first, last, id, time)
                                                                             VALUES ({$user_first}, {$user_last}, {$id}, {$time}); "

 ?>
