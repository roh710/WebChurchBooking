<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require "header.php";
require "includes/cdnj.inc.dbh.php";

if (isset($_SESSION['user_info'])) {
    header("location: ./index.php");
    exit;
} else {
  $grResults = $conn->query("SELECT grId, grName FROM cdnj_group WHERE user_perm_level='User' ORDER BY grParent, grName ASC"); // REVIEW: to be used for populating Group-list drop-down list

}
?>
<body>
  <div class="input-form">
    <form action="includes/register.inc.php" method="POST">
    <h3>사용자 등록</h3>
      <div>
        <label for="uFirstName">이름/성(영문):</label>
        <input class="input-form input-style1" type="text" id="uFirstName" name="uFirstName" pattern="[a-zA-Z\-]+" autofocus required="" autocomplete="off">
        <input class="input-form input-style1" type="text" name="uLastName" pattern="[a-zA-Z\-]+" required="" autocomplete="off">
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
        <input type="password" name="uPwd" id="uPwd" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must be at least six characters and must contain atleast one upper case and, one number or special character(s)" required="" autocomplete="off">
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