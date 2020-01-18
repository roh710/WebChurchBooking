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

-- UNION join reservations & perm_events tables
SELECT reservDate, 
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
SELECT event_st_date, 
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
ORDER BY reservDate

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

-- Insert row for each date within range
-- Explanation: The subselect creates a temporary table with a row for every day between start ('2014-07-01') and end ('2015-07-01'). So MySQL has only to do one single INSERT and this is much faster than a row by row insert.
INSERT INTO your_table (date, status, col3, col4)
SELECT
    DATE_ADD('2014-07-01', INTERVAL t.n DAY),
    'your status',
    NULL,
    NULL
FROM (
    SELECT 
        a.N + b.N * 10 + c.N * 100 AS n
    FROM
        (SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) a
       ,(SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) b
       ,(SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) c
    ORDER BY n
) t   
WHERE
    t.n <= TIMESTAMPDIFF(DAY, '2014-07-01', '2015-07-01');

-- Another possible solution according to Stackoverflow.com
INSERT INTO #dates
VALUES      ('Bob','2014-10-30','2014-11-02')

DECLARE @maxdate DATETIME = (SELECT Max([end]) FROM   #dates);

WITH cte
     AS (SELECT NAME,
                START,
                [END]
         FROM   #dates
         UNION ALL
         SELECT NAME,
                Dateadd(day, 1, start),
                Dateadd(day, 1, start)
         FROM   cte
         WHERE  start < @maxdate)
SELECT *
FROM   cte


-- resservations with weekdays column
SELECT reservations.reservID,
reservations.reservDate, 
DAYOFWEEK(reservDate) AS wkDay,
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
ORDER BY reservations.reservDate

-- this UNION JOIN works the best so far --
  SELECT reservDate, DAYOFWEEK(reservDate) AS wkDay, reservPurpose AS 'Event Name', rmReserv, reservTime, endTime,reservGroup, reservStatus
  FROM reservations r
  -- conditions --
  WHERE reservDate = '2019-05-19' OR DAYOFWEEK(reservDate) = '1'
  UNION
  SELECT event_st_date AS Date, event_wkday AS wkDay, event_name, rmlist_fk, event_st_time, event_end_time, grId_fk, status
  FROM perm_events
  -- conditions --
  WHERE event_wkday = '1'
  ORDER BY reservDate