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
require "common.php";
require "functions.inc.cdbs.php";

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
$ed = "";
$msg = "";
$conf['rowCount'] = "";
$conf['reservations'] = "";
// $update_reserv['reservPurpose'] = "";
$edit_state = false;

if (isset($_POST['update'])) {
  if ($_POST['reservTime'] < $_POST['endTime']) {

  $reservation = [
    "reservID"      => $_GET['ed'],
    "reservDate"    => $_POST['reservDate'],
    "rmReserv"      => $_POST['rmReserv'],
    "reservTime"    => $_POST['reservTime'],
    "endTime"       => $_POST['endTime'],
    "reservGroup"   => $_POST['uGroup'],
    "reservPurpose" => $_POST['reservPurpose'],
    "reservStatus"  => "1"
  ];

  // Call function confUpdate to update booking if there is no conflict! $conf = conflict.
  $conf = confUpdate($reservation);
  if ($conf['rowCount'] > 0) {
    $msg = "<h4>" . $conf['rowCount'] . "개의 예약 충돌이 발견되었습니다!</h4>";
    // } elseif ($conf['rowCount'] == 1) {
    //   $msg = "<h4>There is " . $conf['rowCount'] . " conflict!</h4>";
    }else {
      $msg = "<h5>예약이 변경되었습니다!</h5>";
      // echo ("<script> window.location = './reserv_pass.php'; </script>") ;
  }
  // echo ("<script> window.location = './reserv_pass.php'; </script>") ;
  
  } else {
    $msg = '<h4 class="msg">'.'시작시간과 종료시간이 같거나, 시작시간이 종료시간보다 더 늦은 시간입니다. 시간 확인바랍니다.'.'</h4>';
  }
}

// Clear form fields
if (isset($_POST['clr'])) {
  // include './reservation.php';
  echo ("<script> window.location = './reserv_pass.php'; </script>") ;
}

if (isset($_POST['book'])) {
  if ($_POST['reservTime'] < $_POST['endTime']) {

    $reservation = array(
      "reservDate"    => $_POST['reservDate'],
      "rmReserv"      => $_POST['rmReserv'],
      "reservTime"    => $_POST['reservTime'],
      "endTime"       => $_POST['endTime'],
      "reservPurpose" => $_POST['reservPurpose'],
      "reservGroup"   => $_POST['uGroup'],
      "reservStatus"  => "1"
    );

    // call function cocfBook to add booking if there is no conflict! $conf = conflict.
    $conf = confBook($reservation);
    if ($conf['rowCount'] >= 1) {
      $msg = "<h4>" . $conf['rowCount'] . "개의 예약 충돌이 발견되었습니다!</h4>";
    // } elseif ($conf['rowCount'] == 1) {
    //   $msg = "<h4>There is " . $conf['rowCount'] . " conflict!</h4>";
    }else {
      $msg = "<h5>예약되었습니다!</h5>";
    }

  } else {
    $msg = '<h4 class="msg">'.'시작시간과 종료시간이 같거나, 시작시간이 종료시간보다 더 늦은 시간입니다. 시간 확인바랍니다.'.'</h4>';
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
        rmlist.rmName,
        TIME_FORMAT(reservations.reservTime, '%l:%i %p') AS st,
        TIME_FORMAT(reservations.endTime, '%l:%i %p') AS et,
        reservations.reservPurpose,
        cdnj_group.grName,
        IF (reservations.reservStatus=False, 'Pending', 'Approved') AS status, 
        reservations.reservCreated
      FROM reservations
      JOIN rmlist
        ON reservations.rmReserv = rmlist.rmId
 LEFT JOIN cdnj_group
        ON reservations.reservGroup = cdnj_group.grId
     WHERE reservations.reservDate >= CURRENT_DATE()
  ORDER BY reservations.reservCreated ASC";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $reservations = $statement->fetchAll();

// Call function grList()
    $grResults = grList();

// Call function rmList()
    $rooms = rmList();

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