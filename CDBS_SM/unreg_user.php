<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "includes/cdnj.inc.dbh.php";
$sql = "SELECT *,
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
  cdnj_group.grName
  FROM reservations
  JOIN rmlist
  ON reservations.rmReserv = rmlist.rmId
  LEFT JOIN cdnj_group
  ON reservations.reservGroup = cdnj_group.grId
  WHERE reservations.reservDate >= CURRENT_DATE() 
  AND reservations.reservStatus
  ORDER BY reservations.reservDate, reservations.reservTime";
$statement = $conn->prepare($sql);
$statement->execute();
$reservations = $statement->fetchAll();
?>
<!-- // Start View -->
<div class="unreg">
  <h2>APPROVED BOOKINGS</h2>
  <table class="unreg-table">
    <thead>
      <tr>
        <th>날짜<br>요일</th>
        <th>위치<br>그룹</th>
        <th>시작 시간<br>종료 시간</th>
        <th>행사 이름</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($reservations as $row) : ?>
      <tr>
        <td><?php echo $row["reservDate"]."<br>".$row["wkDay"]; ?></td>
        <td><?php echo $row["rmName"]."<br>".$row["grName"]; ?></td>
        <td><?php echo $row["st"]."<br>".$row["et"]; ?></td>
        <td><?php echo $row["reservPurpose"]; ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div><br>
