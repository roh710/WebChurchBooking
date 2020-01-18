<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require "cdnj.inc.dbh.php";

$message = '';

// $grResults = $conn->query("SELECT grId, grName FROM cdnj_group ORDER BY grName ASC"); // REVIEW: to be used for populating drop-down list

if (isset($_POST['uName'])) {
   $records = $conn->prepare('SELECT * FROM users WHERE user_name = :user_name OR user_email = :user_email');
   $records->bindParam(':user_name', $_POST['uName']);
   $records->bindParam(':user_email', $_POST['eMail']);
   $records->execute();
   $row = $records->fetch(PDO::FETCH_ASSOC);

   if ($row > 0) {
		header("refresh:3; url=./register.php");
      echo "the Username: " . $_POST['uName'] . " or e-Mail: " . $_POST['eMail'] . ", has been alredy Registered!";
      exit();
   } elseif ($_POST['uPwd'] != $_POST['confirm_uPwd']) {
		header("refresh:3; url=./register.php");
      echo "passwords do not match";
			exit;
   }
}

// Enter the new user in the database
	$uFirstName = $_POST['uFirstName'];
	$uLastName = $_POST['uLastName'];
	$uKorName = $_POST['uKorName'];
  $uTitle = $_POST['uTitle'];
	$uName = $_POST['uName'];
	$eMail = $_POST['eMail'];
	$uGroup = $_POST['uGroup'];
	$uPwd = password_hash($_POST['uPwd'], PASSWORD_BCRYPT);

	$sql = "INSERT INTO users (user_firstname, user_lastname,	user_email,	user_group_fk, user_kor_name, user_title, user_name, user_pwd)
	VALUES
	(:user_firstname, :user_lastname, :user_email, :user_group_fk, :user_kor_name, :user_title, :user_name, :user_pwd)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':user_firstname', $uFirstName);
	$stmt->bindParam(':user_lastname', $uLastName);
	$stmt->bindParam(':user_email', $eMail);
	$stmt->bindParam(':user_group_fk', $uGroup);
	$stmt->bindParam(':user_kor_name', $uKorName);
  $stmt->bindParam(':user_title', $uTitle);
	$stmt->bindParam(':user_name', $uName);
	$stmt->bindParam(':user_pwd', $uPwd);

	if($stmt->execute()):
		header("refresh:3; url=../index.php");
    echo "Successfully created new user";

	else:
    header("refresh:3; url=../index.php");
    echo "User account not created!";

	endif;
?>
