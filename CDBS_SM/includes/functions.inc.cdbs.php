<?php

// REVIEW: The basic difference between "fetch()" and "fetchAll()" is the "fetch()" fetches only ONE ROW of record from the query versus, the "fetchAll()" fetch ALL ROWS of records from the query.
// Inside of the (), PDO::FETCH_ASSOC or PDO::FETCH_OBJ may be used.
// REVIEW: BELOW CODE FETCH ALL RECORDS FROM QUERY. CAN ALSO USE "$record = $query->fetchAll(PDO::FETCH_OBJ);" FOR "stdClass Object"

// Function for combining individule bookings with perm or semi-perm events
function combBooking() {
  include 'includes/cdnj.inc.dbh.php';

  if (empty(event_st_date)) {
    $combBooking = array(
      "reservDate"      => $_POST['reservDate'],
      "rmlist_fkIndex"  => $_POST['rmlist_fkIndex'],
      "event_wkday"     => $_POST['event_wkday'],
      "event_st_date"   => date('Y-m-d'),
      "event_end_date"  => date('Y-m-d', strtotime('+1 month')),
      "event_st_time"   => $_POST['reservTime'],
      "event_end_time"  => $_POST['endTime'],
      "event_name"      => $_POST['event_name'],
      "reservGroup"     => $_POST['uGroup'],
      "reservStatus"    => "1"
    );
  }
  
  $sql = "SELECT * FROM perm_events WHERE :event_st_date >= NOW() AND :event_end_date <= NOW()";

  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':event_st_date',$x['event_st_time']);
  $stmt->bindParam(':event_end_date',$x['event_end_time']);
  $stmt->execute();
  $reservation = $stmt->fetchAll();
  return $reservation;
}

// Returns group list
function grList() {
  include 'includes/cdnj.inc.dbh.php';

  $sql = "SELECT grId, grName, user_perm_level FROM cdnj_group
  WHERE user_perm_level='User'
  ORDER BY grParent, grName ASC";

  $statement = $conn->prepare($sql);
  $statement->execute();
  $grList = $statement->fetchAll();

  return $grList;
}

// Add new user
function addUser() {

  $newUser = [
    'uFirstName' => trim($_POST['uFirstName']),
    'uLastName' => trim($_POST['uLastName']),
    'uKorName' => trim($_POST['uKorName']),
    'uTitle' => trim($_POST['uTitle']),
    'uName' => trim($_POST['uName']),
    'eMail' => trim($_POST['eMail']),
    'cellPhone' => trim($_POST['cellPhone']),
    'uGroup' => $_POST['uGroup'],
    'uPwd' => password_hash($_POST['uPwd'], PASSWORD_BCRYPT)
  ];
  
  // Check if new user already exists.
  $records = $conn->prepare('SELECT users.user_firstname, users.user_lastname, users.user_kor_name, users.user_name, users.user_email, users.user_pwd, users.active_status, cdnj_group.user_perm_level, cdnj_group.grId, cdnj_group.grName FROM users
  JOIN cdnj_group
  ON users.user_group_fk = cdnj_group.grId 
  WHERE (user_name = :user_name OR user_email = :user_email OR grId = :grId) AND users.active_status = "1"');
  $records->bindParam(':user_name', $newUser['uFirstName']);
  $records->bindParam(':user_email', $newUser['uLastName']);
  $records->bindParam(':grId', $newUser['uGroup']);
  $records->execute();
  $row = $records->fetch(PDO::FETCH_ASSOC);

  if ($row > 0) {
  // header("refresh:3; url=../register.php");
  echo "The username: " . $_POST['uName'] . " or e-Mail: " . $_POST['eMail'] . " or Group: " . $row['grName'] . ", has been alredy Registered!";
  exit;
  } elseif ($_POST['uPwd'] != $_POST['confirm_uPwd']) {
  header("refresh:3; url=../register.php");
  echo "passwords <strong>DO NOT</strong> match!";
  exit;
  }
}

// Insert perm events info into "perm_events" table
function insPermEvent() {
  include 'includes/cdnj.inc.dbh.php';
  date_default_timezone_set('America/New_York');

  if (isset($_POST['addPermEvent'])) {
    
    // Initialize $wkDayBit
    $wkDayBit = 0;

    // Assign array 'wkday' to $tempWk
    $tempWk = $_POST['wkday'];

    // Loop through the newly assigned $tempWk using foreach loop
    foreach($tempWk as $row => $value) {
      $wkDayBit = $wkDayBit + $value;
    }

    // Assign input data to an array below
    $permEvtTblIns = [
      'eventName'    => trim($_POST['permEvTtl']),
      'stDate'       => trim($_POST['stDate']),
      'endDate'      => trim($_POST['endDate']),
      'wkDayBit'     => $wkDayBit, 
      'stTime'       => trim($_POST['stTime']),
      'endTime'      => trim($_POST['endTime']),
      'rmFk'         => trim($_POST['rmReserv']),
      'grFk'         => trim($_POST['userGr']),
      'eventUpdated' => date('Y-m-d H:m:i')
    ];

    // Check date and time of events to see if any of them overlaps
    $sql = "SELECT 
              perm_events.event_id,
              perm_events.eventName,
              perm_events.eventStDate,
              perm_events.wkDayBit,
              rmlist.rmId,
              rmlist.rmName,
              perm_events.eventStTime,
              perm_events.eventEndTime,
              perm_events.eventDesc,
              cdnj_group.grName,
              perm_events.eventUpdated
              FROM perm_events
              JOIN rmlist
                ON perm_events.rmIdFk = rmlist.rmId
         LEFT JOIN cdnj_group
                ON perm_events.grIdFk = cdnj_group.grId
             WHERE rmIdFk = :rmIdFk
               AND wkDayBit >= :wkDayBit
               AND eventStDate = :eventStDate
               AND (eventStTime < :eventEndTime)
               AND (eventEndTime > :eventStTime)
          ORDER BY perm_events.eventStTime";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':rmIdFk',$permEvtTblIns['rmFk']);
    $statement->bindParam(':wkDayBit',$wkDayBit);
    $statement->bindParam(':eventStDate',$permEvtTblIns['stDate']);
    $statement->bindParam(':eventStTime',$permEvtTblIns['stTime']);
    $statement->bindParam(':eventEndTime',$permEvtTblIns['endTime']);
    $statement->execute();
    $conflicts = $statement->fetchAll(PDO::FETCH_ASSOC);
    $confRows = $statement->rowCount();

    // print_r variable $permEvtTblIns
    echo "<pre>";
    print_r($permEvtTblIns);
    echo "</pre>";

    // Set array $day
    $days = array(1, 2, 4, 8, 16, 32, 64);

    //Initialise an array for storing the converted bit representation
    $newdays = array();

    // Convert the bitwise integer to an array
    for($i=0; $i<7; $i++) {
      $daybit = pow(2,$i);
      foreach ($conflicts as $key => $value) {
        if ($value['wkDayBit'] & $daybit) { // Bits that are set in both $a and $b are set.
          $newdays[]=$days[$i];
        }
        echo "<pre>";
        // print_r($value['wkDayBit']);
        // print_r($newdays);
        echo "</pre>";
      }
    }

    if ($confRows == 0 /*&& array_search($tempWk, $newdays)*/) {
      // SQL statement for inserting data to the perm_events tbl.
      $sql = "INSERT INTO perm_events (eventName, eventStDate, eventEndDate, wkDayBit, eventStTime, eventEndTime, rmIdFk, grIdFk, eventUpdated)
      VALUES (:eventName, :eventStDate, :eventEndDate, :wkDayBit, :eventStTime, :eventEndTime, :rmIdFk, :grIdFk, :eventUpdated)";

      // prepare SQL Statement & Bind Parameter
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':eventName', $permEvtTblIns['eventName']);
      $stmt->bindParam(':eventStDate', $permEvtTblIns['stDate']);
      $stmt->bindParam(':eventEndDate', $permEvtTblIns['endDate']);
      $stmt->bindParam(':wkDayBit', $wkDayBit);
      $stmt->bindParam(':eventStTime', $permEvtTblIns['stTime']);
      $stmt->bindParam(':eventEndTime', $permEvtTblIns['endTime']);
      $stmt->bindParam(':rmIdFk', $permEvtTblIns['rmFk']);
      $stmt->bindParam(':grIdFk', $permEvtTblIns['grFk']);
      $stmt->bindParam(':eventUpdated', $permEvtTblIns['eventUpdated']);
      
      $stmt->execute();
    } else {
      echo "<h4>$confRows 개의 충돌이 발생했습니다. 아래 충돌 항목을 참고하십시오!</h4>";
      foreach($conflicts as $key => $value) {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
      }
      echo "<h4>충돌항목 종료...</h4>";
    }
  }
}

// Query "perm_events" table
  function qryPermEvent() {
  include 'includes/cdnj.inc.dbh.php';

  $sql = "SELECT * 
  -- eventName, wkDayBit, IF (eventStDate IS NULL, CURDATE(), eventStDate) AS stDate, eventEndDate AS 'End Date', eventStTime, eventEndTime, rmIdFk, grIdFk
  FROM perm_events 
  WHERE eventStDate >= CURDATE()
  OR eventStDate IS NULL
  OR eventEndDate <= CURDATE()
  OR eventEndDate IS NULL";

  $statement = $conn->query($sql);
  $statement->execute();
  $permEvt = $statement->fetchAll(PDO::FETCH_ASSOC);

  return $permEvt;
}

// Assign individual events to variables
function asgnEvts() {
  include 'includes/cdnj.inc.dbh.php';

  // Query all data from tbl perm_events and assign the values to the variable $permEvts
  $permEvts = qryPermEvent();

  foreach ($permEvts as $key => $value) {
    $weekday_bit = 0;

    if ($value['eventStDate'] == "0000-00-00") {
      $stDate = date('Y-m-d');
      $endDate = date('Y-m-d', strtotime('+4 weeks'));

    } else {
      $stDate = $value['eventStDate'];
      $endDate = $value['eventEndDate'];

    }
    $event_id = $value['event_id'];
    $permEvTtl = $value['eventName'];
    $rmIdFk = $value['rmIdFk'];
    $wkDayBit = $value['wkDayBit'];
    $grIdFk = $value['grIdFk'];
    $stTime = $value['eventStTime'];
    $endTime = $value['eventEndTime'];
    $rsvStat = $value['rsvStat'];
    $eventUpdated = $value['eventUpdated'];

    $days = array('Sun','Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

    //Initialise an array for storing the converted bit representation
    $newdays = array();

    // Convert the bitwise integer to an array
    for($i=0; $i<7; $i++) {
      $daybit = pow(2,$i);
      if ($wkDayBit & $daybit) { // Bits that are set in both $a and $b are set.
        $newdays[]=$days[$i];
      }
      // echo "<pre>";
      // print_r($newdays);
      // echo "</pre>";
    }

    // Call funtion dateRange($stDate, $endDate) and assign the return values to $result.
    $result = dateRange($stDate, $endDate);

    // Checks if a value exists in the array
    // syntax: in_array( mixed $needle , array $haystack [, bool $strict ]): bool
    foreach ($result as $v) {
      if (in_array(date('D', strtotime($v)), $newdays)) {
        // Get room name
        $rmN = "SELECT rmName FROM rmlist WHERE rmId = $rmIdFk";
        $statement = $conn->query($rmN);
        $statement->execute();
        $rmName = $statement->fetchAll(PDO::FETCH_ASSOC);

        $grN = "SELECT grName FROM cdnj_group WHERE grId = $grIdFk";
        $stmt = $conn->query($grN);
        $stmt->execute();
        $grName = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $permEvt1 = [
          "eventId"   => $event_id,
          "eventDate" => $v,
          "wkDay"     => date('D', strtotime($v)),
          "eventName" => $permEvTtl,
          "stTime"    => $stTime,
          "endTime"   => $endTime,
          //"rmName"    => $rmName,
          // "grIdFk"    => $grIdFk,
          // "eventStat" => $rsvStat
        ];

        // Loop thru $rmName
        foreach ($rmName as $key => $value) {
          $permEvt2 = ["rmName" => $value['rmName']];
        }

        // Loop thru $grName
        foreach ($grName as $key => $value) {
          $permEvt3 = [
            "grName"       => $value['grName'],
            "eventStat"    => $rsvStat,
            "eventUpdated" => $eventUpdated
          ];
        }

        // Merge arrays
        $permEvt = array_merge($permEvt1, $permEvt2, $permEvt3);

        // Insert $permEvt into the array $permEvtArray[]<== must have the bracket
        $permEvtArray[] = $permEvt;

        // echo "<pre>";
        // print_r($permEvt);
        // echo "</pre>";
      }
    }

    // below echoes out the title of events
    # echo "Event Title: " . $permEvTtl . "<br>";

    // Below echoes out the sum of array $tempWk.
    # echo "Total wkDayBit: " . $wkDayBit . "<br>";

    // echo out the checked weekdays
    # echo 'Checked Weekday(s): ' . implode($newdays ,", ") . "," . "<br>";
    // echo "</pre>";

    # echo  "Date Range: " . $stDate." to ".$endDate."<br><br>";
  }
  return $permEvtArray;
}

// Function for INSERT booking record if no conflict exist. 
function confBook($x) {
  include 'includes/cdnj.inc.dbh.php';
  
  $sql = "SELECT 
    reservations.reservID,
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
        If (reservations.reservStatus = False, 'Pending', 'Approved')
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
  $statement->bindParam(':rmReserv',$x['rmReserv']);
  $statement->bindParam(':reservDate',$x['reservDate']);
  $statement->bindParam(':reservTime',$x['reservTime']);
  $statement->bindParam(':endTime',$x['endTime']);
  $statement->execute();
  $conflicts = $statement->fetchAll();
  $confRows = $statement->rowCount();
  
  if ($confRows == 0) {
    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "reservations",
      implode(", ", array_keys($x)),
      ":" . implode(", :", array_keys($x))
      );
  
    $statement = $conn->prepare($sql);
    $statement->execute($x);
  }

  return array(
    "rowCount" => $confRows,
    "reservations" => $conflicts
  );
}

// Function for INSERT booking record if no conflict exist. 
function confBook1($x) {
  include 'includes/cdnj.inc.dbh.php';
  
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
        $sql = "SELECT 
          reservations.reservID,
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
              If (reservations.reservStatus = False, 'Pending', 'Approved')
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
        $statement->bindParam(':rmReserv',$x['rmReserv']);
        $statement->bindParam(':reservDate',$x['reservDate']);
        $statement->bindParam(':reservTime',$x['reservTime']);
        $statement->bindParam(':endTime',$x['endTime']);
        $statement->execute();
        $conflicts = $statement->fetchAll();
        $confRows = $statement->rowCount();
  
    if ($confRows == 0) {
      $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "reservations",
        implode(", ", array_keys($x)),
        ":" . implode(", :", array_keys($x))
        );
    
      $statement = $conn->prepare($sql);
      $statement->execute($x);
    }

    return array(
      "rowCount" => $confRows,
      "reservations" => $conflicts
  );

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
}

// Function to UPDATE booking record if no conflict exist.
function confUpdate($x) {
  include 'includes/cdnj.inc.dbh.php';
  $sql = "SELECT 
    reservations.reservID,
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
       If (reservations.reservStatus = False, 'Pending', 'Approved')
       AS status
     FROM reservations
     JOIN rmlist
       ON reservations.rmReserv = rmlist.rmId
LEFT JOIN cdnj_group
       ON reservations.reservGroup = cdnj_group.grId
    WHERE reservations.reservDate >= CURRENT_DATE()
      AND reservID <> :reservID
      AND rmReserv = :rmReserv
      AND reservDate = :reservDate
      AND (reservTime < :endTime)
      AND (endTime > :reservTime)
 ORDER BY reservations.reservTime";

  $statement = $conn->prepare($sql);
  $statement->bindParam(':reservID',$x['reservID']);
  $statement->bindParam(':reservDate',$x['reservDate']);
  $statement->bindParam(':rmReserv',$x['rmReserv']);
  $statement->bindParam(':reservTime',$x['reservTime']);
  $statement->bindParam(':endTime',$x['endTime']);

  $statement->execute();
  $conflicts = $statement->fetchAll();
  $confRows = $statement->rowCount();
   
  if ($confRows == 0) {
  // UPDATE SQL statement.
  $sql = "UPDATE reservations SET
    rmReserv = :rmReserv,
    reservDate = :reservDate,
    reservTime = :reservTime,
    endTime = :endTime,
    reservGroup =:reservGroup,
    reservPurpose = :reservPurpose,
    reservStatus = :reservStatus
    WHERE reservID = :reservID";

    $statement = $conn->prepare($sql);
    $statement->bindParam(':reservID',$x['reservID']);
    $statement->bindParam(':rmReserv',$x['rmReserv']);
    $statement->bindParam(':reservDate',$x['reservDate']); 
    $statement->bindParam(':reservTime',$x['reservTime']);
    $statement->bindParam(':endTime',$x['endTime']);
    $statement->bindParam(':reservGroup',$x['reservGroup']);
    $statement->bindParam(':reservPurpose',$x['reservPurpose']);
    $statement->bindParam(':reservStatus',$x['reservStatus']);

    $statement->execute($x);
  }

   return array(
    "rowCount" => $confRows,
    "reservations" => $conflicts
   );
}

// Function for Permanent Events
function permEvents() {
  include 'includes/cdnj.inc.dbh.php';

  $sql = "SELECT pe.event_id, pe.event_name,  
  IF (pe.event_st_date IS NULL, CURDATE() + INTERVAL 6 DAY - weekday(CURDATE()), pe.event_st_date) AS 'Start Date',
  IF (pe.event_end_date IS NULL, DATE_ADD(CURDATE() + INTERVAL 6 DAY - weekday(CURDATE()), INTERVAL 4 WEEK), pe.event_end_date) AS 'End Date', pe.event_st_time, pe.event_end_time, pe.rmlist_fk, pw.wkday AS wkd_fk,
    CASE pw.wkday
      WHEN '1' THEN 'sun'
      WHEN '2' THEN 'mon'
      WHEN '3' THEN 'tue'
      WHEN '4' THEN 'wed'
      WHEN '5' THEN 'thu'
      WHEN '6' THEN 'fri'
      ELSE 'sat' 
    END AS wkday
    FROM perm_events pe
    JOIN perm_event_wkday pw
    ON pe.event_id = pw.perm_event_fk
    -- WHERE pe.event_st_date >= CURDATE() OR pe.event_end_date >= CURDATE()
    ORDER BY pe.event_st_date, wkd_fk";
  $query = $conn->query($sql);

  // REVIEW: CAN ALSO USE "$record = $query->fetchAll(PDO::FETCH_OBJ);" FOR "stdClass Object"
  $record = $query->fetchAll(PDO::FETCH_ASSOC);
  return $record;

  // while ($row = $query->fetch(PDO::FETCH_OBJ)) {
  //   echo $row->event_id . "<br>";
  //   echo $row->event_name . "<br>";
  // }

  // for ($i=0; $row = $query->fetch(PDO::FETCH_OBJ); $i++) {
  //   echo $row->event_id . "<br>";
  //   echo $row->event_name . "<br>";
  //   }
}

// Function for checking if userName, email or group is already registered.
function registered($x) {
  include 'includes/cdnj.inc.dbh.php';
  
  $records = $conn->prepare('SELECT users.user_id, users.user_firstname,           
  users.user_lastname, users.user_kor_name, users.user_name, users.user_email, users.user_pwd, cdnj_group.user_perm_level, cdnj_group.grId, cdnj_group.grName 
  FROM users
  JOIN cdnj_group
  ON users.user_group_fk = cdnj_group.grId 
  WHERE user_id <> :user_id AND :grId <> 1 AND (user_name = :user_name OR user_email = :user_email OR grId = :grId)');
  $records->bindParam(':user_id', $x['user_id']);
  $records->bindParam(':user_name', $x['user_name']);
  $records->bindParam(':user_email', $x['user_email']);
  $records->bindParam(':grId', $x['user_group_fk']);
  $records->execute();
  $row = $records->fetch(PDO::FETCH_ASSOC);
  $confRows = $records->rowCount();

  return $confRows;
}

// Update User Profile, if no conflicts in Username, Email or Group.
function updateUserProf($x) {
  include 'includes/cdnj.inc.dbh.php';
  $sql = "UPDATE users SET
    user_firstname = :user_firstname,
    user_lastname = :user_lastname,
    user_email = :user_email,
    cellPhoneNum = :cellPhoneNum,
    user_group_fk = :user_group_fk,
    user_kor_name = :user_kor_name,
    user_title = :user_title,
    user_name = :user_name,
    user_pwd = :user_pwd
    WHERE user_id = :user_id";

  $prof_update = $conn->prepare($sql);
  $prof_update->bindParam(':user_firstname',$x['user_firstname']);
  $prof_update->bindParam(':user_lastname',$x['user_lastname']);
  $prof_update->bindParam(':user_email',$x['user_email']); 
  $prof_update->bindParam(':cellPhoneNum',$x['cellPhoneNum']);
  $prof_update->bindParam(':user_group_fk',$x['user_group_fk']);
  $prof_update->bindParam(':user_kor_name',$x['user_kor_name']);
  $prof_update->bindParam(':user_title',$x['user_title']);
  $prof_update->bindParam(':user_name',$x['user_name']);
  $prof_update->bindParam(':user_pwd',$x['user_pwd']);
  $prof_update->bindParam(':user_id',$x['user_id']);
  $prof_update->execute($x);

  $msg = "User profile updated sucessfully!";
  return $msg;
}

// Update User Profile with user_name, if no conflicts in Username, Email or Group.
function updateUserProfByUserName($x) {
  include 'includes/cdnj.inc.dbh.php';
  $sql = "UPDATE users SET
    user_pwd = :user_pwd
    WHERE user_name = :user_name";

  $prof_update = $conn->prepare($sql);
  $prof_update->bindParam(':user_name',$x['user_name']);
  $prof_update->bindParam(':user_pwd',$x['user_pwd']);
  
  $prof_update->execute($x);
}

// Function to populate group-list table.
function displayGr() {
  include 'includes/cdnj.inc.dbh.php';

  $sql = "SELECT * FROM cdnj_group WHERE user_perm_level <> 'Admin' ORDER BY grParent, grName ASC";
  $statement = $conn->prepare($sql);
  $statement->execute();
  $grList = $statement->fetchAll();

  return $grList;
}

// Add room function
function addRm() {
  include 'includes/cdnj.inc.dbh.php';

  if(isset($_POST['addRm'])) {
    $addRmInfo = [
      'rmN' => trim($_POST['rmName']),
      'rmL' => trim($_POST['rmLocation']),
      'rmD' => trim($_POST['rmDesc']),
      'rmM' => $_POST['rmMaxPersons'],
      'rmSAT' => $_POST['rmStartAvailTime'],
      'rmEAT' => $_POST['rmEndAvailTime'],
      'rmP' => $_POST['rmPiano']
    ];
    
    $st = $conn->prepare("INSERT INTO rmlist (rmName, rmLocation, rmDesc, rmMaxPersons, rmStartAvailTime, rmEndAvailTime, rmPiano) VALUES (:rmName, :rmLocation, :rmDesc, :rmMaxPersons, :rmStartAvailTime, :rmEndAvailTime, :rmPiano)");

    $st->bindParam(':rmName',$addRmInfo['rmN']);
    $st->bindParam(':rmLocation',$addRmInfo['rmL']);
    $st->bindParam(':rmDesc',$addRmInfo['rmD']);
    $st->bindParam(':rmMaxPersons',$addRmInfo['rmM']);
    $st->bindParam(':rmStartAvailTime',$addRmInfo['rmSAT']);
    $st->bindParam(':rmEndAvailTime',$addRmInfo['rmEAT']);
    $st->bindParam(':rmPiano',$addRmInfo['rmP']);

    $st->execute();
    echo ("<script> window.location = './add_rm.php'; </script>") ;
  }
}

// Update Room function
function updateRm() {
  include 'includes/cdnj.inc.dbh.php';

  if (isset($_POST['edRm'])) {
    $updateRmInfo = [
      'rmId' => $_POST['rmId'],
      'rmN' => trim($_POST['rmName']),
      'rmL' => trim($_POST['rmLocation']),
      'rmD' => trim($_POST['rmDesc']),
      'rmM' => $_POST['rmMaxPersons'],
      'rmSAT' => $_POST['rmStartAvailTime'],
      'rmEAT' => $_POST['rmEndAvailTime'],
      'rmP' => $_POST['rmPiano']
    ];

    $_SESSION['msg'] = "The record, " . $updateRmInfo['rmN'] . " has been updated";

    //Our UPDATE SQL statement.
    $sql = "UPDATE rmlist SET rmName = :rmName, rmLocation = :rmLocation, rmDesc = :rmDesc, rmMaxPersons = :rmMaxPersons, rmStartAvailTime = :rmStartAvailTime, rmEndAvailTime = :rmEndAvailTime, rmPiano = :rmPiano  WHERE rmId = :rmId";

    // Prepare our UPDATE SQL statement.
    $st = $conn->prepare($sql);

    // Bind values to the parameters.
    $st->bindParam(':rmName',$updateRmInfo['rmN']);
    $st->bindParam(':rmLocation',$updateRmInfo['rmL']);
    $st->bindParam(':rmDesc',$updateRmInfo['rmD']);
    $st->bindParam(':rmMaxPersons',$updateRmInfo['rmM']);
    $st->bindParam(':rmStartAvailTime',$updateRmInfo['rmSAT']);
    $st->bindParam(':rmEndAvailTime',$updateRmInfo['rmEAT']);
    $st->bindParam(':rmPiano',$updateRmInfo['rmP']);
    $st->bindParam(':rmId',$updateRmInfo['rmId']);

    //Execute UPDATE statement.
    $st->execute();
    echo ("<script> window.location = './add_rm.php'; </script>") ;
  }
}

// Get update room ID
function getRmId($x) {
  include 'includes/cdnj.inc.dbh.php';

  $query = $conn->query("SELECT * FROM rmlist WHERE rmId = $x");
  $record = $query->fetch(PDO::FETCH_ASSOC);

  $rmInfo = [
    'rmN'         => $record['rmName'],
    'rmL'         => $record['rmLocation'],
    'rmD'         => $record['rmDesc'],
    'rmM'         => $record['rmMaxPersons'],
    'rmSAT'       => $record['rmStartAvailTime'],
    'rmEAT'       => $record['rmEndAvailTime'],
    'rmP'         => $record['rmPiano'],
    'rmId'        => $record['rmId'],
    'edit_state'  => true
  ];
  return $rmInfo;
}

// Display rmList 
// Review: Two functions below are virtually the same. Consider using one or the other after where the functions are called.
function displayRm() {
  include 'includes/cdnj.inc.dbh.php';

  $query = "SELECT * FROM rmlist ORDER BY rmName ASC";
  $results = $conn->query($query);
  return $results;
}

// Function to populate room-list table.
function rmList() {
  include 'includes/cdnj.inc.dbh.php';

  $sql = "SELECT * FROM rmlist ORDER BY rmName";

  $statement = $conn->prepare($sql);
  $statement->execute();
  $rmList = $statement->fetchAll();

  return $rmList;
}

// Add groups function.
function addGr() {
  include 'includes/cdnj.inc.dbh.php';

  if (isset($_POST['addGr'])) {
    $group = [
      'grName'    => trim($_POST['grName']),
      'grParent'  => trim($_POST['grParent']),
      'grDesc'    => trim($_POST['grDesc']),
      'grPerm'    => "User"
    ];
  
    // Prepare $stmt.
    $sql = "INSERT INTO cdnj_group (grName, grParent, grDesc, user_perm_level) VALUES (:grName, :grParent, :grDesc, :user_perm_level)";

    // Prepare & bind parameters.
    $statement = $conn->prepare($sql);
    $statement->bindParam(':grName', $group['grName']);
    $statement->bindParam(':grParent', $group['grParent']);
    $statement->bindParam(':grDesc', $group['grDesc']);
    $statement->bindParam(':user_perm_level', $group['grPerm']);
    $statement->execute();

    $_SESSION['msg'] = $group['grName'] . " has been added.";
    echo ("<script> window.location = './group.php'; </script>") ;
  }
}

// Update group function.
function updateGr() {
  include 'includes/cdnj.inc.dbh.php';

  if (isset($_POST['edGr'])) {
    $grId = $_POST['grId'];
    $grName = trim($_POST['grName']);
    $grParent = trim($_POST['grParent']);
    $grDesc = trim($_POST['grDesc']);
    $grPerm = 'User';
    
    $_SESSION['msg'] = "The record, " . $grName . " has been updated";

    $sql = "UPDATE cdnj_group SET grName = :grName, grParent = :grParent, grDesc = :grDesc, user_perm_level = :grPerm WHERE grId = :grId";

    // Prepare our UPDATE SQL statement.
    $statement = $conn->prepare($sql);

    // Bind values to the parameters.
    $statement->bindValue(':grName', $grName);
    $statement->bindValue(':grParent', $grParent);
    $statement->bindValue(':grDesc', $grDesc);
    $statement->bindValue(':grPerm', $grPerm);
    $statement->bindValue(':grId', $grId);

    // Execute UPDATE statement.
    $statement->execute();
    $edit_state = true;
    echo ("<script> window.location = './group.php'; </script>") ;
  }
}

// Get group ID
function getGrId($x) {
  include 'includes/cdnj.inc.dbh.php';

  if (isset($_GET['edit'])) { // Get id from url
    $query = $conn->query("SELECT * FROM cdnj_group WHERE grId = $x");
    $record = $query->fetch(PDO::FETCH_ASSOC);
    $grInfo = [
      'grId' => $_GET['edit'],
      'grName' => $record['grName'],
      'grParent' => $record['grParent'],
      'grDesc' => $record['grDesc'],
      'grPerm' => $record['user_perm_level'],
      'edit_state' => TRUE
    ];
    return $grInfo;
  }
}

// Insert record to user_conn_info
function userConnInfo() {
  include 'cdnj.inc.dbh.php';

  if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  
  $query=@unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
  if ($query && $query['status'] == 'success') {
    $region = $query['region'];
    $isp = $query['isp'];
    $country = $query['country'];
    $city = $query['city'];
    $zip = $query['zip'];
    date_default_timezone_set('America/New_York');
    $date_time_stamp = date('Y-m-d G:i:s');
  } else {
    echo 'IP API Error';
  }

  $sql = "INSERT INTO user_conn_info (user_fk, ip_addr, isp, country, city, region, zip, date_time_stamp) VALUES (:user_fk, :ip_addr, :isp, :country, :city, :region, :zip, :date_time_stamp)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_fk', $_SESSION['user_id']);
  $stmt->bindParam(':ip_addr', $ip);
  $stmt->bindParam(':isp', $isp);
  $stmt->bindParam(':country', $country);
  $stmt->bindParam(':city', $city);
  $stmt->bindParam(':region', $region);
  $stmt->bindParam(':zip', $zip);
  $stmt->bindParam(':date_time_stamp', $date_time_stamp);
  $stmt->execute();
}

// permEvent. And credit to HADI for what follows
function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
  $dates = array();
  $current = strtotime( $first );
  $last = strtotime( $last );

  while( $current <= $last ) {
    $dates[] = date( $format, $current );
    $current = strtotime( $step, $current );
  }

  return $dates;
}

// User list under "Admin > User List".
function userList() {
  include 'includes/cdnj.inc.dbh.php';
 
  $sql = "SELECT users.user_name, cdnj_group.grName, users.user_kor_name, users.user_title, users.cellPhoneNum, users.user_email, user_conn_info.ip_addr, MAX(user_conn_info.date_time_stamp) AS 'Latest Login', COUNT(user_conn_info.ip_addr) AS Count
  FROM users
  
  JOIN cdnj_group
  ON users.user_group_fk = cdnj_group.grId
  
  LEFT JOIN user_conn_info
  ON users.user_id = user_conn_info.user_fk
  
  WHERE users.active_status = TRUE AND users.user_name <> 'roh710'
  GROUP BY users.user_name
  ORDER BY cdnj_group.grName, users.user_name";

  $statement = $conn->prepare($sql);
  $statement->execute();
  $user_list = $statement->fetchAll();

  return $user_list;
}

// User list and login counter under "Admin > User Conn Det".
function userConnDet() {
  include 'includes/cdnj.inc.dbh.php';
 
  $sql = "SELECT users.user_name, cdnj_group.grName, users.user_kor_name, users.user_title, users.cellPhoneNum, users.user_email, user_conn_info.ip_addr, MAX(user_conn_info.date_time_stamp) AS 'Latest Login', COUNT(user_conn_info.ip_addr) AS Count
  FROM user_conn_info
  LEFT JOIN users
  ON users.user_id = user_conn_info.user_fk
  JOIN cdnj_group
  ON users.user_group_fk = cdnj_group.grId
  WHERE date_time_stamp BETWEEN CURTIME() - INTERVAL 30 DAY AND CURTIME()
  GROUP BY users.user_name
  ORDER BY Count DESC, grName ASC";

  $statement = $conn->prepare($sql);
  $statement->execute();
  $user_list = $statement->fetchAll();

  return $user_list;
}

// IP Details
function ip_det($x) {
  include 'includes/cdnj.inc.dbh.php';

  $sql = "SELECT users.user_name, cdnj_group.grName, users.user_kor_name, users.user_title, users.cellPhoneNum, users.user_email, user_conn_info.ip_addr, user_conn_info.isp, user_conn_info.country, user_conn_info.city, user_conn_info.region, user_conn_info.zip, user_conn_info.date_time_stamp
  FROM user_conn_info
  RIGHT JOIN users
  ON user_conn_info.user_fk = users.user_id
  JOIN cdnj_group
  ON users.user_group_fk = cdnj_group.grId
  WHERE user_name = :user_name
  -- AND date_time_stamp BETWEEN CURTIME() - INTERVAL 30 DAY AND CURTIME()
  ORDER BY date_time_stamp DESC
  LIMIT 10";
  $statement = $conn->prepare($sql);
  $statement->bindParam(':user_name', $x);
  $statement->execute();

  $ip_info = $statement->fetchAll();
  $confRows = $statement->rowCount();

  return array(
    "ip_info"   => $ip_info,
    "rowCount"  => $confRows
  );
}

function del_id($x) {
  include 'includes/cdnj.inc.dbh.php';

  $y = "0";

  $sql = "UPDATE users SET
  active_status = :active_status
  WHERE user_name = :user_name";
  
  $active_status = $conn->prepare($sql);
  $active_status->bindParam(':active_status', $y);
  $active_status->bindParam(':user_name', $x);
  $active_status->execute();
}

// Edit Group
function editGroup() {
}