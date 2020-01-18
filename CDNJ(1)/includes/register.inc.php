<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require "cdnj.inc.dbh.php";

$message = '';

// $grResults = $conn->query("SELECT grId, grName FROM cdnj_group ORDER BY grName ASC"); // REVIEW: to be used for populating drop-down list

if (isset($_POST['submit'])) {
  $uFirstName = trim($_POST['uFirstName']);
	$uLastName = trim($_POST['uLastName']);
	$uKorName = trim($_POST['uKorName']);
  $uTitle = trim($_POST['uTitle']);
	$uName = trim($_POST['uName']);
	$eMail = trim($_POST['eMail']);
	$cellPhone = trim($_POST['cellPhone']);
	$uGroup = $_POST['uGroup'];
  $uPwd = password_hash($_POST['uPwd'], PASSWORD_BCRYPT);
  
  $records = $conn->prepare('SELECT users.user_firstname, users.user_lastname, users.user_kor_name, users.user_name, users.user_email, users.user_pwd, users.active_status, cdnj_group.user_perm_level, cdnj_group.grId, cdnj_group.grName FROM users
  JOIN cdnj_group
  ON users.user_group_fk = cdnj_group.grId 
  WHERE (user_name = :user_name OR user_email = :user_email OR grId = :grId) AND users.active_status = "1"');
  $records->bindParam(':user_name', $_POST['uName']);
  $records->bindParam(':user_email', $_POST['eMail']);
  $records->bindParam(':grId', $_POST['uGroup']);
  $records->execute();
  $row = $records->fetch(PDO::FETCH_ASSOC);

  if ($row > 0) {
  header("refresh:3; url=../register.php");
  echo "The username: " . $_POST['uName'] . " or e-Mail: " . $_POST['eMail'] . " or Group: " . $row['grName'] . ", has been alredy Registered!";
  exit;
  } elseif ($_POST['uPwd'] != $_POST['confirm_uPwd']) {
  header("refresh:3; url=../register.php");
  echo "passwords <strong>DO NOT</strong> match";
  exit;
  }
}

	$sql = "INSERT INTO users (user_firstname, user_lastname,	user_email, cellPhoneNum,	user_group_fk, user_kor_name, user_title, user_name, user_pwd)
	VALUES
	(:user_firstname, :user_lastname, :user_email, :cellPhoneNum, :user_group_fk, :user_kor_name, :user_title, :user_name, :user_pwd)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':user_firstname', $uFirstName);
	$stmt->bindParam(':user_lastname', $uLastName);
	$stmt->bindParam(':user_email', $eMail);
	$stmt->bindParam(':cellPhoneNum', $cellPhone);
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