<?php
include 'header.php';
include 'includes/login.inc.php';
// var_dump($msg);
  if (isset($_SESSION['user_info'])) {
    // Directing page to about_cdnj.php once logged-in and not show login-form
    header('location:initial.php');
    exit();
  }
  // print_r($msg);
?>
  <div class="box">
    <h2>LOGIN</h2>
    <form action="includes/login.inc.php" method="post">
      <div class="input-box">
        <input type="text" name="user_name" autofocus required="" autocomplete="off">
        <label for="user_name">Username</label>
      </div>
      <div class="input-box">
        <input type="password" name="user_pwd" required="" autocomplete="off">
        <label for="user_pwd">Password</label>
      </div>
      <div class="input-box">
        <input type="submit" name="login-submit" value="LOGIN"><br>
      </div>
      <div id="register">
        <a href="register.php">Register New User</a>
        <!-- <h4><?php echo var_dump($msg); ?></h4> -->
        <?php if (!empty($msg)): ?>
          <h4 class="msg"><?php echo $msg; ?></h4>
        <?php endif ?>
      </div>
    </form>
  </div>
