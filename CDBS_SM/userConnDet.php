<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require "includes/cdnj.inc.dbh.php";
include 'includes/functions.inc.cdbs.php';

session_start();
if (!isset($_SESSION['user_info'])) {
   header('location: login.form.php');
}

include_once 'header.php';

// User list and login counter.
$users = userConnDet();
$x = 1;

// Get user_id from url
if (isset($_GET['edit'])) {
  $uId = $_GET['edit'];

  // Call function ip_det()
  $ip_detail = ip_det($uId);
}
?>
<!-- <?php var_dump($ip_detail['ip_info']); ?> -->
<?php if (isset($_GET['edit'])): ?>
  <div class="users-table">
  <?php if ($ip_detail['rowCount'] < 10): ?>
    <h2>IP CONNECTION DETAILS</h2>
  <?php else: ?>
    <h2>IP CONNECTION DETAILS: LAST 10 CONNECTIONS ONLY</h2>
  <?php endif ?>
    <table class="users-table-det-1">
      <thead>
        <?php foreach ($ip_detail['ip_info'] as $row) : ?>
          <?php $user = $row["user_name"]; ?>
          <?php $group = $row["grName"]; ?>
        <?php endforeach; ?>
      </thead>
      <tbody>
      <tr><th colspan = "7">USERNAME / GROUP</th></tr>
        <tr><td colspan = "7"><?php echo $user . " / " . $group; ?></td></tr>
      </tbody>
    </table>
  </div>
  <div>
    <table class="users-table-det">
      <thead>
          <th># </th>
          <th>IP ADDR<br>ISP</th>
          <th>CITY | STATE(REGION)</th>
          <th>POSTAL<br>CODE</th>
          <th>COUNTRY</th>
          <th>LOGIN DATE<br>& TIME</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($ip_detail['ip_info'] as $row) : ?>
        <?php if ($row["ip_addr"] == NULL): ?>
          <tr>
            <td colspan="7"><h3>NO CONNECTION</h3></td>
          </tr>
        <?php else: ?>
        <tr>
          <td><?php echo $x++; ?></td>
          <td><?php echo $row["ip_addr"] . "<br>" . $row["isp"]; ?></td>
          <td><?php echo $row["city"] . " | " . $row["region"]; ?></td>
          <td><?php echo $row["zip"]; ?></td>
          <td><?php echo $row["country"]; ?></td>
          <td><?php echo $row["date_time_stamp"]; ?></td>
        </tr>
        <?php endif ?>
        <?php endforeach; ?>
        <tr><td colspan="7"><a href="user_list.php"><< BACK</a></td></tr>
      </tbody>
    </table>
  </div>
  <!-- <div style="margin-top: 55px;"></div>
  <?php include 'footer.php'; ?> -->
<?php endif ?>
