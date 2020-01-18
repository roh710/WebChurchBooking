<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require "includes/cdnj.inc.dbh.php";
include "includes/common.php";
require_once "header.php";
require "includes/functions.inc.cdbs.php";

// $_SESSION['user_list_uname'] = NULL;

if (!isset($_SESSION['user_list_uname'])) {
  $_SESSION['user_list_uname'] = $_GET['edit'];
}

if($_SESSION['user_list_uname'] != 'admin') {
  if (isset($_POST['update'])) {
    $user_info = [
      "user_name" => $_SESSION['user_list_uname'],
      "user_pwd"  => password_hash($_POST['user_pwd'], PASSWORD_BCRYPT)
    ];
    updateUserProfByUserName($user_info);
    // print_r($user_info);
    $_SESSION['user_list_uname'] = NULL;
    echo ("<script> window.location = './user_list.php'; </script>") ;
  }
} else {
  $_SESSION['user_list_uname'] = NULL;
  echo ("<script> window.location = './user_list.php'; </script>") ;
}

if($_SESSION['user_list_uname'] != 'admin') {
  if (isset($_POST['cancel'])) {
    $_SESSION['user_list_uname'] = NULL;
    echo ("<script> window.location = './user_list.php'; </script>") ;
  }
} else {
  $_SESSION['user_list_uname'] = NULL;
  echo ("<script> window.location = './user_list.php'; </script>") ;
}

// print_r($user_info);
?>

<div class="input-form2">
  <form method="POST" action="adminChgPwd.php">
  <h3>SUBJECT: <?php echo $_SESSION['user_list_uname']; ?></h3>
  <div>
    <label for="user_pwd">NEW PWD:</label>
    <input type="password" id="user_pwd" name="user_pwd" pattern=".{4,}" title="Must be at least four characters to CHANGE PASSWORD or to CANCEL TOO!" required="" autocomplete="off">
  </div>
  <div class="edit_btn2">
    <input type="submit" name="update" value="CHANGE PASSWORD">
  </div>
  <div class="edit_btn3">
    <input type="submit" name="cancel" value="CANCEL">
  </div>
</form>
<br>
</div>
<div class="table-caution">
  <table>
    <thead>
      <tr><th>주의사항 (CAUTION)</th></tr>
    </thead>
    <tbody>
      <tr><td>본 유저 인터페이스(UI)는 유저가 암호를 잊었을 경우, 암호를 재 설정하기 위한 UI 입니다. 유저의 요청없이 암호를 재 설정할 경우, 특정 유저는 LOGIN 못 할수 있습니다.</td></tr>
      <tr><td>암호 재 설정을 위해서 'NEW PWD'란에 새 암호를 입력한 후, 바로 밑에 위치한 'CHANGE PASSWORD' 버튼을 누르면 암호 재 설정 절차가 완료됩니다.</td></tr>
      <tr><td>암호변경 과정이 완료될 때 까지 다른 메뉴를 선택 하지마십시오!</td></tr>
      <tr><td>먄약 실수로 본 UI에 오셨다면 'CANCEL'를 선택해 이전 화면으로 돌아가십시오! CANCEL하기 위해서도 최소 4자 이상을 입력하고 CANCEL 버튼을 선택해 주십시오. 암호는 변경되지 않을것입니다.</td></tr>
      <tr><td>This User Interface(UI) exists to reset passwords at the request of users. Resetting the passwords without a request for a password reset may prevent a user from Logging in.</td></tr>
      <tr><td>To change the password, type-in new password in the "NEW PWD" input field. To complete the password change process, press the "CHANGE PASSWORD" button located right under the newly entered password.</td></tr>
      <tr><td>DO NOT select other menu items until the password change process is complete!</td></tr>
      <tr><td>If you are at this UI by error, select the "CANCEL" button to cancel and return to the previous screen! Must be at least four characters to CANCEL TOO! The password will not be changes.</td></tr>
    </tbody>
  </table>
</div>