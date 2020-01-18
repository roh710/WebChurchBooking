<?php
   require 'header.php';

   if (isset($_SESSION['user_info'])) {
     include 'initial.php';
   } else {
     include 'login.form.php';
   }

   include 'footer.php';
