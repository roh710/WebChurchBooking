<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// include './header.php';
// include 'includes/reservation.inc.php';
include 'includes/reservation.incBK.php';

if (!isset($_SESSION['user_info'])) {
	exit;
} elseif ($_SESSION['uPermission']!='Admin') {
	header("location: index.php");
	exit;
}
?>

<!-- Start View -->
<div class="input-form">
	<form method="POST">
      <h5>* = Piano</h5>
		<input type="hidden" name="rmID" value="<?php echo $reservation['reservID']; ?>">
		<div>
      <?php if ($edit_state == false): ?>
      <h3>book form</h3>
			<label for="rmReserv">Room/Loc</label>
         <select name="rmReserv">
            <option selected hidden value="">------ Select Room ------</option>
            <?php foreach ($rooms as $row) : ?>
            <option value="<?php echo escape($row["rmId"]); ?>">
            <?php echo escape($row["rmName"]); ?>
            <?php echo escape(' -- [' . $row["rmLocation"] . ' - ' . $row["rmMaxPersons"]). ']'; ?>
            <?php echo escape($row["rmPiano"] > 0 ? '*':''); ?>
            <?php endforeach; ?>
         </select>
      <?php else: ?>
      <h3>update form</h3>
			<label for="rmReserv">Room/Loc</label>
			<select name="rmReserv">
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
				<input type="date" name="reservDate" value="<?php echo $reservation["reservDate"]; ?>">
			</div>
		  <div>
		     <label for="reservTime">Start Time</label>
		     <input type="time" step="900" name="reservTime" value="<?php echo $reservation["reservTime"]; ?>">
		     <label for="endTime">Ending Time</label>
		     <input type="time" step="900" name="endTime" value="<?php echo $reservation["endTime"]; ?>">
		  </div>
			<div>
			<?php if ($edit_state == true): ?>
				<label for="uGroup">Group</label>
				<select name="uGroup">
					<option hidden value="">----- Select Group -----</option>
						<?php foreach ($grResults as $grResult) : ?>
					<option value="<?php echo escape($grResult["grId"]); ?>" 
						<?php echo $grResult["grId"] == $reservation["reservGroup"] ? 'selected':''?>>
					<?php echo escape($grResult["grName"]); ?>
					</option>
						<?php endforeach; ?>
				</select>
			<?php else: ?>
				<label for="uGroup">GROUP</label>
				<select name="uGroup" required="">
					<option selected hidden value="">----- Select Group -----</option>
						<?php foreach ($grResults as $grResult) : ?>
					<option value="<?php echo escape($grResult['grId']); ?>">
						<?php echo escape($grResult["grName"]); ?></option>
						<?php endforeach; ?>
				</select>
			<?php endif; ?>
			</div>	
			<div>
            <label for="reservPurpose">Event Name</label>
            <input type="text" name="reservPurpose" required="" value="<?php echo $reservation["reservPurpose"]; ?>">
			</div>
			<div>
            <?php if ($edit_state == false): ?>
               <div class="add_btn">
                  <input type="submit" name="book" value="BOOK">
               </div>
            <?php else: ?>
               <div class="edit_btn">
                  <input type="submit" name="update" value="UPDATE">
                  <input type="submit" name="clr" value="CLEAR">
               </div>
            <?php endif; ?>
			</div>
	</form>
</div>

<div class="reserv-table">
	<table>
	    <thead>
	        <tr>
	            <th>Date<br>Wkday</th>
	            <th>Time</th>
	            <th>Event Name<br>Location</th>
							<th>Group<br>Status</th>
							<th>Reserved</th>
	            <th colspan="4">Action</th>
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