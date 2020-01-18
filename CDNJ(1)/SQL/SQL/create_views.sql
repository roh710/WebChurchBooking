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
If (reservations.reservStatus=0, 'Pending', 'Approved') AS status
  FROM reservations
  JOIN rmlist
  ON reservations.rmReserv = rmlist.rmId
  LEFT JOIN cdnj_group
  ON reservations.reservGroup = cdnj_group.grId
  WHERE reservations.reservDate >= CURRENT_DATE()
  ORDER BY reservations.reservDate ASC;

CREATE VIEW userInfo AS
SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_email, users.user_kor_name, users.user_title, users.user_name, users.user_pwd, cdnj_group.user_perm_level, cdnj_group.grId, cdnj_group.grName FROM users
JOIN cdnj_group
ON users.user_group_fk = cdnj_group.grId;

SELECT DATE_ADD(reservTime, INTERVAL 1 MINUTE) as rt, DATE_ADD(endTime, INTERVAL 1 MINUTE) as et FROM rm_reserved

SELECT DATE_SUB(reservTime, INTERVAL 1 MINUTE), DATE_SUB(endTime, INTERVAL 1 MINUTE) FROM rm_reserved

SELECT * FROM rm_reserved WHERE DATE_SUB(reservTime, INTERVAL 1 MINUTE) = :reservTime

SELECT r.id,r.name  <- 이건 방 목록 table의 ID을 말하는거 맞아?
FROM rooms r <- 이건 “rmlist table 같은데, 끝에 “r”은 뭐지?
JOIN room_times rt on r.id=rt.rooms_id <- 이건 INNER JOIN 인건 알겠는데, 뭐하고 조인 하는거지?
WHERE 
rt.day=1 <- 이건 뭐지?
AND "11:00:00" BETWEEN rt.start_time and rt.end_time 
AND "13:00:00"  BETWEEN rt.start_time and rt.end_time;

SELECT * FROM reservations rv WHERE <- “rv”는 뭐지?
(
("2019-03-26 11:00:00" > rv.start_time  and "2019-03-26 11:00:00" < rv.end_time)
OR 
("2019-03-26 12:00:00" > rv.start_time  and "2019-03-26 12:00:00" < rv.end_time)
OR
("2019-03-26 11:00:00" <= rv.start_time  and "2019-03-26 12:00:00" >= rv.end_time)
) AND rv.rooms_id IN (1,2);

-- THIS QUERY WORKS
-- In order to make this query work in php, I must process inputed time criteria with adding or subtracting 1 minute from the time variable.
SELECT * FROM rm_reserved WHERE DATE_ADD(reservTime, INTERVAL 1 MINUTE) = '18:01:00'

  SELECT * FROM conflict WHERE (start_time < '11:00:00') AND (end_time > '09:00:00')
  -- '11:00:00' <-- "end-time" and '09:00:00'<-- "start-time" must come from input data

  SELECT * FROM rm_reserved WHERE (reservTime < '18:00:00') AND (endTime > '07:00:00')
  -- '18:00:00'<=="end-time" and '07:00:00'<=="start-time" must come from input data

-- Important!!! see below for query stmt!
$sql =
  "SELECT * FROM rm_reserved WHERE (reservTime < :endTime) AND (endTime > :reservTime)";

  $statement = $conn->prepare($sql);
  $statement->bindParam(':reservTime',$reservation['reservTime']);
  $statement->bindParam(':endTime',$reservation['endTime']);
  $statement->execute();

  $reservations = $statement->fetchAll();

CREATE VIEW rm_reserved_with_RmId AS
SELECT reservations.reservID,
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
      AND reservDate = :reservDate
      AND (reservTime < :endTime)
      AND (endTime > :reservTime)
 ORDER BY reservations.reservTime

CREATE VIEW rm_reserved AS
SELECT reservations.reservID,
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
 ORDER BY reservations.reservDate;

 SELECT * FROM reservations
 JOIN * FROM resersv_perm_events
 WHERE reservations.rmReserv = resersv_perm_events.rmReserv

