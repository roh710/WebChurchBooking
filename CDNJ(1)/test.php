<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "includes/cdnj.inc.dbh.php";
require "header.php";

// initialize variables
$reservDate = "";
$reservRm = "";
$reservTime = "";
$endTime = "";

// Submit button is clicked
if (isset($_POST['submit'])) {
   $reservDate = $_POST['date'];
   $reservRm = $_POST['room'];
   $reservTime = $_POST['sat'];
   $endTime = $_POST['eat'];
   // $reservCheck = [
   //    "reservDate"   => $_POST['date'],
   //    "reservRm"     => $_POST['room'],
   //    "reservTime"   => $_POST['sat'],
   //    "endTime"      => $_POST['eat'],
   // ];
   // var_dump($reservCheck);
   // var_dump($reservRm)."<br>";
   // var_dump($reservDate);
   // var_dump($reservTime);
   // var_dump($endTime);
  
  // $sql = "SELECT * FROM rm_reserved WHERE reservDate = :reservDate AND rmName = :rmName AND :reservTime BETWEEN reservTime + INTERVAL 1 MINUTE AND endTime - INTERVAL 1 MINUTE
  // OR $endTime BETWEEN reservTime + INTERVAL 1 MINUTE AND endTime - INTERVAL 1 MINUTE";
  
  // $sql = "SELECT * FROM rm_reserved WHERE DATE_SUB(reservTime, INTERVAL 1 MINUTE) = :reservTime";

  $sql = "SELECT * FROM rm_reserved WHERE reservDate = :reservDate AND rmName = :rmName AND reservTime = :reservTime AND endTime = :endTime";

  $statement = $conn->prepare($sql);
  $statement->bindValue(':reservDate', $reservDate);
  $statement->bindValue(':rmName', $reservRm);
  $statement->bindvALUE(':reservTime', $reservTime);
  $statement->bindvALUE(':endTime', $endTime);
  $statement->execute();
  $reservations = $statement->fetchAll();
}
// var_dump($reservations);
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>check booking conflict</title>
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <!-- Start View -->
    <div class="group-form">
    <form class="group-form" method="POST" action="test.php">
      <h2>CHECK BOOKING CONFLICT</h2>
      <div>
        <label>date</label>
        <input type="date" name="date">
      </div>
      <div>
        <label>Room</label>
        <input type="text" name="room">
      <div>
        <label>sat</label>
        <input type="time" name="sat">
      </div>
      <div>
        <label>eat</label>
        <input type="time" name="eat">
      </div>
      <div class="add_btn">
        <input type="submit" name="submit" value="check conflict">
      </div>
    </form>
    </div>
    <!-- table view -->
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
  </body>
</html>