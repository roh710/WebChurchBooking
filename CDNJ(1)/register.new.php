<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require "includes/cdnj.inc.dbh.php";
require "header.php";

// $message = '';
// $msg = '';
// $uFirstName = "";
// $uLastName = "";
// $uKorName = "";
// $uTitle = "";
// $uName = "";
// $eMail = "";
// $cellPhone = "";
// $uGroup = "";
// $uPwd = "";

// $grResults = $conn->query("SELECT grId, grName FROM cdnj_group ORDER BY grName ASC"); // REVIEW: to be used for populating drop-down list

if (isset($_POST['submit'])) {
  $uFirstName = trim($_POST['uFirstName']);
	$uLastName = trim($_POST['uLastName']);
	$uKorName = trim($_POST['uKorName']);
  $uTitle = trim($_POST['uTitle']);
	$uName = trim($_POST['uName']);
	$eMail = trim($_POST['eMail']);
	$cellPhone = trim($_POST['cellPhone']);
	$uGroup = $_POST['uGroup'];
  $uPwd = password_hash($_POST['uPwd'], PASSWORD_BCRYPT);

  $sql = "SELECT 
    users.user_firstname, 
    users.user_lastname, 
    users.user_kor_name, u
    sers.user_name,
    users.user_email, 
    users.user_pwd, 
    cdnj_group.user_perm_level, 
    cdnj_group.grId, 
    cdnj_group.grName 
    FROM users
    JOIN cdnj_group
    ON users.user_group_fk = cdnj_group.grId 
    WHERE user_name = :user_name OR user_email = :user_email OR grId = :grId";

    $records = $conn->prepare($sql);
    $records->bindParam(':user_name', $_POST['uName']);
    $records->bindParam(':user_email', $_POST['eMail']);
    $records->bindParam(':grId', $_POST['grId']);
    $records->execute();
    $row = $records->fetch(PDO::FETCH_ASSOC);

  if ($row > 0) {
    header("refresh:3; url=./register.new.php");
    $msg = "The username: " . $_POST['uName'] . " or e-Mail: " . $_POST['eMail'] . " or Group: " . $row['grName'] . ", has been alredy Registered!";
    exit();
  } elseif ($_POST['uPwd'] != $_POST['confirm_uPwd']) {
    header("refresh:3; url=./register.new.php");
    $msg = "passwords <strong>DO NOT</strong> match";
    exit;
  }
}

// Enter the new user in the database
	// $uFirstName = trim($_POST['uFirstName']);
	// $uLastName = trim($_POST['uLastName']);
	// $uKorName = trim($_POST['uKorName']);
  // $uTitle = trim($_POST['uTitle']);
	// $uName = trim($_POST['uName']);
	// $eMail = trim($_POST['eMail']);
	// $cellPhone = trim($_POST['cellPhone']);
	// $uGroup = $_POST['uGroup'];
	// $uPwd = password_hash($_POST['uPwd'], PASSWORD_BCRYPT);

	$sql = "INSERT INTO users
  (user_firstname,
  user_lastname,
  user_email,
  cellPhoneNum,
  user_group_fk,
  user_kor_name,
  user_title,
  user_name,
  user_pwd)
	VALUES
	(:user_firstname,
  :user_lastname,
  :user_email,
  :cellPhoneNum,
  :user_group_fk,
  :user_kor_name,
  :user_title,
  :user_name,
  :user_pwd)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':user_firstname', $uFirstName);
	$stmt->bindParam(':user_lastname', $uLastName);
	$stmt->bindParam(':user_email', $eMail);
	$stmt->bindParam(':cellPhoneNum', $cellPhone);
	$stmt->bindParam(':user_group_fk', $uGroup);
	$stmt->bindParam(':user_kor_name', $uKorName);
  $stmt->bindParam(':user_title', $uTitle);
	$stmt->bindParam(':user_name', $uName);
	$stmt->bindParam(':user_pwd', $uPwd);

	if($stmt->execute()) {
		header("refresh:3; url=./index.php");
    $msg = "Successfully created new user";

    } else {
    // header("refresh:3; url=./register.new.php");
    $msg = "Something went wrong - User account not created!";

	}

if (isset($_SESSION['user_info'])) {
    header("location: ./index.php");
    exit;
} else {
  $grResults = $conn->query("SELECT grId, grName FROM cdnj_group WHERE user_perm_level='User' ORDER BY grName ASC"); // REVIEW: to be used for populating Group-list drop-down list
}
?>

<body>
  <div class="input-form">
    <form action="register.new.php" method="POST">
    <h3 class="msg"><?php echo $msg ?></h3>
    <h3>사용자 등록</h3>
      <div>
        <label for="uFirstName">이름/성(영문):</label>
        <input class="input-form input-style1" type="text" id="uFirstName" name="uFirstName" pattern="[a-zA-Z\-]+" autofocus required="" autocomplete="off">
        <input class="input-form input-style1" type="text" name="uLastName" value="<?php $uFirstName ?>" pattern="[a-zA-Z\-]+" required="" autocomplete="off">
      </div>
      <div>
        <label for="uKorName">이름/직분:</label>
        <input class="input-form input-style1" type="text" id="uKorName" name="uKorName" pattern="[가-힣]+" required="" autocomplete="off">
        <input class="input-form input-style1" type="text" name="uTitle" pattern="[가-힣]+" required="" autocomplete="off">
      </div>
      <div>
        <label for="uName">유저네임:</label>
        <input type="text" name="uName" id="uName" pattern="(?=^.{6,}$)^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" title="Must be atleast six character in length, consisting lettes and/or numbers only" required="" autocomplete="off">
      </div>
      <div>
        <label for="eMail">이메일:</label>
        <input type="text" name="eMail" id="eMail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required="" autocomplete="off">
      </div>
      <div>
        <label for="cellPhone">휴대전화:</label>
        <input type="text" name="cellPhone" id="cellPhone" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" required="" autocomplete="off">
      </div>
      <div>
        <label for="uGroup">소속그룹:</label>
        <select name="uGroup" id="uGroup" required="">
          <!-- Below: "selected" attribute will show initial value and "hidden" attribute will hide from options -->
          <option selected hidden value=''>Select Group</option>";
            <?php
              while ($grResult = $grResults->fetch(PDO::FETCH_ASSOC)) {
              $grId = $grResult['grId'];
              $grName = $grResult['grName'];
              echo "<option value='$grId'>$grName</option>";
              // var_dump($grId);
              }
            ?>
          </option>
        </select>
      </div>
      <div>
        <label for="uPwd">암호:</label>
        <input type="password" name="uPwd" id="uPwd" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must be atleast six characters and must contain atleast one upper case and, one number or special character(s)" required="" autocomplete="off">
      </div>
      <div>
        <label for="confirm_uPwd">암호반복:</label>
        <input type="password" name="confirm_uPwd" id="confirm_uPwd" required="" autocomplete="off">
      </div>
      <div class="add_btn">
        <input type="submit" name="submit" value="REGISTER">
      </div>
    </form>
  </div>
</body>

<?php include 'footer.php'; ?>