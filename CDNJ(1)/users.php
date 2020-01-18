<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['user_info'])) {
   header('location: login.form.php');
}

require "includes/cdnj.inc.dbh.php";
include_once 'header.php';
include 'includes/functions.inc.cdbs.php';

// User list and login counter.
$users = userList();
?>
 <!-- // Start View -->
<div class="users-table">
  <h2>USER LIST</h2>
  <table class="users-table">
    <thead>
      <tr>
        <th>유저네임</th>
        <th>소속그룹</th>
        <th>성도이름/직분</th>
        <th>휴대전화</th>
        <th>이메일</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $row) : ?>
      <tr>
        <td><?php echo $row["grName"]; ?></td>
        <td><?php echo $row["user_name"]; ?></td>
        <td><?php echo $row["user_kor_name"] . "/" . $row["user_title"]; ?></td>
        <td><?php echo $row["cellPhoneNum"]; ?></td>
        <td><?php echo $row["user_email"]; ?></td>
      </tr>
    <?php endforeach ?>
    </tbody>
  </table>
</div>
<div style="margin-top: 55px;"></div>
</div>
<?php include 'footer.php'; ?>