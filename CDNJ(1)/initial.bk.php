<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/initial.inc.php';
include_once 'header.php';

if (!isset($_SESSION['user_info'])) {
  exit;
}
?>
<?php echo $msg; ?>
<?php echo $conf['rowCount']; ?>
<?php print_r($reservation); ?>
<!-- Start View -->
<!-- Edit -->
<div class="input-form">
  <form method="POST" action="initial.php">
  <?php if ($edit_state == false): ?>
    <h5 class="input-form">* = Piano</h5>
    <h3>book form</h3>
  <?php else: ?>
    <h5 class="input-form">* = Piano</h5>
    <h3>update form</h3>
  <?php endif; ?>
  <input type="hidden"  name="reservID" value="<?php echo $reservation['reservID']; ?>">
  <div>
    <?php if ($edit_state == false): ?>
      <label for="rmReserv">Room/Loc</label>
      <select name="rmReserv" required oninvalid="setCustomValidity('방 이름을 목록에서 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
        <option selected hidden value="">------ Select Room ------</option>
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
        <option hidden value="">------ Select Room ------</option>
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
    <label for="reservDate">book date</label>
    <input type="date" name="reservDate" required oninvalid="setCustomValidity('날짜를 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $conf['rowCount'] > 0 ? $reservation['reservDate']:$reservation['reservDate']; ?>">
  </div>
  <div>
    <label for="reservTime">Start Time</label>
    <input type="time" step="900" name="reservTime" required oninvalid="setCustomValidity('시작 시간을 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $conf['rowCount'] > 0 ? $reservation['reservTime']:$reservation["reservTime"]; ?>">
    <label for="endTime">Ending Time</label>
    <input type="time" step="900" name="endTime" required oninvalid="setCustomValidity('끝 시간을 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $conf['rowCount'] > 0 ? $reservation['endTime']:$reservation["endTime"]; ?>">
  </div>
  <div>
    <label for="reservPurpose">Event Name</label>
    <input type="text" name="reservPurpose" required oninvalid="setCustomValidity('모임/행사이름을 입력해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" / value="<?php echo $conf['rowCount'] > 0 ? $reservation['reservPurpose']:$reservation["reservPurpose"]; ?>">
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
<!-- <div class="reserv-title">
	<h2>Reservation List</h2>
</div> -->
<div class="reserv-table">
	<table>
	    <thead>
	        <tr>
	            <th>Date<br>Wkday</th>
	            <th>Time</th>
	            <th>Event<br>Location</th>
	            <th>Group<br>Status</th>
	            <th colspan="2">Action</th>
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
              <td colspan="2"><strong>No Access</strong></td>
            <?php endif; ?>
	        </tr>
	    <?php endforeach; ?>
	    </tbody>
	</table>
</div>