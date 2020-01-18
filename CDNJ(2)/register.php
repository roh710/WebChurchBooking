<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
 require "header.php";
 require "includes/cdnj.inc.dbh.php";

 if (isset($_SESSION['user_info'])) {
    header("location: ./index.php");
    exit;
 } else {
   $grResults = $conn->query("SELECT grId, grName FROM cdnj_group WHERE user_perm_level='User' ORDER BY grName ASC"); // REVIEW: to be used for populating drop-down list

 }
?>
<body>
	<div class="box-reg">
		<h2>Register</h2>
		<form action="includes/register.inc.php" method="POST">
			<div class="input-box-reg">
				<input type="text" name="uFirstName" required="" autocomplete="off">
				<label>Firstname</label>
			</div>
			<div class="input-box-reg">
				<input type="text" name="uLastName" required="" autocomplete="off">
				<label>Lastname</label>
			</div>
			<div class="input-box-reg">
				<input type="text" name="uKorName" required="" autocomplete="off">
				<label>Korean Name</label>
			</div>
      <div class="input-box-reg">
				<input type="text" name="uTitle" required="" autocomplete="off">
				<label>Title</label>
			</div>
			<div class="input-box-reg">
				<input type="text" name="uName" required="" autocomplete="off">
				<label>Username</label>
			</div>
			<div class="input-box-reg">
				<input type="text" name="eMail" required="" autocomplete="off">
				<label>E-mail</label>
			</div>
      <div class="input-box-reg">
        <select name="uGroup" required="">
          <!-- Below: "selected" attribute will show initial value and "hidden" attribute will hide from options -->
  				<option selected hidden value=''>Select Group</option>";
  					<?php
  						while ($grResult = $grResults->fetch(PDO::FETCH_ASSOC)) {
              $grId = $grResult['grId'];
  						$grName = $grResult['grName'];
  						echo "<option value='$grId'>$grName</option>";
              // var_dump($grId);
  						}
  					?>
          </option>
  			</select>
      <label>Group</label>
      </div>
			<div class="input-box-reg">
				<input type="password" name="uPwd" required="" autocomplete="off">
				<label>Password</label>
			</div>
			<div class="input-box-reg">
				<input type="password" name="confirm_uPwd" required="" autocomplete="off">
				<label>password Repeat</label>
			</div class="input-box-reg"><?php // REVIEW: Does not span full width of the form ?>
			<input type="submit" name="submit" value="REGISTER">
		</form>
</body>
