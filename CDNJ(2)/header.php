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
    <title>CDNJ</title>
  </head>
  <body>
    <div class="header">
       CDNJ - ChamDoin Presbyterian Church
    </div>
    <div class="header-nav">
       <?php include "includes/nav.php"; ?>
    </div>
    <div>
       <?php if (isset($_SESSION['user_info'])): ?>
          <div class="header-par1">
             <?php
                echo "Welcome " . $_SESSION['user_info'] . ",
                ";
                echo "<br>" . "You're a member of " . $_SESSION['user_group'] . ".";
             ?>
             <div class="header-par3">
             <?php
                echo '<form action="includes/logout.inc.php" method="POST">
                <button type="submit" name="logout-submit">LOGOUT</button>
                </form>';
             ?>
          </div>
       <?php else: ?>
          <div class="header-par1">Login with Username & Password</div><br>
       <?php endif; ?>
    </div>
  </body>
</html>
