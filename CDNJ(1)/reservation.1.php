<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// include './header.php';
include 'includes/reservation.inc.php';
if (!isset($_SESSION['user_info'])) {
	exit;
} elseif ($_SESSION['uPermission']!='Admin') {
	header("location: index.php");
	exit;
}

$uPermLevel = "User";

// To be used for populating Group-list drop-down list
$grResults = $conn->prepare(
  "SELECT grId, grName
  FROM cdnj_group
  WHERE
    user_perm_level = :user_perm_level
  ORDER BY
    grName ASC");
$grResults->bindParam(':user_perm_level', $uPermLevel);
$grResults->execute();
?>

<!-- Start View -->
<?php if (isset($_GET['ed'])): ?>
<!--  Edit  -->
<div class="reserv-form">
	<form method="POST">
		<h3>update form</h3>
		<input type="hidden"  name="rmID" value="<?php echo $reservation['reservID']; ?>">
		<div>
			<label for="rmReserv">Room Name</label>
			<select name="rmReserv">
		      <option value="">--Select Room--</option>
		      <?php foreach ($rooms as $row) : ?>
		         <option value="<?php echo escape($row["rmId"]); ?>" 
						 <?php echo $row["rmId"] == $reservation["rmReserv"] ? 'selected':''?>>
		         <?php echo escape($row["rmName"]); ?>
		         </option>
		      <?php endforeach; ?>
		    </select>
		  </div>
		  <div>
		     <label for="reservDate">Reservation Date</label>
		     <input type="date" name="reservDate" value="<?php echo $reservation["reservDate"]; ?>">
		     </div>
		  <div>
		     <label for="reservTime">Start Time</label>
		     <input type="time" step="900" name="reservTime" value="<?php echo $reservation["reservTime"]; ?>">
		     <label for="endTime">Ending Time</label>
		     <input type="time" step="900" name="endTime" value="<?php echo $reservation["endTime"]; ?>">
		   </div>
			<div>
				<label for="uGroup">Group Name</label>
				<select name="uGroup">
					<option value="">--Select Group--</option>
						<?php foreach ($grResults as $grResult) : ?>
					<option value="<?php echo escape($grResult["grId"]); ?>" 
						<?php echo $grResult["grId"] == $reservation["reservGroup"] ? 'selected':''?>>
					<?php echo escape($grResult["grName"]); ?>
					</option>
						<?php endforeach; ?>
				</select>
		  	<div>
				<label for="reservPurpose">Event Name</label>
				<input type="text" name="reservPurpose" required="" value="<?php echo $reservation["reservPurpose"]; ?>">
		   </div>
		  	<div class="add_btn">
		     	<input type="submit" name="update" value="UPDATE">
		  	</div>
	</form>
</div>
<?php else: ?>
<!--  create -->

<div class="reserv-form">
	<form method="POST">
		<h3>reserve form</h3>
	   <div>
			<label for="rmReserv">Room Name</label>
			<select name="rmReserv">
				<option selected hidden value="">--Select Room--</option>
					<?php foreach ($rooms as $row) : ?>
				<option value="<?php echo escape($row["rmId"]); ?>">
					<?php echo escape($row["rmName"]); ?></option>
					<?php endforeach; ?>
			</select>
	  </div>
	  <div>
			<label for="reservDate">Reservation Date</label>
			<input type="date" name="reservDate">
		</div>
		<div>
			<label for="reservTime">Start Time</label>
			<input type="time" step="900" name="reservTime" id="reservTime">
			<label>Ending Time</label>
			<input type="time" step="900" name="endTime">
	  	</div>
		<div>
			<label for="uGroup">GROUP</label>
			<select name="uGroup" required="">
				<option selected hidden value="">--Select Group--</option>
					<?php foreach ($grResults as $grResult) : ?>
				<option value="<?php echo escape($grResult['grId']); ?>">
					<?php echo escape($grResult["grName"]); ?></option>
					<?php endforeach; ?>
			</select>
		</div>
	  	<div>
			<label for="reservPurpose">Event Name</label>
			<input type="text" name="reservPurpose" required="">
		</div>
		<div class="add_btn">
	     	<input type="submit" name="create" value="RESERVE">
	  	</div>
	</form>
</div>
<?php endif; ?>
<!-- <div class="reserv-title">
	<h2>Reservation List</h2>
</div> -->
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
