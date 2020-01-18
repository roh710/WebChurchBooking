<?php
// Function for INSERT booking record if no conflict exist. 
function ConfBook($x) {
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
  $reservations = $statement->fetchAll();
  $countRows = $statement->rowCount();
  
  if ($countRows == 0) {
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
    "rowCount" => $countRows,
    "reservations" => $reservations
  );
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
  $reservations = $statement->fetchAll();
  $countRows = $statement->rowCount();
   
  if ($countRows == 0) {
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
    "rowCount" => $countRows,
    "reservations" => $reservations
   );
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
  $countRows = $records->rowCount();

  return $countRows;
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

// Add groups function.
function addGr() {
  include 'includes/cdnj.inc.dbh.php';

  $grName = trim($_POST['grName']);
  $grParent = trim($_POST['grParent']);
  $grDesc = trim($_POST['grDesc']);
  $grPerm = "User";

  // Prepare $stmt.
  $statement = $conn->prepare("INSERT INTO cdnj_group (grName, grParent, grDesc, user_perm_level) VALUES (:grName, :grParent, :grDesc, :user_perm_level)");

  // Bind parameters.
  $statement->bindParam(':grName',$grName);
  $statement->bindParam(':grParent',$grParent);
  $statement->bindParam(':grDesc',$grDesc);
  $statement->bindParam(':user_perm_level',$grPerm);
  $statement->execute();
}

// Update group function.
function updateGr() {
  include 'includes/cdnj.inc.dbh.php';

  $grName = trim($_POST['grName']);
  $grParent = trim($_POST['grParent']);
  $grDesc = trim($_POST['grDesc']);
  $grPerm = "User";
  $grId = $_POST['grId'];
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
}

// Function to populate room-list table.
function displayRm() {
  include 'includes/cdnj.inc.dbh.php';

  $sql = "SELECT * FROM rmlist ORDER BY rmName";

  $statement = $conn->prepare($sql);
  $statement->execute();
  $rmList = $statement->fetchAll();

  return $rmList;
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
  } else {
    echo 'Something went wrong';
}

  $sql = "INSERT INTO user_conn_info (user_fk, ip_addr, isp, country, city, region, zip) VALUES (:user_fk, :ip_addr, :isp, :country, :city, :region, :zip)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_fk', $_SESSION['user_id']);
  $stmt->bindParam(':ip_addr', $ip);
  $stmt->bindParam(':isp', $isp);
  $stmt->bindParam(':country', $country);
  $stmt->bindParam(':city', $city);
  $stmt->bindParam(':region', $region);
  $stmt->bindParam(':zip', $zip);
  $stmt->execute();
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
  $countRows = $statement->rowCount();

  return array(
    "ip_info"   => $ip_info,
    "rowCount"  => $countRows
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