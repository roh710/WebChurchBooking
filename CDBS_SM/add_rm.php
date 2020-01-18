<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_info'])) {
   header('location: login.form.php');
}
require 'includes/cdnj.inc.dbh.php';
require_once 'header.php';
include 'includes/functions.inc.cdbs.php';

   // initialize variables
   $rmInfo = [
      'rmN' => "",
      'rmL' => "",
      'rmD' => "",
      'rmM' => "",
      'rmSAT' => "",
      'rmEAT' => "",
      'rmP' => "",
      'rmId' => "",
      'edit_state' => false
    ];

   // Call function addRm()
   addRm();

   // Call function updateRm()
   updateRm();

   

   if (isset($_GET['edit'])) { // Get id from url
      $rmId = $_GET['edit'];

      // Call function getRmId()
      $rmInfo = getRmId($rmId);
   }

   // Call function displayRm()
   $results = displayRm();

   // $query = "SELECT * FROM rmlist ORDER BY rmName ASC";
   // $results = $conn->query($query);

?>
<div class="input-form">
<!-- Populating data inside of their fields when edit is pressed -->
   <form method="POST" action="add_rm.php">
   <h6>P</h6>
   <?php if ($rmInfo['edit_state'] == false): ?>
      <h3>ADD ROOM FORM</h3>
   <?php else: ?>
      <h3>EDIT ROOM FORM</h3>
   <?php endif ?>
   <input type="hidden" name="rmId" value="<?php echo $rmInfo['rmId']; ?>">
      <div>
            <label for="rmName">Room Name</label>
            <input type="text" name="rmName" required="" value="<?php echo $rmInfo['rmN']; ?>">
      </div>
      <div>
            <label for="rmLocation">Location</label>
            <input type="text" name="rmLocation" required="" value="<?php echo $rmInfo['rmL']; ?>">
      </div>
      <div>
            <label>Description</label>
            <input type="text" name="rmDesc" required="" value="<?php echo $rmInfo['rmD']; ?>">
      </div>
      <div>
            <label for="rmMaxPersons">Max Persons</label>
            <input type="number" name="rmMaxPersons" required="" value="<?php echo $rmInfo['rmM']; ?>" required="">
      </div>
      <div>
            <label for="rmStartAvailTime">SAT</label>
            <input type="time" name="rmStartAvailTime" value="<?php echo $rmInfo['rmSAT']; ?>" required="">
      </div>
      <div>
            <label for="rmEndAvailTime">EAT</label>
            <input type="time" name="rmEndAvailTime" value="<?php echo $rmInfo['rmEAT']; ?>" required="">
      </div>
      <div>
      <label for="rmPiano">Piano</label>
      <select name="rmPiano" required="">
      <?php if ($rmInfo['edit_state'] == false): ?>
         <option selected hidden value="">--- Has piano? ---</option>
         <option value="1">Yes</option>
         <option value="0">No</option>
      <?php else: ?>
         <option value="1" <?php echo $rmInfo['rmP'] == 1 ? 'selected':'' ?>>Yes</option>
         <option value="0" <?php echo $rmInfo['rmP'] == 0 ? 'selected':'' ?>>No</option>
      <?php endif ?> 
      </select>
      </div>
      <div>
      <?php if ($rmInfo['edit_state'] == false): ?>
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
<br><br><br>
<?php include 'footer.php'; ?>