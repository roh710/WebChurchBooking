<?php
if (!isset($_SESSION['user_info'])) {
   session_start();
}
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
      <meta charset="utf-8">
      <!-- <meta http-equiv="refresh" content="0" /> -->
      <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <script src="scripts.js"></script>
      <title>CDBS</title>
   </head>
   <body>
      <div class="header">
         <h1>Cham-Doen Presbyterian Church Booking System</h1>
      </div>
      <div class="header-nav">
         <?php include "includes/nav.php"; ?>
      </div>
      <div class="header-par1">
         <?php if (isset($_SESSION['user_info'])): ?>
            <div">
               <?php
                  echo "Welcome " . $_SESSION['user_info'] . ",
                  ";
                  echo "<br>" . "귀하는 " . $_SESSION['user_group'] . " 소속 사용자입니다.";
               ?>
            </div>
            <div class="header-par3">
               <?php
                  echo '<form action="includes/logout.inc.php" method="POST">
                  <button type="submit" name="logout-submit">LOGOUT</button>
                  </form>';
               ?>
            </div>
         <?php else: ?>
            <div class="header-par2"><a href="./login.form.php">LOGIN</a>
            </div><br>
         <?php endif; ?>
      </div>
