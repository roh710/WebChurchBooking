<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// session_start();
// require "header.php";
require "includes/cdnj.inc.dbh.php";
include "user_profile.php";
include "includes/common.php";

?>
<!-- <?php if(isset($_POST['update'])): ?>
<?php print_r($prof_update); ?>
<?php endif; ?> -->
<!-- <?php echo $_SESSION['uGrId']; ?> -->
<div class="profile-form">
  <form method="POST" action="user_profile.php">
    <h3>프로필 편집</h3>
  <div>
    <label for="name">이름(영문):</label>
    <input class="input-form input-style1" type="text" id="name" name="user_firstname" pattern="[a-zA-Z\-]+" value="<?php echo $fName ?>">
    <input class="input-form input-style1" type="text" name="user_lastname" pattern="[a-zA-Z\-]+" value="<?php echo $lName ?>">
  </div>
  <div>
    <label for="user_kor_name">이름/직분(한글):</label>
    <input class="input-form input-style1" style="ime-mode:active;" type="text" id="user_kor_name" name="user_kor_name" pattern="[가-힣]+" value="<?php echo $kName ?>">
    <input class="input-form input-style1" style="ime-mode:active;" type="text" name="user_title" pattern="[가-힣]+" value="<?php echo $uTitle ?>">
  </div>
  <div>
    <label for="cellPhoneNum">휴대전화:</label>
    <input type="text" id="cellPhoneNum" name="cellPhoneNum" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" value="<?php echo $cellPhone ?>">
  </div>
  <div>
    <label for="user_email">이메일:</label>
    <input type="email" id="user_email" name="user_email" value="<?php echo $uEmail ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$">
  </div>
  <div class="clr"></div>
  <div>
    <label for="user_name">유저네임:</label>
    <input type="text" name="user_name" value="<?php echo $_SESSION['uName'] ?>" pattern="(?=^.{6,}$)^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" title="Must be atleast six character in length, consisting lettes and/or numbers only" required="" autocomplete="off">
    <!-- <input type="text" id="user_name" name="user_name" value="<?php echo $uName ?>"> -->
  </div>
  
  <div>
    <label for="uGroup">소속그룹:</label>
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
    <label for="user_pswd">암호:</label>
    <input type="password" name="user_pswd" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must be atleast six characters and must contain atleast one upper case and, one number or special character(s)" required="" autocomplete="off">
    <!-- <input type="password" name="user_pswd" id="user_pswd"> -->
  </div>
  <div>
    <label for="user_pswd_rtp">암호 반복:</label>
    <input type="password" name="user_pswd_rpt" id="user_pswd_rtp">
  </div>
  <div class="add_btn">
    <input type="submit" name="update" value="편 집">
  </div>
</form>
</div>
<?php echo "<br/>"; ?>
<?php echo "<br/>"; ?>
<?php echo "<br/>"; ?>
<?php include 'footer.php'; ?>