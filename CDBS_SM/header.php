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
      <?php if (isset($_SESSION['user_info'])): ?>
      <div class="header-par3">
        <?php
          echo '<form action="includes/logout.inc.php" method="POST">
          <button type="submit" name="logout-submit">LOGOUT</button>
          </form>';
        ?>
      </div>
      <div class="header-par2">
      <?php else: ?>
        <a href="./login.form.php">LOGIN</a>
      <?php endif ?>
      </div>
    </div>
    <div class="header-container">
      <div class="header-nav1">
        <?php include "includes/nav.php"; ?>
      </div>
      <div class="header-nav2">
        <?php if (isset($_SESSION['user_info'])): ?>
          <?php
            echo "Welcome " . $_SESSION['user_info'] . ",
            " . "<br>";
            echo "You are a member of " . $_SESSION['user_group'] . " Group.";
          ?>
        <?php endif ?>
      </div>
    </div>