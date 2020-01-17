<?php
require 'includes/functions.inc.cdbs.php';
require "includes/cdnj.inc.dbh.php";
require "includes/common.php";

// Call functions rmList() and grList() for the dropdown menu in input form.
$rmList = rmList();
$grList = grList();

// Call function $insPermEvent() to insert record to Tbl perm_events from input form.
insPermEvent();

// Call function asgnEvts() to assign individual events to the variable $asgnEvts
$asgnEvts = asgnEvts();

// date('D', strtotime($v)) <= Returns wkday of $v
// echo date('D'); // <= Returns "Thu"
// Loop thru the variable $asgnEvts
foreach ($asgnEvts as $key => $value) {
  echo "<pre>";
  print_r($value);
  echo "</pre><br>";
}
// echo $asgnEvts[1][0]; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="chrome">
  <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <title>Permanent Events Test Codes</title>
</head>
<body>
<div class="permEvent-form">
  <form method="POST">
  <div>
    <label for="permEvTtl">Perm Event Title:</label>
    <input type="text" name="permEvTtl" id="permEvTtl" required><br>
    <label for="rmReserv">Room/Loc</label>
      <select name="rmReserv" id="rmReserv" required oninvalid="setCustomValidity('방 이름을 목록에서 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
        <option selected hidden value="">----------- Select Room -----------</option>
        <?php foreach ($rmList as $row) : ?>
          <option value="<?php echo escape($row["rmId"]); ?>">
          <?php echo escape($row["rmName"]); ?>
          <?php echo escape(' -- [' . $row["rmLocation"] . ' - ' . $row["rmMaxPersons"]). ']'; ?>
          <?php echo escape($row["rmPiano"] > 0 ? '*':''); ?>
        <?php endforeach; ?>
      </select>
    <!-- <label for="sat">Description</label> -->
    <!-- <input type="range" $start = "0", $end="100", step="5" name="" id=""> -->
  </div>
  <div>
  <label for="stDate">Start Date</label>
  <input type="date" name="stDate" id="stDate">
  <label for="endDate">End Date</label>
  <input type="date" name="endDate" id="endDate">
  </div>
  <div>
    <label for="stTime">Start Time</label>
    <input type="time" name="stTime" id="stTime" required>
    <label for="endTime">End Time</label>
    <input type="time" name="endTime" id="endTime" required>
  </div>
  <div>
    <label for="userGr">User Group:</label>
    <select name="userGr" id="grList" required oninvalid="setCustomValidity('소속그룹을 선택해주세요!')" onchange="try{setCustomValidity('')}catch(e){}" />
    <option selected hidden value="">----------- Select Group -----------</option>
      <?php foreach ($grList as $grResult) : ?>
    <option value="<?php echo escape($grResult['grId']); ?>">
      <?php echo escape($grResult["grName"]); ?></option>
      <?php endforeach; ?>
  </select>
  </div>
  <div>
    <input type="checkbox" name="wkday[]" id="sun" value="1">
    <label for="sun">Sun</label>
    <input type="checkbox" name="wkday[]" id="mon" value="2">
    <label for="mon">Mon</label>
    <input type="checkbox" name="wkday[]" id="tue" value="4">
    <label for="tue">Tue</label>
    <input type="checkbox" name="wkday[]" id="wed" value="8">
    <label for="wed">Wed</label>
    <input type="checkbox" name="wkday[]" id="thu" value="16">
    <label for="thu">Thu</label>
    <input type="checkbox" name="wkday[]" id="fri" value="32">
    <label for="fri">Fri</label>
    <input type="checkbox" name="wkday[]" id="sat" value="64">
    <label for="sat">Sat</label>
  </div><br>
  <div class="add_btn">
    <input type="submit" name="addPermEvent" value="ADD PERM EVENT">
  </div>
  </form>
</div>
    
</body>
</html>