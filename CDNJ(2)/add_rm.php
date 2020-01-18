<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require 'header.php';

if (isset($_SESSION['user_info'])) {
   require 'includes/cdnj.inc.dbh.php';
   //var_dump($_SESSION['uPermission']);

   if ($_SESSION['uPermission'] != 'Admin') {
      header("Location: ./index.php");// REVIEW: Warning: Cannot modify header information - headers already sent by (output started at /volume1/web/cdnj/header.php:6) in /volume1/web/cdnj/add_rm.php on line 11
      exit();
   }

	$records = $conn->prepare('SELECT * FROM userinfo_perm WHERE user_name = :user_name');
	$records->bindParam(':user_name', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

  // echo "<table border='1' cellpadding='3' align='center'>";
  // echo "<tr align='center' cellpadding='3'><th>Room Name</th><th>Room Location</th><th>Description</th><th>Max Persons</th><th>Time Open</th><th>Time Close</th><th>Has Piano?</th><th>Status</th></tr>\n";

  $rmResults = $conn->query("SELECT * FROM rmlist");

  if(isset($_POST['submit'])) {
   	$rmN = $_POST['rmName'];
   	$rmL = $_POST['rmLocation'];
   	$rmD = $_POST['rmDesc'];
   	$rmM = $_POST['rmMaxPersons'];
   	$rmSAT = $_POST['rmStartAvailTime'];
   	$rmEAT = $_POST['rmEndAvailTime'];
   	$rmP = $_POST['rmPiano'];

    $st = $conn->prepare("INSERT INTO rmlist (rmName, rmLocation, rmDesc, rmMaxPersons, rmStartAvailTime, rmEndAvailTime, rmPiano) VALUES (:rmName, :rmLocation, :rmDesc, :rmMaxPersons, :rmStartAvailTime, :rmEndAvailTime, :rmPiano)");

   	$st->bindParam(':rmName',$rmN);
   	$st->bindParam(':rmLocation',$rmL);
   	$st->bindParam(':rmDesc',$rmD);
   	$st->bindParam(':rmMaxPersons',$rmM);
   	$st->bindParam(':rmStartAvailTime',$rmSAT);
   	$st->bindParam(':rmEndAvailTime',$rmEAT);
   	$st->bindParam(':rmPiano',$rmP);

   	$st->execute();

   	while ($row = $st->fetch(PDO::FETCH_ASSOC)) {

   		// $rmN = htmlentities($row['rmName']);
   		// $rmL = htmlentities($row['rmLocation']);
   		// $rmD = htmlentities($row['rmDesc']);
   		// $rmM = htmlentities($row['rmMaxPersons']);
   		// $rmSAT = htmlentities($row['rmStartAvailTime']);
   		// $rmEAT = htmlentities($row['rmEndAvailTime']);
   		// $rmP = htmlentities($row['rmPiano']);
   	}
    echo "<br>";
    echo "<h2>The room added successfully!</h2>";
    header("refresh:3; url=./index.php");
    exit;
   	// echo "<tr><td>$rmN</td><td>$rmL</td><td>$rmD</td><td>$rmM</td><td>$rmSAT</td><td>$rmEAT</td><td>$rmP</td><td>Room successfully inserted!</td></tr>\n";
   }

} else {
   header("Location: index.php");
   exit;
   // echo "You're not Logged-in OR you do not have an Admin permission!";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>CDNJ Reservations</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
	<body>
      <div class="box-reg">
         <h2>add rooms</h2>
   		<form method="POST" action="add_rm.php" autocomplete="off">
			<div class="input-box-reg">
				<input type="text" name="rmName" required="">
            <label>Room Name</label>
			</div>
			<div class="input-box-reg">
				<input type="text" name="rmLocation" required="">
            <label>Room Location</label>
			</div>
			<div class="input-box-reg">
				<input type="text" name="rmDesc" required="">
            <label>Room Description</label>
			</div>
			<div class="input-box-reg">
				<input type="number" name="rmMaxPersons" required="">
            <label>Max persons</label>
			</div>
			<div class="input-box-reg">
				<input type="time" name="rmStartAvailTime" required="">
            <label>opening time</label>
			</div>
			<div class="input-box-reg">
				<input type="time" name="rmEndAvailTime" required="">
            <label>closing time</label>
			</div>
			<div class="input-box-reg">
				<select class="input-box-reg" name="rmPiano" required="">
					<option value="" selected hidden>Room has Piano?</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
            <label>Piano?</label>
			<br>
			</div>
			<div class="input-box-reg">
				<input type="submit" name="submit" value="ADD ROOM">
			</div>
      </div>
		</form>
      <br>
	</body>
</html>
