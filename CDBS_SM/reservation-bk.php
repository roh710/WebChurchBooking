?>
<!-- <?php echo $msg; ?>
<?php echo $conf['rowCount']; ?>
<?php print_r($reservation); ?> -->
<!-- Start View -->
<div class="input-form">
	<form method="POST">
      <h5 class="input-form">* = Piano</h5>
		<input type="hidden" name="reservID" required="" value="<?php echo $reservation['reservID']; ?>">
		<div>
      <?php if ($edit_state == false): ?>
      <h3>book form</h3>
			<label for="rmReserv">Room/Loc</label>
          <select name="rmReserv"  required="">
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
			<select name="rmReserv" required="">
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
        <input type="date" name="reservDate" required="" value="<?php echo $conf['rowCount'] > 0 ? $reservation['reservDate']:$update_reserv['reservDate']; ?>">
			</div>
		  <div>
        <label for="reservTime">Start Time</label>
        <input type="time" step="900" name="reservTime" required="" value="<?php echo $conf['rowCount'] > 0 ? $reservation['reservTime']:$update_reserv["reservTime"]; ?>">
        <label for="endTime">Ending Time</label>
        <input type="time" step="900" name="endTime" required="" value="<?php echo $conf['rowCount'] > 0 ? $reservation['endTime']:$update_reserv["endTime"]; ?>">
		  </div>
			<div>
			<?php if ($edit_state == false): ?>
        <label for="uGroup">GROUP</label>
				<select name="uGroup" required="">
					<option selected hidden value="">----- Select Group -----</option>
						<?php foreach ($grResults as $grResult) : ?>
					<option value="<?php echo escape($grResult['grId']); ?>">
						<?php echo escape($grResult["grName"]); ?></option>
						<?php endforeach; ?>
				</select>
			<?php else: ?>
        <label for="uGroup">Group</label>
				<select name="uGroup" required="">
					<option hidden value="">----- Select Group -----</option>
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
        <input type="text" name="reservPurpose" required="" value="<?php echo $conf['rowCount'] > 0 ? $reservation['reservPurpose']:$update_reserv["reservPurpose"]; ?>">
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