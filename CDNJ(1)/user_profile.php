<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
//session_start();
require "header.php";
require "includes/cdnj.inc.dbh.php";
require "includes/functions.inc.cdbs.php";

// Initialize
$msg = "";

// To be used for populating Group-list drop-down list
// $uPermLevel = "User";
if ($_SESSION['uPermission'] == "Admin") {
  $grResults = $conn->prepare(
    "SELECT grId, grName
       FROM cdnj_group
   ORDER BY grName");
  $grResults->bindParam(':user_perm_level', $_SESSION['uPermission']);
  $grResults->execute();
} else {
  $grResults = $conn->prepare(
    "SELECT grId, grName
       FROM cdnj_group
      WHERE user_perm_level = :user_perm_level
   ORDER BY grName");
  $grResults->bindParam(':user_perm_level', $_SESSION['uPermission']);
  $grResults->execute();
}

if (isset($_SESSION['user_info'])) {
  $user = $conn->prepare("SELECT * 
  FROM users
  JOIN cdnj_group
  ON users.user_group_fk = cdnj_group.grId 
  WHERE user_id = :user_id");
    $user->bindParam(':user_id', $_SESSION['user_id']);
    $user->execute();
    $result = $user->fetch(PDO::FETCH_ASSOC);
    $uID = $_SESSION['user_id'];
    $fName = $result['user_firstname'];
    $lName = $result['user_lastname'];
    $kName = $result['user_kor_name'];
    $uTitle = $result['user_title'];
    $cellPhone = $result['cellPhoneNum'];
    $uEmail = $result['user_email'];
    $uName = $result['user_name'];
    $grName = $result['grName'];
} else {
  header('location: ./user_profile.php');
  exit();
}

if (isset($_POST['update'])) {
  if ($_POST['user_pswd'] == $_POST['user_pswd_rpt']) {
    
    $user_info = [
      "user_id"        => $_SESSION['user_id'],
      "user_firstname" => $_POST['user_firstname'],
      "user_lastname"  => $_POST['user_lastname'],
      "user_email"     => $_POST['user_email'],
      "cellPhoneNum"   => $_POST['cellPhoneNum'],
      "user_group_fk"  => $_POST['uGroup'],
      "user_kor_name"  => $_POST['user_kor_name'],
      "user_title"     => $_POST['user_title'],
      "user_name"      => $_POST['user_name'],
      "user_pwd"       => password_hash($_POST['user_pswd'], PASSWORD_BCRYPT),
    ];

    // Check if the username, email or group has been already registered ($reg).
    $reg = registered($user_info);
    // echo 'User profile updated sucessfully!';
    // print_r($msg);
    if ($reg == 0) {
      updateUserProf($user_info);
      // header("refresh:3; url=../register.php");
      $msg ='프로필이 성공적으로 업데이트 되었습니다!<BR>유저네임 또는 소속그룹이 변경되었을 경우, 다시 로그아웃/로그인해 주십시오.';
    } else {
      // header("refresh:3; url=../register.php");
			$msg = "The username: " . $_POST['user_name'] . " or e-Mail: " . $_POST['user_email'] . " or the Group you've selected, has been alredy Registered!";
    }
  
} else {
  // header("refresh:3; url=./user_profile.php");
  $msg = "입력한 암호가 맞지않습니다!";
  }
}
?>
<!-- <?php echo $_SESSION['uGrId']; ?> -->
<div class="u-profile">
  <table>
    <?php if ($msg != ""): ?>
      <tr colspan="3"><h3 class="msg"><?php echo $msg ?></h3></tr>
      <?php header("refresh:3; url=./edit_profile.php"); ?>
    <?php endif ?>
    <th colspan="3">유저 프로필</th>
    <tr><td>이름(영문): </td><td></td><td><?php echo "  " .  $fName . " " . $lName; ?></td></tr>
    <tr><td>이름/직분(한글): </td><td></td><td><?php echo "$kName" . " " . "$uTitle"; ?></td></tr>
    <tr><td>휴대전화: </td><td></td><td><?php echo "$cellPhone"; ?></td></tr>
    <tr><td>이메일: </td><td></td><td><?php echo "$uEmail"; ?></td></tr>
    <tr><td>유저네임 / 소속그룹: </td><td></td><td><?php echo $_SESSION['uName'] . " / " . "$grName"; ?></td></tr>
    <tr><td colspan="3"><a href="edit_profile.php">UPDATE</a></td></tr>
  </table>
  <form class="u-profile-form" action="user_profile.php" method="post">
  </form>
</div>
<?php include 'footer.php'; ?>