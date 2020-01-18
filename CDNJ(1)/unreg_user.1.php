<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "includes/cdnj.inc.dbh.php";
$sql = "SELECT * FROM rm_reserved WHERE reservDate = '2019-05-16'";
$statement = $conn->prepare($sql);
$statement->execute();
$reservations = $statement->fetchAll();
?>
<!-- // Start View -->
<div class="group-table">
  <h2>APPROVED BOOKINGS</h2>
  <table class="group-table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Room</th>
        <th>Time Reserved</th>
        <th>Time Ending</th>
        <th>Group</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($reservations as $row) : ?>
      <tr>
        <td><?php echo $row["reservDate"]; ?></td>
        <td><?php echo $row["rmName"]; ?></td>
        <td><?php echo $row["reservTime"]; ?></td>
        <td><?php echo $row["endTime"]; ?></td>
        <td><?php echo $row["grName"]; ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
