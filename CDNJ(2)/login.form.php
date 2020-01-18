<?php
  if (isset($_SESSION['user_info'])) {
    // Redirecting page to about_cdnj.php once logged-in and not show login-form
    header('location:rm_booked.php');
    exit();
  }
?>
  <div class="box">
    <h2>LOGIN</h2>
    <form action="includes/login.inc.php" method="post">
      <div class="input-box">
        <input type="text" name="user_name" required="" autocomplete="off">
        <label for="user_name">Username</label>
      </div>
      <div class="input-box">
        <input type="password" name="user_pwd" required="" autocomplete="off">
        <label for="user_pwd">Password</label>
      </div>
      <div class="input-box">
        <input type="submit" name="login-submit" value="LOGIN">
      </div>
      <div id="register">
        <a href="register.php">Register New User</a>
      </div>
    </form>
  </div>
