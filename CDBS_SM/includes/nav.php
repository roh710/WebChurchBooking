<?php if(isset($_SESSION['user_info'])): ?>
  <?php if ($_SESSION['uPermission']!="Admin"): ?>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="user_profile.php">My Profile</a></li>
        <li><a href="#">About CDBS</a>
          <ul>
            <li><a href="about_cdbs.kor.php">한글 사용방법</a></li>
            <li><a href="about_cdbs.eng.php">Eng Manual</a></li>
            <li><a href="version_table.php">Version Info</a></li>
          </ul>
        </li>
      </ul>
      </ul>
    </nav>
  <?php else: ?>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="user_profile.php">My Profile</a></li>
        <li><a href="#">Admin</a>
          <ul>
            <li><a href="reserv_pass.php">Rsv Dashboard</a></li>
            <li><a href="add_rm.php">Add/Edit Room</a></li>
            <li><a href="group.php">Add/Edit Group</a></li>
            <li><a href="user_list.php">User List</a></li>
            <!-- <li><a href="userConnDet.php">User Conn Det</a></li> -->
          </ul>
        </li>
        <li><a href="#">About CDBS</a>
          <ul>
            <li><a href="about_cdbs.kor.php">한글 사용법</a></li>
            <li><a href="about_cdbs.eng.php">Eng Manual</a></li>
            <li><a href="version_table.php">Version Info</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  <?php endif ?>
<?php else: ?>
    <nav>
      <ul>
         <li><a href="index.php">Home</a></li>
         <li><a href="index.php">About CDBS</a></li>
      </ul>
    </nav>
<?php endif ?>
