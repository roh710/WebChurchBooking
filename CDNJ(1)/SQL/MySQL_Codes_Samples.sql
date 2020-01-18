CREATE VIEW rm_reserved AS
SELECT reservations.reservID, reservations.reservDate, rmlist.rmName, reservations.reservTime, reservations.endTime, reservations.reservPurpose, cdnj_group.grName
FROM reservations
JOIN rmlist
ON reservations.rmReserv = rmlist.rmId
JOIN cdnj_group
ON reservations.reservGroup = cdnj_group.grId
WHERE reservations.reservDate >= CURRENT_DATE()
ORDER BY reservations.reservDate ASC;

CREATE VIEW rm_reserved AS
SELECT reservations.reservID, reservations.reservDate, rmlist.rmName, reservations.reservTime, reservations.endTime, reservations.reservPurpose, cdnj_group.grName,
IF (reservations.reservStatus=0, 'Pending', 'Approved') AS status
FROM reservations
JOIN rmlist
ON reservations.rmReserv = rmlist.rmId
LEFT JOIN cdnj_group
ON reservations.reservGroup = cdnj_group.grId
WHERE reservations.reservDate >= CURRENT_DATE()
ORDER BY reservations.reservDate ASC;

CREATE VIEW userInfo_perm AS
SELECT users.user_firstname, users.user_lastname, users.user_kor_name, users.user_name, users.user_email, users.user_pwd, cdnj_group.user_perm_level, cdnj_group.grId, cdnj_group.grName FROM users
JOIN cdnj_group
ON users.user_group_fk = cdnj_group.grId;

-- This CASE statement is like the SWITCH statement in PHP
  
  -- DAYOFWEEK({date field name || Date}) yeild numeric values for corresponding Day names, i.e. 1=Sunday, 2=Monday, 3=Tuesday, 4=Wednesday, 5=Thursday, 6=Friday, 7=Saturday.
  
  -- DAYNAME({date field name || Date}) yeild actual names of week days, i.e. "Monday, Tuesday, Wednesday, etc",  
  
  -- WEEKDAY({date field name || Date}) yeild numeric values for corresponding Day names, i.e. 0 = Monday, 1 = Tuesday, 2 = Wednesday, 3 = Thursday, 4 = Friday, 5 = Saturday, 6 = Sunday.
  
  -- CURDATE() = Current Date(today)

  -- See 5 examples of the CASE statement
  SELECT 
  CASE 
    WHEN DAYOFWEEK(CURDATE())=1 THEN 'Sun'
    WHEN DAYOFWEEK(CURDATE())=2 THEN 'Mon'
    WHEN DAYOFWEEK(CURDATE())=3 THEN 'Tue'
    WHEN DAYOFWEEK(CURDATE())=4 THEN 'Wed'
    WHEN DAYOFWEEK(CURDATE())=5 THEN 'Thu'
    WHEN DAYOFWEEK(CURDATE())=6 THEN 'Fri'
    ELSE 'Sat'
  END AS wkDay

  SELECT 
  CASE 
    WHEN event_wkday = 1 THEN 'Sun'
    WHEN event_wkday = 2 THEN 'Mon'
    WHEN event_wkday = 3 THEN 'Tue'
    WHEN event_wkday = 4 THEN 'Wed'
    WHEN event_wkday = 5 THEN 'Thu'
    WHEN event_wkday = 6 THEN 'Fri'
    ELSE 'Sat'
  END AS wkDay
  FROM perm_events

  SELECT event_name, event_desc, 
  CASE 
    WHEN event_wkday = 1 THEN 'Sun'
    WHEN event_wkday = 2 THEN 'Mon'
    WHEN event_wkday = 3 THEN 'Tue'
    WHEN event_wkday = 4 THEN 'Wed'
    WHEN event_wkday = 5 THEN 'Thu'
    WHEN event_wkday = 6 THEN 'Fri'
    ELSE 'Sat'
  END AS wkDay, 
  event_st_date, event_end_date, event_st_time, event_end_time, rmlist_fk
  FROM perm_events

  SELECT rmReserv, reservDate,
  CASE 
    WHEN DAYOFWEEK(reservDate) = 1 THEN 'Sun'
    WHEN DAYOFWEEK(reservDate) = 2 THEN 'Mon'
    WHEN DAYOFWEEK(reservDate) = 3 THEN 'Tue'
    WHEN DAYOFWEEK(reservDate) = 4 THEN 'Wed'
    WHEN DAYOFWEEK(reservDate) = 5 THEN 'Thu'
    WHEN DAYOFWEEK(reservDate) = 6 THEN 'Fri'
    ELSE 'Sat'
  END AS wkDay, 
  reservTime, endTime, reservPurpose, reservGroup, reservStatus
  FROM reservations

  SELECT rmReserv, reservDate,
  CASE 
    WHEN DAYOFWEEK(reservDate) = 1 THEN '일요일'
    WHEN DAYOFWEEK(reservDate) = 2 THEN '월요일'
    WHEN DAYOFWEEK(reservDate) = 3 THEN '화요일'
    WHEN DAYOFWEEK(reservDate) = 4 THEN '수요일'
    WHEN DAYOFWEEK(reservDate) = 5 THEN '목요일'
    WHEN DAYOFWEEK(reservDate) = 6 THEN '금요일'
    ELSE '토요일'
  END AS wkDay, 
  reservTime, endTime, reservPurpose, reservGroup, reservStatus
  FROM reservations

-- The best solution so far! This query doesn't insert actual data into the table but returns all rows within the date range, as suggested by https://stackoverflow.com/questions/2157282/generate-days-from-date-range
SELECT a.Date
FROM
  (SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a) + (1000 * d.a)) DAY AS Date
   FROM
      (SELECT 0 AS a
      UNION ALL SELECT 1
      UNION ALL SELECT 2
      UNION ALL SELECT 3
      UNION ALL SELECT 4
      UNION ALL SELECT 5
      UNION ALL SELECT 6
      UNION ALL SELECT 7
      UNION ALL SELECT 8
      UNION ALL SELECT 9) AS a
    CROSS JOIN
      (SELECT 0 AS a
      UNION ALL SELECT 1
      UNION ALL SELECT 2
      UNION ALL SELECT 3
      UNION ALL SELECT 4
      UNION ALL SELECT 5
      UNION ALL SELECT 6
      UNION ALL SELECT 7
      UNION ALL SELECT 8
      UNION ALL SELECT 9) AS b
    CROSS JOIN
      (SELECT 0 AS a
      UNION ALL SELECT 1
      UNION ALL SELECT 2
      UNION ALL SELECT 3
      UNION ALL SELECT 4
      UNION ALL SELECT 5
      UNION ALL SELECT 6
      UNION ALL SELECT 7
      UNION ALL SELECT 8
      UNION ALL SELECT 9) AS c
    CROSS JOIN
      (SELECT 0 AS a 
      UNION ALL SELECT 1
      UNION ALL SELECT 2 
      UNION ALL SELECT 3
      UNION ALL SELECT 4 
      UNION ALL SELECT 5 
      UNION ALL SELECT 6 
      UNION ALL SELECT 7 
      UNION ALL SELECT 8 
      UNION ALL SELECT 9) as d) a
    WHERE a.Date BETWEEN '2019-05-20' AND '2019-05-30'
    ORDER BY a.date

-- UNION join reservations & perm_events tables.  This sql code works!
SELECT reservDate, reservDate AS end_date,
  reservPurpose AS 'Event Name',
CASE 
  WHEN DAYOFWEEK(reservDate) = 1 THEN 'Sun'
  WHEN DAYOFWEEK(reservDate) = 2 THEN 'Mon'
  WHEN DAYOFWEEK(reservDate) = 3 THEN 'Tue'
  WHEN DAYOFWEEK(reservDate) = 4 THEN 'Wed'
  WHEN DAYOFWEEK(reservDate) = 5 THEN 'Thu'
  WHEN DAYOFWEEK(reservDate) = 6 THEN 'Fri'
  WHEN DAYOFWEEK(reservDate) = 7 THEN 'Sat'
  ELSE NULL
END AS wkDay, rmReserv, reservTime, endTime
FROM reservations
UNION
SELECT event_st_date, event_end_date,
  event_name,
CASE 
  WHEN event_wkday = 1 THEN 'Sun'
  WHEN event_wkday = 2 THEN 'Mon'
  WHEN event_wkday = 3 THEN 'Tue'
  WHEN event_wkday = 4 THEN 'Wed'
  WHEN event_wkday = 5 THEN 'Thu'
  WHEN event_wkday = 6 THEN 'Fri'
  WHEN event_wkday = 7 THEN 'Sat'
  ELSE NULL
END AS wkDay, rmlist_fk, event_st_time, event_end_time
FROM perm_events
ORDER BY reservDate
  
  function ConfBook_Backup($x) {
  include 'includes/cdnj.inc.dbh.php';
  $sql = "SELECT reservDate, reservDate AS endDate,
    reservPurpose AS 'Event Name',
    CASE 
      WHEN DAYOFWEEK(reservDate) = 1 THEN 'Sun'
      WHEN DAYOFWEEK(reservDate) = 2 THEN 'Mon'
      WHEN DAYOFWEEK(reservDate) = 3 THEN 'Tue'
      WHEN DAYOFWEEK(reservDate) = 4 THEN 'Wed'
      WHEN DAYOFWEEK(reservDate) = 5 THEN 'Thu'
      WHEN DAYOFWEEK(reservDate) = 6 THEN 'Fri'
      ELSE 'Sat' 
    END AS wkDay, rmReserv, reservTime, endTime
    FROM reservations
    UNION
    SELECT event_st_date, event_end_date,
      event_name,
    CASE 
      WHEN event_wkday = 1 THEN 'Sun'
      WHEN event_wkday = 2 THEN 'Mon'
      WHEN event_wkday = 3 THEN 'Tue'
      WHEN event_wkday = 4 THEN 'Wed'
      WHEN event_wkday = 5 THEN 'Thu'
      WHEN event_wkday = 6 THEN 'Fri'
      ELSE 'Sat'
    END AS wkDay, rmlist_fk, event_st_time, event_end_time
    FROM perm_events
    WHERE reservations.reservDate >= CURRENT_DATE()
    AND rmReserv = :rmReserv
    # This section deals with Perm_events and semi-perm events with set      # dates and/or set week days. 
    # REVIEW: consider weekdays only events such as 7/9/2000 thru 7/13/2000, # mon, wed, fri only - or perm-events on tue, thu forever or until the 
    # details change.
    # It may require changes to wkday field in Perm_event table.. (Changed wkday field to VARCHAR(7) and Made wkday to ELSE NULL to accomplish no value when there's no wkday data.. see above this function for the codes)
    # IF reservDate or endDate does not exist, go with wkdays
    AND reservDate <= :endDate
    AND endDate >= :reservDate
    AND (reservTime < :endTime)
    AND (endTime > :reservTime)
   ORDER BY reservations.reservTime";

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

-- IP count
SELECT users.user_name, cdnj_group.grName, users.user_kor_name, users.user_title, users.cellPhoneNum, users.user_email, user_conn_info.ip_addr, MAX(user_conn_info.date_time_stamp) AS 'Latest Login', COUNT(user_conn_info.ip_addr) AS Count
FROM user_conn_info
RIGHT JOIN users
ON user_conn_info.user_fk = users.user_id
JOIN cdnj_group
ON users.user_group_fk = cdnj_group.grId
GROUP BY users.user_id
ORDER BY Count DESC