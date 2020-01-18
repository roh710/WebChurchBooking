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

CREATE VIEW userInfo_perm AS
SELECT users.user_firstname, users.user_lastname, users.user_kor_name, users.user_name, users.user_pwd, cdnj_group.user_perm_level, cdnj_group.grId, cdnj_group.grName FROM users
JOIN cdnj_group
ON users.user_group_fk = cdnj_group.grId;
