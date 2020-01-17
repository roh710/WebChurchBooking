<?php 
  include 'header.php';
?>
<div class="about1" id="top"></div>
<div class="about">
  <h1>How to use Cham Doen Booking System (CDBS)</h1>
</div>

<?php if (!empty($_SESSION['uPermission'])): ?>
  <?php if ($_SESSION['uPermission'] == 'Admin'): ?>
    <div class="about-bkmk">
      <ul>
        <li class="about-bkmk1"><h5><a href="#top">Top of Page</a></h5></li>
        <li class="about-bkmk2"><h5><a href="#booking">How to Book</a></h5></li>
        <li class="about-bkmk3"><h5><a href="#profile">My Profile</a></h5></li>
        <li class="about-bkmk4"><h5><a href="#dboard">Rsv Dashboard</a></h5></li>
        <li class="about-bkmk5"><h5><a href="#room">Add/Edit Room</a></h5></li>
        <li class="about-bkmk6"><h5><a href="#group">Add/Edit Group</a></h5></li>
        <li class="about-bkmk7"><h5><a href="#userlist">User List</a></h5></li>
      </ul>
    </div><br>
  <?php else: ?>
    <div class="about-bkmk">
      <ul>
        <li class="about-bkmk1"><h5><a href="#top">Top of Page</a></h5></li>
        <li class="about-bkmk2"><h5><a href="#booking">How to Book</a></h5></li>
        <li class="about-bkmk3"><h5><a href="#profile">My Profile</a></h5></li>
      </ul>
    </div><br>
  <?php endif ?>
<?php else: ?>
  <?php header('location: ./index.php'); ?>
<?php endif ?>

<div class="about">
  <p>This website is the Booking System for Cham-Doen Presbyterian Church in New Jersey(<strong>CDBS</strong>). CDBS is designed to book various rooms, sanctuary and various locations, within the property of Cham-Doen Presbyterian Church for diverse groups to manage and administer the locations in an effective manner.</p><br>
  <p><strong>CDBS</strong> is a website for its members, and the leaders of each group will have access to this website through login.</p>
</div><br>

<div class="about">
  <p><strong>Below are the instructions on how to use this website.</strong></p><br>
  <p><strong>Booking approval: </strong>The approval status will appear as soon as you're connected to CDBS.  No login is necessary to view Booking status.</p>
</div><br>

<div class="about">
  <p><strong>If you have access to ID:</strong></p>
  <ul>
    <li>Select the "Login" link in the upper-right hand corner of CDBS.</li>
    <li>When the log-in page appears, login using you're ID, password and click the LOGIN button.</li>
    <li>If you are successful, you'll be greeted with your name, your group name, your title, etc. The information will appear in the upper right-hand corner of CDBS, and the scheduled room booking information will appear in the main section of CDBS.</li>
    <li>Located on top of CDBS is a <strong>Menu-bar</strong> consisting: <strong>"Home", "My Profile"</strong> and <strong>"About CDBS"</strong>.</li>
    <ul>
      <li><strong>Home: </strong>Move to the Home page. (The same screen after a LOGIN.)</li>
      <li><strong>My Profile: </strong>Move to My Profile/Update profile/Change password.</li>
      <li><strong>About CDBS:</strong> Three sub-menus.</li>
      <ol>
      <li><strong>한글 사용법:</strong> Korean instruction.</li>
      <li><strong>Eng Manual:</strong> Move to this page.</li>
      <li><strong>Version Info:</strong> Information about Version and release date.</li>
      </ol>
    </ul>
  </ul>
</div><br>

<div class="about" id="booking">
  <p><strong>Booking direction:</strong></p>
    <ol>
      <li>At the first screen, after a LOGIN or at the "Home" menu:</li>
      <li>Input all required fields.</li>
      <li>At ROOM/LOC field, the items in the drop-down list are arranged in the following manner - "Room Name -- [Location - Max Allowed persons] *🡬 Presence of piano".</li>
      <img src="assets/img/input_img2.png" alt=""><br>
      <li>A booking may be made every 15 minutes. For example, "시작/종료 시간: 9:00 AM - 9:15 AM".</li>
      <li>Please enter all required fields and click the "예약" button as shown below.</li>
      <img src="assets/img/input_img3.png" alt=""><br>
    <div class="about-wide">
      <li>If the user receives a conflict message "#개의 예약 충돌이 발견되었습니다!" as below, the user must book again, not conflicting with the details of the conflict message.</li>
      <img src="assets/img/input_img4.png" alt=""><br>
    </div>
      <li>As shown below, if your screen shows "예약되었습니다!" message, you have successfully booked an event. The details of booking should be populated below the same screen with a "Pending" status. You are permitted to make changes, limited to your booking only. The booking status will display "Pending" until the administrator approves the booking.</li>
      <img src="assets/img/input_img5.png" alt="">
    <div class="about-wide2">
      <li>To be placed in an "EDIT" mode, there are two buttons "EDT" and "DEL" respectably in the "Action" column, as shown below. Select "EDT" to be placed in an "EDIT" mode and select "DEL" to Delete the booking. In the "EDIT" mode, the status will revert to the "Pending" state as shown below, if previously "Approved".</li>
      <img src="assets/img/input_img6.png" alt="">
    </div>
    <li>In the "Update" mode, after a successful update, the message will be displayed as "예약이 변경되었습니다!", as shown below.</li>
    <img src="assets/img/input_img7.png" alt="">
    </ol>
</div>

<div class="about" id="profile">
  <p><strong>Profile:</strong></p>
  <ol>
    <li>In the Profile screen, you may edit your profile and/or change your password.</li>
    <li>The Profile screen is as follows.</li>
  <div class="about-wide3">
    <img src="assets/img/input_img8.png" alt="">
    <li>If you click on the "UPDATE" on the bottom of your profile, The Profile Edit screen will populate as shown below.</li>
    <img src="assets/img/input_img9.png" alt="">
  </div>
    <li>You may update all your information in your profile and if you are updating your password along with other profile information, the password must consist of any combination of at least six alphabets and numbers and must contain at least one upper-case letter and at least one number or special character. At "암호반복", you must repeat the password exactly as you have entered at "암호".</li>
    <li>You may change all the information and click the '편집' button to update your profile. If the update is successful, you will be greeted with a message '프로필이 성공적으로 업데이트 되었습니다!'. If you change your user name and/or group, you must LOGOUT/LOGIN again to personal information changes to take effect.</li>
  </ol>
</div><br>

<?php if ($_SESSION['uPermission'] == 'Admin'): ?>
  <div class="about-admin">
    <h1>Admin: 4 sub-menus</h1>
  </div>
<div class="about-admin" id="dboard">
<p><strong>"Rsv Dashboard" Menu:</strong></p>
  <ol>
    <li>Rsv Dashboard: Reservation Dashboard where Admin can "Book", "Edit", "Delete", "Approve" or "Disapprove" the reservations, as shown below.</li>
    <img src="assets/img/admin_menu_1.png" alt="">
    <div class="about-wide2">
      <li>To book a room in "Rsv Dashboard", simply fill in all fields in "BOOK FORM" and select "BOOK" button.</li>
      <img src="assets/img/admin_menu_2.png" alt="">
    </div>

    <div class="about-wide">
      <li>To "Edit", "Delete", "Approve" or "Disapprove", simply select appropiate button and press, as shown below.</li>
      <img src="assets/img/admin_menu_3.png" alt="">
  </ol>
</div>

<div class="about-admin" id="room">
<p><strong>"Add/Edit Room" Menu</strong></p>
  <ol>
    <li>To go to "Add/Eit Room" menu item, go to "ADMIN" and select "Add/Edit Room", as shown below.</li>
    <img src="assets/img/admin_menu_4.png" alt="">
    <div class="about-wide2">
    <li>To add a room, fill in all fields and select "ADD ROOM", as shown below.</li>
    <img src="assets/img/admin_menu_5.png" alt="">
    </div>

    <div class="about-wide">
    <li>To edit a room, select the "EDIT" button, as shown below. In the pre-populated form "EDIT ROOM FORM", replace all information that need to be replaced and select "UPDATE" button.</li>
    <img src="assets/img/admin_menu_6.png" alt="">
    </div>
  </ol>
</div>
 
<div class="about-admin" id="group">
<p><strong>"Add/Edit Group" Menu</strong></p>
  <ol>
    <li>To go to "Add/Eit Group" menu item, go to "ADMIN" and select "Add/Edit Group", as shown below.</li>
    <img src="assets/img/admin_menu_7.png" alt="">
    <div class="about-wide2">
      <li>To add a group, fill in all fields and select "ADD GROUP", as shown below.</li>
      <img src="assets/img/admin_menu_8.png" alt="">
    </div>

    <div class="about-wide">
      <li>To edit a group, select the "EDIT" button, as shown below.</li>
      <img src="assets/img/admin_menu_9.png" alt="">
    </div>
  </ol>
</div>

<div class="about-admin" id="userlist">
<p><strong>"User List" Menu</strong></p>
  <ol>
    <li>To go to "User List" menu item, go to "ADMIN" and select "User List", as shown below.</li>
    <img src="assets/img/admin_menu_10.png" alt="">
    <li>To view "# of Login(s)", "Change Password" or "Delete a user", click on the appropriate button, as shown below.</li>
    <img src="assets/img/admin_menu_11.png" alt="">
    <div class="about-wide2">
      <li>To Change password, click on the "ChgPwd" button, as shown above and follow instructions in the UI that follows, as shown below.</li>
      <img src="assets/img/admin_menu_12.png" alt="">
    </div>
  </ol>
</div>
<?php endif ?>

<br><br>
<?php include 'footer.php'; ?>