<?php
if (!isset($_SESSION['user_info'])) {
  session_start();
}
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
/*
 * List all users with a link to edit
 */
require "cdnj.inc.dbh.php";
require "functions.inc.cdbs.php";
require "common.php";

// Initialize
$reservation = [
  "reservID"      => "",
  "reservDate"    => "",
  "rmReserv"      => "",
  "reservTime"    => "",
  "endTime"       => "",
  "reservPurpose" => "",
  "reservGroup"   => "",
  "reservStatus"  => ""
];

$msg = "";
$conf['rowCount'] = "";
$conf['reservations'] = "";
$edit_state = false;

// Clear form fields
if (isset($_POST['clr'])) {
  // echo ("<script> location.reload('./initial_pass.php'); </script>") ;
  echo ("<script> window.location = './initial_pass.php'; </script>") ;
  // header('location: ./index.php');
}

if (isset($_POST['update'])) {
  if ($_POST['reservTime'] < $_POST['endTime']) {
    $reservation = [
      "reservID"      => $_POST['reservID'],
      "reservDate"    => $_POST['reservDate'],
      "rmReserv"      => $_POST['rmReserv'],
      "reservTime"    => $_POST['reservTime'],
      "endTime"       => $_POST['endTime'],
      "reservGroup"   => $_SESSION['uGrId'],
      "reservPurpose" => $_POST['reservPurpose'],
      "reservStatus"  => "0"
    ];

    // Call function confUpdate to update booking if there is no conflict!
    $conf = confUpdate($reservation);
    if ($conf['rowCount'] > 1) {
      $msg = "<h4>There are " . $conf['rowCount'] . " conflicts!</h4>";
    } elseif ($conf['rowCount'] == 1) {
      $msg = "<h4>There is " . $conf['rowCount'] . " conflict!</h4>";
    }else {
      $msg = "<h5>Booked!</h5>";
    }
  // echo ("<script> window.location = './initial.php'; </script>") ;

  } else {
    $msg = '<h4 class="msg">'.'시작시간과 끝시간이 같거나, 시작시간이 끝시간보다 더 늦은 시간입니다. 시간 확인바랍니다.'.'</h4>';
  }
}

if (isset($_POST['book'])) {
  if ($_POST['reservTime'] < $_POST['endTime']) {

    $reservation = array(
      "reservDate"    => $_POST['reservDate'],
      "rmReserv"      => $_POST['rmReserv'],
      "reservTime"    => $_POST['reservTime'],
      "endTime"       => $_POST['endTime'],
      "reservPurpose" => $_POST['reservPurpose'],
      "reservGroup"   => $_SESSION['uGrId'],
      "reservStatus"  => "0"
    );

  // call function, add booking if there is no conflict!
  $conf = confBook($reservation);
    if ($conf['rowCount'] > 1) {
      $msg = "<h4>There are " . $conf['rowCount'] . " conflicts!</h4>";
    } elseif ($conf['rowCount'] == 1) {
      $msg = "<h4>There is " . $conf['rowCount'] . " conflict!</h4>";
    }else {
      $msg = "<h5>Booked!</h5>";
    }
  
  } else {
    $msg = '<h4 class="msg">'.'시작시간과 끝시간이 같거나, 시작시간이 끝시간보다 더 늦은 시간입니다. 시간 확인바랍니다.'.'</h4>';
  }
}


// get reservation list
// JOIN query stmt for tables - reservations, rmlist, cdnj_group
    $sql =
      "SELECT reservations.reservID,
        reservations.reservDate,
        CASE DAYOFWEEK(reservDate)
          WHEN '1' THEN '주  일'
          WHEN '2' THEN '월요일'
          WHEN '3' THEN '화요일'
          WHEN '4' THEN '수요일'
          WHEN '5' THEN '목요일'
          WHEN '6' THEN '금요일'
          ELSE '토요일'
        END AS wkDay,
        rmlist.rmId,
        rmlist.rmName,
        TIME_FORMAT(reservations.reservTime, '%l:%i %p') AS st,
        TIME_FORMAT(reservations.endTime, '%l:%i %p') AS et,
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
     ORDER BY reservations.reservDate, reservations.reservTime ASC";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $reservations = $statement->fetchAll();

// get room list
    $sql = "SELECT * FROM rmlist ORDER BY rmName ASC";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $rooms = $statement->fetchAll();

// if click edit button
if (isset($_GET['ed'])) {
  $edit_state = true;
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
  header("location:./index.php");
  //exit();
}