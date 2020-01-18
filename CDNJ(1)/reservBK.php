<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'header.php';
include 'includes/cdnj.inc.dbh.php';
include 'includes/functions.inc.cdbs.php';

if (!isset($_SESSION['user_info'])) {
   exit;
}

$reservation =[
   "rmReserv"      => "",
   "reservDate"    => "",
   "reservTime"    => "",
   "endTime"       => "",
];
$confResult="";
$conf="";
$rc="";

// Get room list for the Room drop-down list
$sql = "SELECT rmId, rmName FROM rmlist ORDER BY rmName";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rooms = $stmt->fetchAll();

if (isset($_POST['reserv'])) {

   $reservation = [
      "rmReserv"     => $_POST['rmReserv'],
      "reservDate"   => $_POST['date'],
      "reservTime"   => $_POST['startTime'],
      "endTime"      => $_POST['endTime'],
   ];
   $confResult = Conflicts($reservation);
   $rc = $confResult['rowCount'];
   $conf = $confResult['reservations'];
   print_r($confResult);
   print_r($rc);

}
?>
<?php print_r($conf); ?>
<div class="input-form">
   <form method="POST">
   <h3>Reserve Form</h3>
      <div>
			<label for="rmReserv">Room Name</label>
			<select name="rmReserv" id="rmReserv">
				<option hidden value="">--Select Room--</option>
					<?php foreach ($rooms as $row) : ?>
				<option value="<?php echo $row["rmId"]; ?>">
					<?php echo $row["rmName"]; ?></option>
					<?php endforeach; ?>
			</select>
	   </div>
      <div>
         <label for="date">Date</label>
         <input type="date" name="date" required="" value=<?php echo $reservation['reservDate'] ?>>
      </div>
      <div>
         <label for="startTime">Reserve Time</label>
         <input type="time" step=900 name="startTime" required="" value=<?php echo $reservation['reservTime'] ?>>   
      <div>
      </div> 
         <label for="startTime">End Time</label>
         <input type="time" step=900 name="endTime" required="" value=<?php echo $reservation['endTime'] ?>>
      </div>
      <div>
      <label for="piano">Piano</label>
         <select name="piano">
         <option selected hidden value="">Piano?</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
         </select>
      </div>
      <div class="add_btn">
         <input type="submit" name="reserv" value="Check Availability">
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
         <?php foreach ($confResult as $row) : ?>
            <tr>
               <!-- <td><?php echo $row['rowCount']?></td> -->
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

<div style="margin-top: 55px;"></div>
<?php include 'footer.php'; ?>