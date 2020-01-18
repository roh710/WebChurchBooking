<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
//session_start();
require "header.php";
require "includes/cdnj.inc.dbh.php";
include "includes/common.php";

// To be used for populating Group-list drop-down list
// $uPermLevel = "User";
$grResults = $conn->prepare(
  "SELECT grId, grName
     FROM cdnj_group
    -- WHERE user_perm_level = :user_perm_level
 ORDER BY grName");
// $grResults->bindParam(':user_perm_level', $uPermLevel);
$grResults->execute();

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
    // echo "$fName"."<br>";
    // echo "$lName"."<br>";
    // echo "$kName"."<br>";
    // echo "$uName"."<br>";
    // echo "$grName"."<br>";
} else {
  //require "header.php";
  header('location: ./user_profile.php');
  exit();
}

if (isset($_POST['update'])) {
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
    "user_pwd"       => password_hash($_POST['user_pwd'], PASSWORD_BCRYPT),
  ];

  $sql = "UPDATE users SET
    user_firstname = :user_firstname,
    user_lastname = :user_lastname,
    user_email = :user_email,
    cellPhoneNum = :cellPhoneNum,
    user_group_fk = :user_group_fk,
    user_kor_name = :user_kor_name,
    user_title = :user_title,
    user_name = :user_name,
    user_pwd = :user_pwd
    WHERE user_id = :user_id";

    $prof_update = $conn->prepare($sql);
    $prof_update->bindParam(':user_firstname',$user_info['user_firstname']);
    $prof_update->bindParam(':user_lastname',$user_info['user_lastname']);
    $prof_update->bindParam(':user_email',$user_info['user_email']); 
    $prof_update->bindParam(':cellPhoneNum',$user_info['cellPhoneNum']);
    $prof_update->bindParam(':user_group_fk',$user_info['user_group_fk']);
    $prof_update->bindParam(':user_kor_name',$user_info['user_kor_name']);
    $prof_update->bindParam(':user_title',$user_info['user_title']);
    $prof_update->bindParam(':user_name',$user_info['user_name']);
    $prof_update->bindParam(':user_pwd',$user_info['user_pwd']);
    $prof_update->bindParam(':user_id',$user_info['user_id']);
    $prof_update->execute($user_info);
}
// echo ("<script> window.location = './user_profileBK.php'; </script>") ;
?>
<!-- <?php echo $_SESSION['uGrId']; ?> -->
<div class="u-profile">
  <table>
    <th colspan="3">User Information</th>
    <tr><td>Name: </td><td></td><td><?php echo "  " .  $fName . " " . $lName; ?></td></tr>
    <tr><td>Korean Name: </td><td></td><td><?php echo "$kName"; ?></td></tr>
    <tr><td>Title: </td><td></td><td><?php echo "$uTitle"; ?></td></tr>
    <tr><td>Cell Phone: </td><td></td><td><?php echo "$cellPhone"; ?></td></tr>
    <tr><td>Email: </td><td></td><td><?php echo "$uEmail"; ?></td></tr>
    <tr><td>Username: </td><td></td><td><?php echo "$uName"; ?></td></tr>
    <tr><td>Group: </td><td></td><td><?php echo "$grName"; ?></td></tr>
    <tr><td colspan="3"><a href="user_profileBK.php">EDIT</a></td></tr>
  </table>
  <form class="u-profile-form" action="user_profile.php" method="post">
  </form>
</div>
<div class="input-form">
  <form method="POST" action="user_profileBK.php">
    <h3>profile update</h3>
  <div>
    <label for="name">Name</label>
    <input class="input-form input-style1" type="text" id="name" name="user_firstname" value="<?php echo $fName ?>">
    <input class="input-form input-style1" type="text" name="user_lastname" value="<?php echo $lName ?>">
  </div>
  <div>
    <label for="user_kor_name">한글이름/직분</label>
    <input class="input-form input-style1" type="text" id="user_kor_name" name="user_kor_name" value="<?php echo $kName ?>">
    <input class="input-form input-style1" type="text" name="user_title" value="<?php echo $uTitle ?>">
  </div>
  <div>
    <label for="cellPhoneNum">Cellphone</label>
    <input type="text" id="cellPhoneNum" name="cellPhoneNum" value="<?php echo $cellPhone ?>">
  </div>
  <div>
    <label for="user_email">e-Mail</label>
    <input type="text" id="user_email" name="user_email" value="<?php echo $uEmail ?>">
  </div>
  <div>
    <label for="user_name">User Name</label>
    <input type="text" id="user_name" name="user_name" value="<?php echo $uName ?>">
  </div>
  <div>
    <label for="uGroup">Group</label>
    <select name="uGroup" required="">
      <option hidden value="">----- Select Group -----</option>
        <?php foreach ($grResults as $grResult) : ?>
      <option value="<?php echo escape($grResult["grId"]); ?>" 
        <?php echo $grResult["grId"] == $_SESSION['uGrId'] ? 'selected':''?>>
      <?php echo escape($grResult["grName"]); ?>
      </option>
        <?php endforeach; ?>
    </select>
  </div>
  <div>
    <input type="password" name="user_pwd" value="">
  </div>
  <div>
    <input type="submit" name="update" value="UPDATE">
  </div>
</form>
</div>
<!-- <?php echo ("<script> window.location = './user_profileBK.php'; </script>") ; ?> -->
<!-- <?php include 'footer.php'; ?> -->