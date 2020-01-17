<?php
require 'includes/functions.inc.cdbs.php';
require "includes/cdnj.inc.dbh.php";
require "includes/common.php";

$rmList = rmList();
$grList = grList();

// Below checks if addPermEvent button and the array 'wkday' is set
if (isset($_POST['addPermEvent'])) {
  // Initialize $wkDayBit
  $wkDayBit = 0;

  // Assign array 'wkday' to $tempWk
  $tempWk = $_POST['wkday'];

  // Loop through the newly assigned $tempWk using foreach loop
  foreach($tempWk as $row => $value) {
    $wkDayBit = $wkDayBit + $value;
  }

  // Call function $insPermEvent() to insert record to Tbl perm_events from input form.
  // insPermEvent($wkDayBit);
}

// Query all data from tbl perm_events and assign the values to the variable $permEvts
$permEvts = qryPermEvent();

foreach ($permEvts as $key => $value) {
  $weekday_bit = 0;

  if ($value['eventStDate'] == "0000-00-00") {
    $stDate = date('Y-m-d');
    $endDate = date('Y-m-d', strtotime('+4 weeks'));

  } else {
    $stDate = $value['eventStDate'];
    $endDate = $value['eventEndDate'];

  }
  $event_id = $value['event_id'];
  $permEvTtl = $value['eventName'];
  $rmIdFk = $value['rmIdFk'];
  $wkDayBit = $value['wkDayBit'];
  $grIdFk = $value['grIdFk'];
  $stTime = $value['eventStTime'];
  $endTime = $value['eventEndTime'];
  $rsvStat = $value['rsvStat'];

  $days = array('Sun','Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

  //Initialise an array for storing the converted bit representation
  $newdays = array();

  // Convert the bitwise integer to an array
  for($i=0; $i<7; $i++) {
    $daybit = pow(2,$i);
    if ($wkDayBit & $daybit) { // Bits that are set in both $a and $b are set.
      $newdays[]=$days[$i];
    }
  }

  // below echoes out the title of events
  echo "<br><br>Event Title: " . $permEvTtl . "<br>";

  // Echoes out the date bits checked
  for($i=0; $i<7; $i++) {
    $daybit = pow(2,$i);
    if ($wkDayBit & $daybit) { // Bits that are set in both $a and $b are set.
      echo $days[$i] . " => " . ($wkDayBit & $daybit) . "<br>"; // echoes out the actual matches. Ex: Tue => 4, Thu => 16
    }
  }

  // Call funtion dateRange($stDate, $endDate) and assign the return values to $result.
  $result = dateRange($stDate, $endDate);

  // Below echoes out the sum of array $tempWk.
  echo "Total wkDayBit: " . $wkDayBit . "<br>";

  // echo out the checked weekdays
  echo 'Checked Weekday(s): ' . implode($newdays,", ") . "," . "<br>";

  echo  "Date Range: " . $stDate." to ".$endDate."<br>";

  // Checks if a value exists in an array 
  // syntax: in_array( mixed $needle , array $haystack [, bool $strict ]): bool
  foreach ($result as $v) {
    if (in_array(date('D', strtotime($v)),$newdays)) {
      $permEvt = [
        // "eventId"   => $event_id,
        "eventDate" => $v,
        "eventName" => $permEvTtl,
        "stTime"    => $stTime,
        "endTime"   => $endTime,
        "wkDay"     => date('D', strtotime($v)),
        "rmIdFk"    => $rmIdFk,
        "grIdFk"    => $grIdFk,
        "eventStat" => $rsvStat
      ];

      $prmEvtArray[] = $permEvt;

      echo "<pre>";
      print_r($permEvt);
      echo "</pre>";
    }
  }
}
echo "<pre>";
print_r($prmEvtArray);
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="chrome">
  <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <title>Strawberry's Codes</title>
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