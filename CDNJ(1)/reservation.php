<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// include './header.php';
// include 'includes/functions.inc.cdbs.php';
include 'includes/reservation.inc.php';

// Initialize
// $conf['rowCount'] = "";
// $conf['reservations'] = "";

if (!isset($_SESSION['user_info'])) {
	exit;
} elseif ($_SESSION['uPermission']!='Admin') {
	header("location: index.php");
	exit;
}
?>

<!-- Start Form View (BOOK or UPDATE FORM) -->
<div class="input-form">
  <form method="POST">
  <?php if ($edit_state == false): ?>
    <h5>* = Piano</h5>
    <h3>BOOK FORM</h3>
  <?php else: ?>
    <h5>* = Piano</h5>
    <h3>UPDATE FORM</h3>
  <?php endif; ?>
  <input type="hidden" name="reservID" value="<?php echo $reservation['reservID']; ?>">
  <div>
    <?php if ($edit_state == false): ?>
      <label for="rmReserv">Room/Loc</label>
      <select name="rmReserv" required oninvalid="setCustomValidity('방 이름을 목록에서 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
        <option selected hidden value="">----------- Select Room -----------</option>
        <?php foreach ($rooms as $row) : ?>
          <option value="<?php echo escape($row["rmId"]); ?>">
          <?php echo escape($row["rmName"]); ?>
          <?php echo escape(' -- [' . $row["rmLocation"] . ' - ' . $row["rmMaxPersons"]). ']'; ?>
          <?php echo escape($row["rmPiano"] > 0 ? '*':''); ?>
        <?php endforeach; ?>
      </select>
    <?php else: ?>
			<label for="rmReserv">Room/Loc</label>
			<select name="rmReserv" required oninvalid="setCustomValidity('방 이름을 목록에서 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
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
    <label for="reservDate">Book Date</label>
    <input type="date" name="reservDate" required oninvalid="setCustomValidity('날짜를 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $reservation['reservDate']; ?>">
  </div>
  <div>
    <label for="reservTime">Start/End Time</label>
    <input class="input-style1" type="time" step="900" name="reservTime" required oninvalid="setCustomValidity('시간을 15분 간격으로 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $reservation["reservTime"]; ?>">
    <!-- <label for="endTime">Ending Time</label> -->
    <input class="input-style1" type="time" step="900" name="endTime" required oninvalid="setCustomValidity('시간을 15분 간격으로 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $reservation["endTime"]; ?>">
  </div>
  <div>
  <?php if ($edit_state == false): ?>
    <label for="uGroup">Group</label>
    <select name="uGroup" required oninvalid="setCustomValidity('소속그룹을 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
      <option selected hidden value="">----------- Select Group -----------</option>
        <?php foreach ($grResults as $grResult) : ?>
      <option value="<?php echo escape($grResult['grId']); ?>">
        <?php echo escape($grResult["grName"]); ?></option>
        <?php endforeach; ?>
    </select>
  <?php else: ?>
    <label for="uGroup">Group</label>
    <select name="uGroup" required oninvalid="setCustomValidity('소속그룹을 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
      <option hidden value=""></option>
        <?php foreach ($grResults as $grResult) : ?>
      <option value="<?php echo escape($grResult["grId"]); ?>" 
        <?php echo $grResult["grId"] == $reservation["reservGroup"] ? 'selected':''?>>
      <?php echo escape($grResult["grName"]); ?>
      </option>
        <?php endforeach; ?>
    </select>				
  <?php endif; ?>
  </div>
  <div>
    <label for="reservPurpose">Event Name</label>
    <input type="text" name="reservPurpose" required oninvalid="setCustomValidity('모임 이름을 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $reservation["reservPurpose"]; ?>">
	</div>
  <?php if (isset($_GET['ed'])): ?>
  <div class="edit_btn">
    <input type="submit" name="update" value="UPDATE">
    <input type="submit" name="clr" value="CLEAR">
  </div>
  <?php else: ?>
  <div class="add_btn">
    <input type="submit" name="book" value="BOOK">
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
          <th>Date</th>
          <th>Wkday</th>
          <th>Loction</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Purpose</th>
          <th>Group Name</th>
          <th>Status</th>
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
   <div class="reserv-table">
	<table>
    <thead>
      <tr>
        <th>DATE<br>WKDAY</th>
        <th>TIME</th>
        <th>EVENT NAME<br>LOCATION</th>
        <th>GROUP<br>STATUS</th>
        <th>RESERVED</th>
        <th colspan="4">ACTION</th>
      </tr>
		</thead>
	   <tbody>
	  	<!-- loop through rm_reserved VIEW to populate Reservation table -->
	    <?php foreach ($reservations as $row) : ?>
	      <tr>
          <td><strong><?php echo escape($row["reservDate"])."<br>".escape($row["wkDay"]); ?></strong></td>
          <td><?php echo escape($row["st"])."<br>".escape($row["et"]); ?></td>
          <td><?php echo escape($row["reservPurpose"])."<br>".escape($row["rmName"]); ?></td>
          <td><?php echo escape($row["grName"])."<br>"."<strong>".escape($row["status"]); ?></strong></td>
          <td><?php echo escape($row["reservCreated"]); ?></td>
          <td><a id="ed_btn" href="reserv_pass.php?ed=<?php echo escape($row["reservID"]); ?>">EDT</a></td>
          <td><a id="de_btn" href="reservation.php?del=<?php echo escape($row["reservID"]); ?>">DEL</a></td>
          <td><a id="ap_btn" href="reservation.php?apr=<?php echo escape($row["reservID"]); ?>">APR</a></td>
          <td><a id="dp_btn" href="reservation.php?dapr=<?php echo escape($row["reservID"]); ?>">DAP</a></td>
	      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<div style="margin-top: 55px;"></div>