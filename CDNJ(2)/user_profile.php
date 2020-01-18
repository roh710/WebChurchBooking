<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
//session_start();
require "header.php";
require "includes/cdnj.inc.dbh.php";

if (isset($_SESSION['user_info'])) {
   $user = $conn->prepare("SELECT * FROM userinfo_perm WHERE user_name = :user_name");
   $user->bindParam(':user_name', $_SESSION['uName']);
   $user->execute();
   $result = $user->fetch(PDO::FETCH_ASSOC);
   $fName = $result['user_firstname'];
   $lName = $result['user_lastname'];
   $kName = $result['user_kor_name'];
   $uTitle = $result['user_title'];

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

?>
<div class="u-profile">
  <table>
    <th>User Information</th>
    <tr><td><?php echo "$fName"; ?></td></tr>
    <tr><td><?php echo "$lName"; ?></td></tr>
    <tr><td><?php echo "$kName"; ?></td></tr>
    <tr><td><?php echo "$uTitle"; ?></td></tr>
    <tr><td><?php echo "$uName"; ?></td></tr>
    <tr><td><?php echo "$grName"; ?></td></tr>
    <tr><td><a href="#">EDIT</a></td></tr>
  </table>
  <form class="u-profile-form" action="user_profile.php" method="post">

  </form>

</div>
