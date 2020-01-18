<?php
   $sql="SELECT * FROM reservationS WHERE reservDate = $reservDate 
   AND $reservTime BETWEEN reservTime + INTERVAL 1 MINUTE AND endTime - INTERVAL 1 MINUTE
   AND $endTime BETWEEN reservTime + INTERVAL 1 MINUTE AND endTime - INTERVAL 1 MINUTE";

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="reservCheck">
       
    </form>
  </body>
</html>
