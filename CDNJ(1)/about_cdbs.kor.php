<?php
  include 'header.php';
?>
<div class="about1" id="top">
  <a href="about_cdbs.eng.php">English</a>
</div>

<div class="about">
   <h1>참된교회 부킹시스템 사용방법 (CDBS)</h1>
</div>

<?php if (!empty($_SESSION['uPermission'])): ?>
  <?php if ($_SESSION['uPermission'] == 'Admin'): ?>
    <div class="about-bkmk">
      <ul>
        <li class="about-bkmk1"><h5><a href="#top">쪽 상단</a></h5></li>
        <li class="about-bkmk2"><h5><a href="#booking">예약 방법</a></h5></li>
        <li class="about-bkmk3"><h5><a href="#profile">내 프로필</a></h5></li>
        <li class="about-bkmk4"><h5><a href="#dboard">예약 대시보드</a></h5></li>
        <li class="about-bkmk5"><h5><a href="#room">방(위치) 추가/편집</a></h5></li>
        <li class="about-bkmk6"><h5><a href="#group">그룹 추가/편집</a></h5></li>
        <li class="about-bkmk7"><h5><a href="#userlist">사용자 명단</a></h5></li>
      </ul>
    </div>
  <?php else: ?>
    <div class="about-bkmk">
      <ul>
        <li class="about-bkmk1"><h5><a href="top">쪽 상단</a></h5></li>
        <li class="about-bkmk2"><h5><a href="#booking">예약 방법</a></h5></li>
        <li class="about-bkmk3"><h5><a href="#profile">내 프로필</a></h5></li>
      </ul>
    </div><br>
  <?php endif ?>
<?php else: ?>
  <?php header('location: ./index.php'); ?>
<?php endif ?>

<div class="about">
  <p>본 웹사이트는 뉴저지 참된교회의 부킹 시스템(CDBS)으로써 교내의 여러 부서의 본당/친교 실/방 등, 교내의 모든 장소를 공유함으로써 원활하고 효율적인 활동을 위하여 제작된 웹사이트입니다.</p><br>
  <p><strong>CDBS</strong>는 참된교회에 등록된 교인들을 위한 웹사이트이며, 참된교회에 각 부서장에게 아이디가 주어지며, 동시에 일반 성도들도 접속이 가능합니다.</p>
</div><br>

<div class="about">
  <p><strong>본 웹사이트 사용 방법은 아래를 참고 바랍니다.</strong></p><br>
  <p><strong>예약 승인 여부: </strong>접속 즉시 확인 가능. 예약상태 확인을 위해서 로그인은 필요하지 않습니다.</p>
</div><br>

<div class="about">
  <p><strong>제공된 아이디가 있을 시:</strong></p>
  <ul>
    <li>우측 상단에 위치한 'LOGIN' 링크를 선택합니다.</li>
    <li>LOGIN 창이 나오면 아이디와 암호를 입력한 후, LOGIN 버튼을 누릅니다.</li>
    <li>LOGIN에 성공했을 시, 우측 상단에 성도의 이름, 직분, 소속부서 등, 성도 정보와 함께 모든 신청사항 및 승인 여부를 메인 화면에서 확인할 수 있습니다.</li>
    <li>웹사이트 상단에 위치한 <strong>메뉴바</strong>는 <strong>'Home' (홈), 'My Profile' (내 프로필), 'About CDBS' (부킹 사이트에 대하여)</strong> 순서로 나열되어 있습니다.</li>
    <ul>
      <li><strong>홈: </strong>홈페이지로 이동. (LOGIN 후, 동일화면)</li>
      <li><strong>내 프로필: </strong>프로필 페이지로 이동/프로필 수정/암호 변경.</li>
      <li><strong>부킹 사이트에 대하여:</strong> 세 개의 하위 메뉴.</li>
      <ol>
        <li><strong>한글 사용법:</strong> 이 곳으로 이동.</li>
        <li><strong>Eng Manual:</strong> 영어 사용법.</li>
        <li><strong>Version Info:</strong> 버전 정보 및 출시일.</li>
      </ol>
    </ul>
  </ul>
</div>

<div class="about" id="booking">
  <p><strong>예약 방법:</strong></p>
    <ol>
      <li>로그인 후, 첫 화면 예약 폼(Form), 또는 'Home' 메뉴에서:</li>
      <li>모든 예약정보를 입력하십시오.</li>
      <li>방/위치 입력란은 '방 이름 -- [위치 - 최대 수용인원] *🡬 피아노 유/무', 순서로 나열되어 있습니다.</li>
      <img src="assets/img/input_img2.png" alt="">
      <br>
      <li>시작 시간과 종료 시간은 최소 15분 간격으로 예약 가능합니다. 예: "시작/종료 시간: 9:00 AM - 9:15 AM"</li>
      <li>모든 입력란에 필요한 정보를 아래 예와 같이 입력한 후, '예약' 버튼을 눌러주십시오.</li>
      <img src="assets/img/input_img3.png" alt="">
  <div class="about-wide">
    <li>아래와 같이 '# 개의 예약 충돌이 발견되었습니다!' 메시지가 화면에 표시되었을 시, 예약은 안 되었으며 충돌사항 확인 후, 충돌사항을 피하여 다시 예약해야 합니다.</li>
    <img src="assets/img/input_img4.png" alt="">
  </div>
    <li>아래와 같이 '예약되었습니다!' 메시지가 화면에 표시되었을 때, 성공적으로 예약이 되었습니다. 예약사항은 동일 화면 하단의 예약 목록에서 확인 가능하며, 'Status(예약상태)'는 'Pending(승인 대기)'로 표시될 것입니다. 변경사항이 있을 시, 사용자 예약사항에 제한되어 편집 가능합니다. 예약상태는 관리자가 'Approve(승인)'할 때까지 'Pending(승인 대기)' 상태로 표시될 것입니다.</li>
    <img src="assets/img/input_img5.png" alt="">
  <div class="about-wide2">
    <li>아래와 같이 'Action'란에 'EDT' 버튼과 'DEL' 버튼이 있습니다. 편집을 위해서는 'EDT'를 선택, 'DEL'을 선택하면 예약이 삭제됩니다. 편집 전 'Approved(승인)' 된 상태라면, 편집 후 'Pending(승인 대기)' 상태로 전환됩니다.</li>
    <img src="assets/img/input_img6.png" alt="">
  </div> 
      <li>편집이 성공적으로 이루어졌다면, 아래와 같이 '예약이 변경되었습니다!'라는 메시지가  화면에 표시됩니다.</li>
      <img src="assets/img/input_img7.png" alt="">
    </ol>
</div>

<div class="about" id="profile">
<p><strong>My Profile 메뉴 - 내 프로필:</strong></p>
  <ol>
    <li>프로필 화면은 자신의 프로필을 편집/암호변경 할 수 있습니다.</li>
    <li>프로필 화면은 아래와 같습니다.</li>
<div class="about-wide3">
    <img src="assets/img/input_img8.png" alt="">
    <li>프로필 화면의 하단에 위치한 'UPDATE'를 누르면 아래와 같이 프로필 편집 화면이 발생합니다.</li>
    <img src="assets/img/input_img9.png" alt="">
</div>
    <li>프로필의 모든 정보는 편집 가능하며 암호를 교체할 경우, 암호는 최소 영문/숫자 6자 이상으로 형성된 암호이어야 하며, 동시에 대문자 1개 이상, 숫자 또는 특수문자 1개 이상으로 형성되어야 합니다. '암호반복'은 '암호'에 입력한 동일한 암호를 반복하여 입력해 주십시오.</li>
    <li>변경하고자 하는 모든 정보를 새 정보로 교체한 후, 하단의 '편집' 버튼을 눌러서 확인하면, 개인 정보가 업데이트 될 것이며, '프로필이 성공적으로 업데이트 되었습니다!'란 메시지와 함께 '유저네임 또는 소속그룹이 변경되었을 경우, 다시 로그아웃/로그인해 주십시오.'란 메시지도 동시에 화면에 표시될 것입니다.</li>
  </ol>
</div><br>

<?php if ($_SESSION['user_group'] == 'Admin'): ?>
  <div class="about-admin">
    <h1>Admin: 네 개의 하위 메뉴</h1>
  </div>
<div class="about-admin" id="dboard">
<p><strong>'Rsv Dashboard' - 예약 대시보드 메뉴:</strong></p>
  <ol>
    <li>Rsv Dashboard: 본 메뉴항목은 아래와 같이 관리자가 '예약'을 할수 있으며, 또는 '편집', '삭제', '승인' 혹은 '승인대기' 할수 있습니다.</li>
    <img src="assets/img/admin_menu_1.png" alt="">
    <div class="about-wide2">
      <li>예약하고자 할 경우, 'Rsv Dashboard'에서, 모든 예약정보를 'BOOK FORM' 입력한 후,  하단에 "BOOK" 버튼을 선택하십시오.</li>
      <img src="assets/img/admin_menu_2.png" alt="">
    </div>

    <div class="about-wide">
      <li>'편집 (EDT)', '삭제 (DEL)', '승인 (APR)' 또는 '승인대기 (DAP)'를 하기위하여, 아래와 같이 해당 버튼을 선택해 주십시오.</li>
      <img src="assets/img/admin_menu_3.png" alt="">
  </ol>
</div>

<div class="about-admin" id="room">
<p><strong>'Add/Edit Room' - 방(위치) 추가/편집 메뉴:</strong></p>
  <ol>
    <li>'Add/Edit Room'(방(위치) 추가/편집)로 가려면, 아래와 같이 'Admin'에서 'Add/Edit Room'을 선택하십시오.</li>
    <img src="assets/img/admin_menu_4.png" alt="">
    <div class="about-wide2">
    <li>'방/위치' 추가를 하려면, 아래와 같이 'ADD ROOM FORM'에서 모든 방 정보를 입력한 후, 하단에 위치한 'ADD ROOM'버튼을 선택해 주십시오.</li>
    <img src="assets/img/admin_menu_5.png" alt="">
    </div>

    <div class="about-wide">
    <li>'방/위치' 편집을 하려면, 아래와 같이 'EDIT'버튼을 선택한 후, 교체해야할 방/위치 정보를 수정한 후, 하단에 위치한 'UPDATE'버튼을 선택해 주십시오.</li>
    <img src="assets/img/admin_menu_6.png" alt="">
    </div>
  </ol>
</div>
  
<div class="about-admin" id="group">
<p><strong>'Add/Edit Group' - 그룹 추가/편집 메뉴:</strong></p>
  <ol>
    <li>'Add/Eit Group' 메뉴 항목으로 가려면, 아래와 같이 'Admin'에서 'Add/Edit Group'을 선택하십시오.</li>
    <img src="assets/img/admin_menu_7.png" alt="">
    <div class="about-wide2">
      <li>'그룹'을 추가를 하려면, 아래와 같이 'ADD GROUP FORM'에서 모든 그룹 정보를 입력한 후, 하단에 위치한 'ADD GROUP'버튼을 선택해 주십시오.</li>
      <img src="assets/img/admin_menu_8.png" alt="">
    </div>

    <div class="about-wide">
      <li>'그룹'을 편집을 하려면, 아래와 같이 'EDIT'버튼을 선택한 후, 교체해야할 그룹 정보를 수정한 후, 하단에 위치한 'UPDATE'버튼을 선택해 주십시오.</li>
      <img src="assets/img/admin_menu_9.png" alt="">
    </div>
  </ol>
</div>

<div class="about-admin" id="userlist">
<p><strong>'User List' - 유저명단 메뉴:</strong></p>
  <ol>
    <li>"User List"(유저명단) 메뉴 항목으로 가려면, 아래와 같이 'Admin'에서 'User List'를 선택하십시오.</li>
    <img src="assets/img/admin_menu_10.png" alt="">
    <li>'# of Login(s)'(로그인 수) 및 'ChgPwd'(암호교체), 'Del'(사용자 삭제)을 위하여, 아래와 같이 해당 버튼을 선택하십시오.</li>
    <img src="assets/img/admin_menu_11.png" alt="">
    <div class="about-wide2">
      <li>암호교체를 위해서, 위와 같이 'ChgPwd' 버튼을 선택한 후, 뒤에 따르는 UI의 설명대로 진행하십시오.</li>
      <img src="assets/img/admin_menu_12.png" alt="">
    </div>
  </ol>
</div>
<?php endif ?>

<br><br>
<?php include 'footer.php'; ?>