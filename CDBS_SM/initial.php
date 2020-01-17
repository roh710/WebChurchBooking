<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include_once 'header.php';
include 'includes/initial.inc.php';

if (!isset($_SESSION['user_info'])) {
  exit;
}
?>

<!-- Start Form View (예약 폼 or 편집 폼)-->
<div class="input-form">
  <form method="POST">
  <?php if ($edit_state == false): ?>
    <h5>* 피아노 있음</h5>
    <h3>예약 폼</h3>
  <?php else: ?>
    <h5>* 피아노 있음</h5>
    <h3>편집 폼</h3>
  <?php endif; ?>
  <input type="hidden"  name="reservID" value="<?php echo $reservation['reservID']; ?>">
  <div>
    <?php if ($edit_state == false): ?>
      <label for="rmReserv">방이름/위치:</label>
      <select name="rmReserv" required oninvalid="setCustomValidity('방 이름을 목록에서 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
        <option selected hidden value="">-------------- 방 선택 --------------</option>
        <?php foreach ($rooms as $row) : ?>
          <option value="<?php echo escape($row["rmId"]); ?>">
          <?php echo escape($row["rmName"]); ?>
          <?php echo escape(' -- [' . $row["rmLocation"] . ' - ' . $row["rmMaxPersons"]). ']'; ?>
          <?php echo escape($row["rmPiano"] > 0 ? '*':''); ?>
        <?php endforeach; ?>
      </select>
    <?php else: ?>
			<label for="rmReserv">방이름/위치:</label>
			<select name="rmReserv" id="rmReserv" required oninvalid="setCustomValidity('방 이름을 목록에서 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
        <option hidden value=""></option>
        <?php foreach ($rooms as $row) : ?>
          <option value="<?php echo escape($row["rmId"]); ?>" 
          <?php echo $row["rmId"] == $reservation["rmReserv"] ? 'selected':''?>>
          <?php echo escape($row["rmName"]); ?>
          <?php echo escape(' -- [' . $row["rmLocation"] . ' - ' . $row["rmMaxPersons"]). ']'; ?>
          <?php echo escape($row["rmPiano"] > 0 ? '*':''); ?>
          </option>
        <?php endforeach; ?>
			</select>
		<?php endif ?>
  </div>
  <div>
    <label for="reservDate">날짜:</label>
    <input type="date" name="reservDate" required oninvalid="setCustomValidity('날짜를 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $reservation['reservDate']; ?>">
  </div>
  <div>
    <label for="reservTime">시작/종료 시간:</label>
    <input class="input-style1" type="time" step="900" name="reservTime" required oninvalid="setCustomValidity('시작 시간을 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $reservation["reservTime"]; ?>">
    <!-- <label for="endTime">Ending Time</label> -->
    <input class="input-style1" type="time" step="900" name="endTime" required oninvalid="setCustomValidity('끝 시간을 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $reservation["endTime"]; ?>">
  </div>
  <div>
    <label for="reservPurpose">행사 명:</label>
    <input type="text" name="reservPurpose" required oninvalid="setCustomValidity('모임 이름을 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $reservation["reservPurpose"]; ?>">
	</div>
  <?php if (isset($_GET['ed'])): ?>
  <div class="edit_btn">
    <input type="submit" name="update" value="편 집">
    <input type="submit" name="clr" value="취 소">
  </div>
  <?php else: ?>
  <div class="add_btn">
    <input type="submit" name="book" value="예 약">
  </div>
  <?php endif; ?>
</form>
</div>
<?php echo $msg; ?>
<?php if ($conf['rowCount'] > 0):?>
<div class="r-table">
      <table>
         <thead>
            <tr>
               <th>날짜</th>
               <th>요일</th>
               <th>위치</th>
               <th>시작시간</th>
               <th>종료시간</th>
               <th>모임 이름</th>
               <th>소속 그룹</th>
               <th>상태</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($conf['reservations'] as $row) : ?>
               <tr>
                  <td><?php echo $row['reservDate']?></td>
                  <td><?php echo $row['wkDay']?></td>
                  <td><?php echo $row['rmName']?></td>
                  <td><?php echo $row['st']?></td>
                  <td><?php echo $row['et']?></td>
                  <td><?php echo $row['reservPurpose']?></td>
                  <td><?php echo $row['grName']?></td>
                  <td><?php echo $row['status']?></td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
<?php endif ?>
<!-- <div class="reserv-title">
	<h2>Reservation List</h2>
</div> -->
<div class="initial-table">
	<table>
	    <thead>
	        <tr>
	            <th>날짜<br>요일</th>
	            <th>시간</th>
	            <th>모임 이름<br>위치</th>
	            <th>소속 그룹<br>예약 상태</th>
	            <th colspan="2">편집/삭제</th>
	         </tr>
	    </thead>
	    <tbody>

	  <!-- loop through rm_reserved VIEW to populate Reservation table -->
	    <?php foreach ($reservations as $row) : ?>
	        <tr>
            <td><?php echo escape($row["reservDate"])."<br>".escape($row["wkDay"]); ?></td>
            <td><?php echo escape($row["st"])."<br>".escape($row["et"]); ?></td>
            <td><?php echo escape($row["reservPurpose"])."<br>".escape($row["rmName"]); ?></td>
            <td><?php echo escape($row["grName"])."<br>".escape($row["status"]); ?></td>
            <?php if ($_SESSION['user_group'] == $row["grName"]): ?>
              <td><a id="ed_btn" href="index.php?ed=<?php echo escape($row["reservID"]); ?>">EDT</a></td>
              <td><a id="de_btn" href="initial.php?del=<?php echo escape($row["reservID"]); ?>">DEL</a></td>
            <?php else: ?>
              <td colspan="2"><h3>편집불가</h3></td>
            <?php endif; ?>
	        </tr>
	    <?php endforeach; ?>
	    </tbody>
  </table>
</div><br>