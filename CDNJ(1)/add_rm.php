<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_info'])) {
   header('location: login.form.php');
}
require 'includes/cdnj.inc.dbh.php';
require_once 'header.php';

   // initialize variables
   $rmN = "";
	$rmL = "";
	$rmD = "";
	$rmM = "";
	$rmSAT = "";
	$rmEAT = "";
	$rmP = "";
	$rmId = "";
   $edit_state = false;

   // if save button is clicked
   if(isset($_POST['addRm'])) {
   	$rmN = trim($_POST['rmName']);
   	$rmL = trim($_POST['rmLocation']);
   	$rmD = trim($_POST['rmDesc']);
   	$rmM = $_POST['rmMaxPersons'];
   	$rmSAT = $_POST['rmStartAvailTime'];
   	$rmEAT = $_POST['rmEndAvailTime'];
   	$rmP = $_POST['rmPiano'];

      $st = $conn->prepare("INSERT INTO rmlist (rmName, rmLocation, rmDesc, rmMaxPersons, rmStartAvailTime, rmEndAvailTime, rmPiano) VALUES (:rmName, :rmLocation, :rmDesc, :rmMaxPersons, :rmStartAvailTime, :rmEndAvailTime, :rmPiano)");

   	$st->bindParam(':rmName',$rmN);
   	$st->bindParam(':rmLocation',$rmL);
   	$st->bindParam(':rmDesc',$rmD);
   	$st->bindParam(':rmMaxPersons',$rmM);
   	$st->bindParam(':rmStartAvailTime',$rmSAT);
   	$st->bindParam(':rmEndAvailTime',$rmEAT);
   	$st->bindParam(':rmPiano',$rmP);

   	$st->execute();
      echo ("<script> window.location = './add_rm.php'; </script>") ;
   }

   // Update record
   if (isset($_POST['edRm'])) {
		$rmId = $_POST['rmId'];
      $rmN = trim($_POST['rmName']);
   	$rmL = trim($_POST['rmLocation']);
   	$rmD = trim($_POST['rmDesc']);
   	$rmM = $_POST['rmMaxPersons'];
   	$rmSAT = $_POST['rmStartAvailTime'];
   	$rmEAT = $_POST['rmEndAvailTime'];
   	$rmP = $_POST['rmPiano'];
      $_SESSION['msg'] = "The record, " . $rmN . " has been updated";

      //Our UPDATE SQL statement.
      $sql = "UPDATE rmlist SET rmName = :rmName, rmLocation = :rmLocation, rmDesc = :rmDesc, rmMaxPersons = :rmMaxPersons, rmStartAvailTime = :rmStartAvailTime, rmEndAvailTime = :rmEndAvailTime, rmPiano = :rmPiano  WHERE rmId = :rmId";

      // Prepare our UPDATE SQL statement.
      $st = $conn->prepare($sql);

		// Bind values to the parameters.
      $st->bindParam(':rmName',$rmN);
   	$st->bindParam(':rmLocation',$rmL);
   	$st->bindParam(':rmDesc',$rmD);
   	$st->bindParam(':rmMaxPersons',$rmM);
   	$st->bindParam(':rmStartAvailTime',$rmSAT);
   	$st->bindParam(':rmEndAvailTime',$rmEAT);
		$st->bindParam(':rmPiano',$rmP);
		$st->bindParam(':rmId',$rmId);

      //Execute UPDATE statement.
      $update = $st->execute();
      echo ("<script> window.location = './add_rm.php'; </script>") ;
   }

   if (isset($_GET['edit'])) { // Get id from url
      $rmId = $_GET['edit'];

      $query = $conn->query("SELECT * FROM rmlist WHERE rmId = $rmId");
		$record = $query->fetch(PDO::FETCH_ASSOC);

      $rmN = $record['rmName'];
      $rmL = $record['rmLocation'];
      $rmD = $record['rmDesc'];
		$rmM = $record['rmMaxPersons'];
		$rmSAT = $record['rmStartAvailTime'];
		$rmEAT = $record['rmEndAvailTime'];
		$rmP = $record['rmPiano'];
      $rmId = $record['rmId'];
      $edit_state = true;
   }

   $query = "SELECT * FROM rmlist ORDER BY rmName ASC";
   $results = $conn->query($query);

?>
<div class="input-form">
<!-- Populating data inside of their fields when edit is pressed -->
   <form method="POST" action="add_rm.php">
   <h6>P</h6>
   <?php if ($edit_state == false): ?>
      <h3>ADD ROOM FORM</h3>
   <?php else: ?>
      <h3>EDIT ROOM FORM</h3>
   <?php endif ?>
   <input type="hidden" name="rmId" value="<?php echo $rmId; ?>">
      <div>
            <label for="rmName">Room Name</label>
            <input type="text" name="rmName" required="" value="<?php echo $rmN; ?>">
      </div>
      <div>
            <label for="rmLocation">Location</label>
            <input type="text" name="rmLocation" required="" value="<?php echo $rmL; ?>">
      </div>
      <div>
            <label>Description</label>
            <input type="text" name="rmDesc" required="" value="<?php echo $rmD; ?>">
      </div>
      <div>
            <label for="rmMaxPersons">Max Persons</label>
            <input type="number" name="rmMaxPersons" required="" value="<?php echo $rmM; ?>" required="">
      </div>
      <div>
            <label for="rmStartAvailTime">SAT</label>
            <input type="time" name="rmStartAvailTime" value="<?php echo $rmSAT; ?>" required="">
      </div>
      <div>
            <label for="rmEndAvailTime">EAT</label>
            <input type="time" name="rmEndAvailTime" value="<?php echo $rmEAT; ?>" required="">
      </div>
      <div>
      <label for="rmPiano">Piano</label>
      <select name="rmPiano" required="">
      <?php if ($edit_state == false): ?>
         <option selected hidden value="">--- Has piano? ---</option>
         <option value="1">Yes</option>
         <option value="0">No</option>
      <?php else: ?>
         <option value="1" <?php echo $rmP == 1 ? 'selected':'' ?>>Yes</option>
         <option value="0" <?php echo $rmP == 0 ? 'selected':'' ?>>No</option>
      <?php endif ?> 
      </select>
      </div>
      <div>
      <?php if ($edit_state == false): ?>
         <div class="add_btn">
            <input type="submit" name="addRm" value="ADD ROOM">
         </div>
      <?php else: ?>
         <div class="edit_btn">
            <input type="submit" name="edRm" value="UPDATE">
            <input type="submit" name="clr" value="CLEAR">
         </div>
      <?php endif ?>
      </div>
   </form>
</div>
<?php if (isset($_SESSION['msg'])): ?>
   <div class="msg">
      <?php
         echo $_SESSION['msg'];
         unset($_SESSION['msg']);
         ?>
   </div>
<?php endif ?>
<table class="group-table">
   <thead>
      <tr>
         <th>NAME</th>
         <th>LOCATION</th>
         <th>DESCRIPTION</th>
         <th>MAX PERSONS</th>
         <th>SAT</th>
         <th>EAT</th>
         <th>PIANO</th>
         <th>ACTION</th>
      </tr>
   </thead>
   <tbody>
      <?php while ($row = $results->fetch(PDO::FETCH_ASSOC)) { ?>
         <tr>
            <td><?php echo $row['rmName']; ?></td>
            <td><?php echo $row['rmLocation']; ?></td>
            <td><?php echo $row['rmDesc']; ?></td>
            <td><?php echo $row['rmMaxPersons']; ?></td>
            <td><?php echo $row['rmStartAvailTime']; ?></td>
            <td><?php echo $row['rmEndAvailTime']; ?></td>
            <td><?php echo $row["rmPiano"] == '1' ? 'Yes':'No'?></td>
            <td>
               <a id="ed_btn" href="add_rm.php?edit=<?php echo $row['rmId']; ?>">Edit</a>
            </td>
         </tr>
      <?php } ?>
   </tbody>
</table>
<!-- <div style="margin-top: 55px;"></div> -->
<?php echo "<br/>"; ?>
<?php echo "<br/>"; ?>
<?php include 'footer.php'; ?>