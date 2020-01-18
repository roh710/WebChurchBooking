<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$msg = '';
  if (isset($_POST['login-submit'])) {
    require 'cdnj.inc.dbh.php';
    include 'functions.inc.cdbs.php';
    $uName = trim($_POST['user_name']);
    $uPwd = trim($_POST['user_pwd']);

    // user_name and user_pwd are set into variable $record
    if (!empty($uName) && !empty($uPwd)) {
      $active_status = "1";
      $record = $conn->prepare('SELECT * FROM userinfo_perm 
      WHERE user_name = :user_name AND active_status = :active_status');
       $record->bindParam(':user_name', $uName);
       $record->bindParam(':active_status', $active_status);
     	$record->execute();
      $result = $record->fetch(PDO::FETCH_ASSOC);

      // Used rowcount() instead of count($results).
      if($record->rowcount() && password_verify($uPwd, $result['user_pwd'])) {
        session_start();

        $_SESSION['timeout'] = time() + 30;
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['uGrId'] = $result['grId'];
        $_SESSION['user_info'] = $result['user_firstname'] . ' ' .  $result['user_lastname'] . ' (' . $result['user_kor_name'] . ' ' . $result['user_title'] . '님 - ' . $result['user_name'] . ')';
        $_SESSION['user_group'] = $result['grName'];
        $_SESSION['uPermission'] = $result['user_perm_level'];
        $_SESSION['uName'] = $result['user_name'];

        // Call function userConnInfo() to INSERT records into user_conn_info if user_name <> roh710
        if ($result['user_name'] <> 'roh710') {
          userConnInfo();
        }
        
        echo ("<script> window.location = '../index.php'; </script>") ;
      } else {
        $msg = "No such ID or wrong password!";
        header('location: ../login.form.php');
      }
    }
  }