<?php
   require 'header.php';

   if (isset($_SESSION['user_info'])) {
     include 'initial.php';
   } else {
     include 'unreg_user.php';
   }
  // <div style="margin-top: 55px;"></div>
   echo "<br/>";
   echo "<br/>";
   include 'footer.php';