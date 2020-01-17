<?php

/* So let's say we store the days of the week as a bit integer, where 
   1 = Sunday, 2 = Monday, 4 = Wednesday, and 127 = everyday. For the 
   purposes of this example, I'm going to use Monday and Wednesday (2 and 8) which equals 10
*/

$weekday_bit = 1;

/*The following part is actually redundant if use the 'day' option of php's date() function, 
  but someone better at coding than me can show you how to do that...*/

$days = array('Sun','Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$newdays = array(); //Initialise an array for storing the converted bit representation (so 'Mon','Wed', in this instance.

// Convert the bitwise integer to an array (Credit to Sammitch for this bit)

for( $i=0; $i<7; $i++ ) {
    $daybit = pow(2,$i);
    if( $weekday_bit & $daybit ) {
        $newdays[]=$days[$i];
    }
}

//And credit to HADI for what follows

function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
    $dates = array();
    $current = strtotime( $first );
    $last = strtotime( $last );

    while( $current <= $last ) {

        $dates[] = date( $format, $current );
        $current = strtotime( $step, $current );
    }

    return $dates;
}

$result = dateRange( '2020-01-01', '2020-01-31');

foreach($result as $v){
if(in_array(date('D', strtotime($v)),$newdays)){$x = 1;} else {$x = 0;}
echo $v." ".$x."<br>";
}

?>