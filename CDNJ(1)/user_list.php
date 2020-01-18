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

if (isset($_GET['del'])) {
  $del_id = $_GET['del'];
  if ($del_id != 'admin') {
    del_id($del_id);
    header("location: user_list.php");
    // echo ("<script> window.location = './user_list.php'; </script>") ;
  } else {
    header("location: user_list.php");
  } 
}

// User list and login counter.
$users = userList();
?>
 <!-- // Start View -->
<div class="users-table">
  <h2>USER LIST</h2>
  <table class="users-table">
      <thead>
        <tr>
          <th>USERNAME<br>/GROUP</th>
          <th>NAME/POSITION</th>
          <th>PHONE #</th>
          <th>EMAIL</th>
          <th>LAST LOGIN</th>
          <th># OF LOGIN(S)</th>
          <th colspan="2">ACTION</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($users as $row) : ?>
        <tr>
          <td><?php echo $row["user_name"]; ?><br><?php echo $row["grName"]; ?></td>
          <td><?php echo $row["user_kor_name"] . "/" . $row["user_title"]; ?></td>
          <td><?php echo $row["cellPhoneNum"]; ?></td>
          <td><?php echo $row["user_email"]; ?></td>
          <td><?php echo $row["Latest Login"]; ?></td>
          <td><a id="ed_btn" href="userConnDet.php?edit=<?php echo $row['user_name']; ?>"><?php echo $row["Count"]; ?></a></td>
          <td><a id="de_btn" href="adminChgPwd.php?edit=<?php echo $row['user_name']; ?>">ChgPwd</a></td>
          <td><a class="delete_link" id="de_btn" href="user_list.php?del=<?php echo $row['user_name']; ?>">Del</a></td>
        </tr>
      <?php endforeach ?>
      </tbody>
    </table>
</div>
<div style="margin-top: 55px;"></div>
<?php include 'footer.php'; ?>