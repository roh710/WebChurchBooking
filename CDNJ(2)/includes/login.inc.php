<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
  if (isset($_POST['login-submit'])) {
    require 'cdnj.inc.dbh.php';
    $uName = $_POST['user_name'];
    $uPwd = $_POST['user_pwd'];

    // user_name and user_pwd are set into variable $record
    if (!empty($uName) && !empty($uPwd)) {
      $record = $conn->prepare('SELECT * FROM userinfo_perm WHERE user_name = :user_name');
   	  $record->bindParam(':user_name', $uName);
     	$record->execute();
      $result = $record->fetch(PDO::FETCH_ASSOC);
      // var_dump($result);

      // Used rowcount() instead of count($results).
      if($record->rowcount() && password_verify($uPwd, $result['user_pwd'])) {
         session_start();
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['uGrId'] = $result['grId'];
            $_SESSION['user_info'] = $result['user_firstname'] . ' ' .  $result['user_lastname'] . ' (' . $result['user_kor_name'] . ' ' . $result['user_title'] . '님 - ' . $result['user_perm_level'] . ')';
            $_SESSION['user_group'] = $result['grName'];
            $_SESSION['uPermission'] = $result['user_perm_level'];
            $_SESSION['uName'] = $result['user_name'];
      } else {
         echo "No matching ID or Password do not match!";
         // header('refresh:3; url=./index.php');
         // exit();
      }
    }
  }
  header("Location: ../index.php");
 ?>
