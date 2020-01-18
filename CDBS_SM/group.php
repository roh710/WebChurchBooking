<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_info'])) {
  header('location: login.form.php');
}
  require 'includes/cdnj.inc.dbh.php';
  require_once 'header.php';
  include 'includes/functions.inc.cdbs.php';

  // initialize variables
  $grInfo = [
    'grName' => "",
    'grParent' => "",
    'grDesc' => "",
    'grPerm' => "",
    'grId' => "",
    'edit_state' => FALSE
  ];

  // Call function addGr() to add new group
  addGr();

  if (isset($_GET['edit'])) { // Get id from url
    $grId = $_GET['edit'];

    // get Gr ID
    $grInfo = getGrId($grId);
  }

  // Update record
  updateGr();
  
  // Call function displayGr for populating group-list table.
  $uGroup = displayGr();
?>

<div class="input-form">
<!-- Populating data inside of their fields when edit is cicked -->
<form method="POST" action="group.php">
<h6>P</h6>
<?php if ($grInfo['edit_state'] == FALSE): ?>
   <h3>ADD GROUP FORM</h3>
<?php else: ?>
   <h3>EDIT GROUP FORM</h3>
<?php endif ?>
<input type="hidden" name="grId" value="<?php echo $grInfo['grId']; ?>">
   <div>
      <label>Group Name</label>
      <input type="text" name="grName" required="" value="<?php echo $grInfo['grName']; ?>">
   </div>
   <div>
      <label>Parent</label>
      <input type="text" name="grParent" required="" value="<?php echo $grInfo['grParent']; ?>">
   </div>
   <div>
      <label>Description</label>
      <input type="text" name="grDesc" required="" value="<?php echo $grInfo['grDesc']; ?>">
   </div>
   <div>
   <?php if ($grInfo['edit_state'] == FALSE): ?>
      <div class="add_btn">
        <input type="submit" name="addGr" value="ADD GROUP">
      </div>
         
   <?php else: ?>
      <div class="edit_btn">
        <input type="submit" name="edGr" value="UPDATE">
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
      <th>GROUP<br>NAME</th>
      <th>GROUP<br>PARENT</th>
      <th>GROUP<br>DESCRIPTION</th>
      <th>GROUP<br>PERMISSION</th>
      <th>ACTION</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($uGroup as $row) : ?>
    <tr>
      <td><?php echo $row['grName']; ?></td>
      <td><?php echo $row['grParent']; ?></td>
      <td><?php echo $row['grDesc']; ?></td>
      <td><?php echo $row['user_perm_level']; ?></td>
      <td><a id="ed_btn" href="group.php?edit=<?php echo $row['grId']; ?>">Edit</a></td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>
<!-- <div style="margin-top:80px;"></div> -->
<br><br><br>
<?php include 'footer.php'; ?>