<?php
if (!isset($_SESSION['user_info'])) {
  session_start();
}
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
/**
 * List all users with a link to edit
 */
require "includes/cdnj.inc.dbh.php";
// require "includes/config.php";
require "includes/common.php";

if (isset($_POST['update'])) {

  $reservation =[
      "reservID"      => $_GET['ed'],
      "reservDate"    => $_POST['reservDate'],
      "rmReserv"      => $_POST['rmReserv'],
      "reservTime"    => $_POST['reservTime'],
      "endTime"       => $_POST['endTime'],
      "reservPurpose" => $_POST['reservPurpose'],
  ];

  // UPDATE SQL statement.
  $sql = "UPDATE reservations SET
         rmReserv = :rmReserv,
         reservDate = :reservDate,
         reservTime = :reservTime,
         endTime = :endTime,
         reservPurpose = :reservPurpose,
         reservStatus = 0
         WHERE reservID = :reservID";

  $statement = $conn->prepare($sql);
  $statement->execute($reservation);

  // REVIEW: Re-route to index.php after an update
  echo ("<script> window.location = './reserv_pass.php'; </script>") ;
}

if (isset($_POST['create'])) {

  $new_reservation = array(
  "reservDate"    => $_POST['reservDate'],
  "rmReserv"      => $_POST['rmReserv'],
  "reservTime"    => $_POST['reservTime'],
  "endTime"       => $_POST['endTime'],
  "reservPurpose" => $_POST['reservPurpose'],
  "reservGroup"   => $_SESSION['uGrId'],
  "reservStatus"  => "0"
);

  $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "reservations",
      implode(", ", array_keys($new_reservation)),
      ":" . implode(", :", array_keys($new_reservation))
      );

  $statement = $conn->prepare($sql);
  $statement->execute($new_reservation);
}


// get reservation list
// JOIN query stmt for tables - reservations, rmlist, cdnj_group
    $sql =
      "SELECT reservations.reservID,
        reservations.reservDate,
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
     ORDER BY reservations.reservDate ASC";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $reservations = $statement->fetchAll();

// get room list
    $sql = "SELECT rmId, rmName FROM rmlist ORDER BY rmName ASC";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $rooms = $statement->fetchAll();

// if click edit button
if (isset($_GET['ed'])) {
    $ed = $_GET['ed'];

  $sql = "SELECT * FROM reservations WHERE reservID = :ed";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':ed', $ed);
  $statement->execute();

  $reservation = $statement->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET['del'])) {
  $rsID = $_GET['del'];
  $query = $conn->query("DELETE FROM reservations WHERE reservID = $rsID");

  $reservation = $statement->fetch(PDO::FETCH_ASSOC);
  header("location:./reserv_pass.php");
  //exit();
}

if (isset($_GET['apr'])) {
  $rsID = $_GET['apr'];
  $query = $conn->query("UPDATE reservations SET reservStatus = True WHERE reservID = $rsID");
  header("location:./reserv_pass.php");
  //exit();
}

if (isset($_GET['dapr'])) {
  $rsID = $_GET['dapr'];
  $query = $conn->query("UPDATE reservations SET reservStatus = False WHERE reservID = $rsID");
  header("location:./reserv_pass.php");
  //exit();
}
?>
