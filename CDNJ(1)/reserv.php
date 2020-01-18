<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'header.php';
include 'includes/cdnj.inc.dbh.php';
include 'includes/functions.inc.cdbs.php';

if (!isset($_SESSION['user_info'])) {
   exit;
}

// Initialize
$reservation = [
   "reservDate"    => "",
   "rmReserv"      => "",
   "reservTime"    => "",
   "endTime"       => "",
   "reservPurpose" => "",
   "reservGroup"   => "",
   "reservStatus"  => ""
 ];
 $conf = "";
 $edit_state = false;

// Get room list for the Room drop-down list
$sql = "SELECT rmId, rmName FROM rmlist ORDER BY rmName";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rooms = $stmt->fetchAll();

// To be used for populating Group-list drop-down list
$uPermLevel = 'User';
$sql = "SELECT grId, grName
FROM cdnj_group
WHERE user_perm_level = :user_perm_level
ORDER BY grName";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_perm_level', $uPermLevel);
$stmt->execute();
$grResults = $stmt->fetchAll();

if (isset($_POST['book'])) {
   $reservation =[
      "reservID"      => $_GET['ed'],
      "reservDate"    => $_POST['reservDate'],
      "rmReserv"      => $_POST['rmReserv'],
      "reservTime"    => $_POST['reservTime'],
      "endTime"       => $_POST['endTime'],
      "reservGroup"   => $_POST['uGroup'],
      "reservPurpose" => $_POST['reservPurpose']
    ];

   $conf = Conflicts($reservation);
   // print_r($conf);
}
?>
<?php print_r($conf); ?>
<!-- Start View -->
<div class="input-form">
	<form method="POST" action="reserv.php">
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
         <select name="uGroup">
            <option hidden value="">----- Select Group -----</option>
               <?php foreach ($grResults as $grResult) : ?>
            <option value="<?php echo escape($grResult["grId"]); ?>" 
               <?php echo $grResult["grId"] == $reservation["reservGroup"] ? 'selected':''?>>
            <?php echo escape($grResult["grName"]); ?>
            </option>
               <?php endforeach; ?>
         </select>				
      <?php endif ?>
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
         <?php endif ?>
      </div>
	</form>
</div>
<div class="r-table">
<?php if (empty($conf)): ?>
<!-- Reservation Table goes here -->
<table>
   <h2>No Conflict</h2>
</table>
<?php else: ?>
      <table>
      <h2>Conflict(s)</h2>
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
         <?php foreach ($conf as $row) : ?>
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
<?php endif; ?>
</div>
<?php include 'footer.php'; ?>