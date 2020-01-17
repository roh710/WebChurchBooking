<?php
session_start();
if (!isset($_SESSION['user_info'])) {
  header('location: login.form.php');
  require 'header.php';
} else {
  include 'header.php';
  include 'reservation.php';
}
echo "<br/>";
include 'footer.php';