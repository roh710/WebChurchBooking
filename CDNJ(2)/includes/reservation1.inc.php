<?php
require 'cdnj.inc.dbh.php';

// Initiolize variables
$rsRm = "";
$rsDate = "";
$rsTime = "";
$rseTime = "";
$rsPurpose = "";
$reStatus = "";

$edit_state = false;

if(isset($_SESSION['user_info'])) {
  $stmt = $conn->query("SELECT * FROM rm_reserved"); // REVIEW: Showing rm_booked VIEW
  $rmResults = $conn->query("SELECT rmId, rmName FROM rmlist ORDER BY rmName ASC"); // REVIEW: to be used for populating drop-down list

  echo "<table>";
  echo "<caption>ROOM RESERVATION LIST</caption>";
  echo "<tr>
          <th>Date</th>
          <th>Room</th>
          <th>Time Reserved</th>
          <th>Time Ending</th>
          <th>Purpose</th>
          <th>Group</th>
          <th>Status</th>
          <th colspan=4>Action</th>
        </tr>\n";

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $rmReserv = htmlentities($row['rmName']);
     $reservDate = htmlentities($row['reservDate']);
     $reservTime = htmlentities($row['reservTime']);
     $endTime = htmlentities($row['endTime']);
     $reservPurpose = htmlentities($row['reservPurpose']);
     $reservGroup = htmlentities($row['grName']);
     $reservStatus = htmlentities($row['status']);
     $reservID = htmlentities($row['reservID']);

     echo "
        <tr>
           <td>$reservDate</td>
           <td>$rmReserv</td>
           <td>$reservTime</td>
           <td>$endTime</td>
           <td>$reservPurpose</td>
           <td>$reservGroup</td>
           <td>$reservStatus</td>
           <td><a class=ed_btn href=reservation.php?edit=$reservID>Edit</a></td>
           <td><a class=de_btn href=reservation.php?delete=$reservID>Delete</a></td>
           <td><a class=ap_btm href=reservation.php?app=$reservID>Aprv</a></td>
           <td><a class=ap_btm href=reservation.php?dapp=$reservID>D-Aprv</a></td>
        </tr>";
   }

   // Get form populated with selected record by clicked 'Edit' button.
   if (isset($_GET['edit'])) { // Get id from url
      $rsID = $_GET['edit'];
      $query = $conn->query("SELECT * FROM reservations WHERE reservID = $rsID");
      $record = $query->fetch(PDO::FETCH_ASSOC);

      $rsRm = $record['rmReserv']; // rmReserv is an INTEGER field.
      $rsDate = $record['reservDate'];
      $rsTime = $record['reservTime'];
      $rseTime = $record['endTime'];
      $rsPurpose = $record['reservPurpose'];
      $edit_state = true; // Change $edit_state = false to true.
   }

   // Delete record selected by clicked 'Delete' button.
   if (isset($_GET['delete'])) {
      $rsID = $_GET['delete'];
      $query = $conn->query("DELETE FROM reservations WHERE reservID = $rsID");
      header("Refresh:0; url=./index.php");
   }

   // Approve reservation stutus.
   if (isset($_GET['app'])) {
     $rsID = $_GET['app'];
     $query = $conn->query("UPDATE reservations SET reservStatus = 1 WHERE reservID = $rsID");
     header("Refresh:0; url=./index.php");
   }

   // Dis-approve reservation stutus.
   if (isset($_GET['dapp'])) {
     $rsID = $_GET['dapp'];
     $query = $conn->query("UPDATE reservations SET reservStatus = 0 WHERE reservID = $rsID");
     header("Refresh:0; url=./index.php");
  }
}
?>
