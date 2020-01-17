<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/cdnj.inc.dbh.php';
include 'header.php';

$reservation =[
   "rmReserv"      => "",
   "reservDate"    => "",
   "reservTime"    => "",
   "endTime"       => "",
];

$reservations = "";

if (isset($_POST['reserv'])) {

   $reservation = [
      "rmReserv"     => $_POST['rmReserv'],
      "reservDate"   => $_POST['date'],
      "reservTime"   => $_POST['startTime'],
      "endTime"      => $_POST['endTime'],
   ];
   
   $sql = "SELECT 
      reservations.reservID,
      reservations.reservDate,
      rmlist.rmId,
      rmlist.rmName,
      reservations.reservTime,
      reservations.endTime,
      reservations.reservPurpose,
      cdnj_group.grName,
       If (reservations.reservStatus=False, 'Pending', 'Approved')
       AS status
     FROM reservations
     JOIN rmlist
       ON reservations.rmReserv = rmlist.rmId
LEFT JOIN cdnj_group
       ON reservations.reservGroup = cdnj_group.grId
    WHERE reservations.reservDate >= CURRENT_DATE()
      AND rmReserv = :rmReserv
      AND reservDate = :reservDate
      AND (reservTime < :endTime)
      AND (endTime > :reservTime)
 ORDER BY reservations.reservTime";

   $statement = $conn->prepare($sql);
   $statement->bindParam(':rmReserv',$reservation['rmReserv']);
   $statement->bindParam(':reservDate',$reservation['reservDate']);
   $statement->bindParam(':reservTime',$reservation['reservTime']);
   $statement->bindParam(':endTime',$reservation['endTime']);
   $statement->execute();
   $reservations = $statement->fetchAll();

   // Get room list for the Room drop-down list
   $sqlRm = "SELECT rmId, rmName FROM rmlist ORDER BY rmName";
   $stmt = $conn->prepare($sqlRm);
   $stmt->execute();
   $rooms = $stmt->fetchAll();

   // if ($reservations > 0) {
   //    $sql = "SELECT * FROM rm_reserved WHERE reservDate = :reservDate AND (reservTime >= :endTime) AND (endTime <= :reservTime)";

   //    $statement = $conn->prepare($sql);
   //    $statement->bindParam(':reservDate',$reservation["reservDate"]);
   //    $statement->bindParam(':reservTime',$reservation["reservTime"]);
   //    $statement->bindParam(':endTime',$reservation["endTime"]);
   //    $statement->execute();
   //    $reservations = $statement->fetchAll();
   // }
}