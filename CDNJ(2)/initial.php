<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include './header.php';
include 'includes/initial.inc.php';
if (!isset($_SESSION['user_info'])) {
  exit;
}
?>
<!-- // Start View -->
<?php if (isset($_GET['ed'])): ?>
<!--  Edit  -->

<div class="reserv-form">
  <form class="reserv-form" method="POST">
    <h3>input/Update Form</h3>
  <input type="hidden"  name="rmID" value="<?php echo $reservation['reservID']; ?>">
  <div>
    <label for="rmReserv">Room Name</label>
    <select name="rmReserv">
        <option value="">--Select Room--</option>
        <?php foreach ($rooms as $row) : ?>
           <option value="<?php echo escape($row["rmId"]); ?>" <?php echo $row["rmId"] == $reservation["rmReserv"] ? 'selected':''?>>
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
       <input type="time" name="reservTime" value="<?php echo $reservation["reservTime"]; ?>">
       <label for="endTime">Ending Time</label>
       <input type="time" name="endTime" value="<?php echo $reservation["endTime"]; ?>">
       </div>
    <div>
       <label for="reservPurpose">Purpose</label>
       <input type="text" name="reservPurpose" value="<?php echo $reservation["reservPurpose"]; ?>">
       </div>
    <div>
       <input class="edit_btn" type="submit" name="update" value="UPDATE">
    </div>
  </form>
</div>
<?php else: ?>
<!--  create -->

<div class="reserv-form">
  <form class="reserv-form" method="POST">
    <h3>input/Update Form</h3>
    <div>
      <label for="rmReserv">Room Name</label>
      <select name="rmReserv">
          <option selected hidden value="">--Select Room--</option>
          <?php foreach ($rooms as $row) : ?>
             <option value="<?php echo escape($row["rmId"]); ?>"><?php echo escape($row["rmName"]); ?></option>
          <?php endforeach; ?>
      </select>
    </div>
    <div>
       <label for="reservDate">Reservation Date</label>
       <input type="date" name="reservDate">
       </div>
    <div>
       <label for="reservTime">Start Time</label>
       <input type="time" name="reservTime">
       <label>Ending Time</label>
       <input type="time" name="endTime">
       </div>
    <div>
       <label for="reservPurpose">Purpose</label>
       <input type="text" name="reservPurpose">
       </div>
    <div>
       <input class="edit_btn" type="submit" name="create" value="RESERVE">
    </div>
  </form>
</div>
<?php endif; ?>

<div class="reserv-title">
	<h2>Reservation List</h2>
</div>
<div class="reserv-table">
  <table>
      <thead>
          <tr>
              <th>Date</th>
              <th>Room</th>
              <th>Time Reserved</th>
              <th>Time Ending</th>
              <th>Group</th>
              <th>Status</th>
              <th colspan=2>Action</th>
           </tr>
      </thead>
      <tbody>

    <!-- loop through rm_reserved VIEW to populate Reservation table -->
      <?php foreach ($reservations as $row) : ?>
          <tr>
              <td><?php echo escape($row["reservDate"]); ?></td>
              <td><?php echo escape($row["rmName"]); ?></td>
              <td><?php echo escape($row["reservTime"]); ?></td>
              <td><?php echo escape($row["endTime"]); ?></td>
              <td><?php echo escape($row["grName"]); ?></td>
              <td><?php echo escape($row["status"]); ?></td>
              <td><a id="ed_btn" href="index.php?ed=<?php echo escape($row["reservID"]); ?>">Edit</a></td>
              <td><a id="de_btn" href="initial.php?del=<?php echo escape($row["reservID"]); ?>">Del</a></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
</div>
