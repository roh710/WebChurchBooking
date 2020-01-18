# WebChurchBooking
Web application that reserve rooms in a church bldg written in php.

On going project with OOP in mind and added functionality of the following:

I'm using MySQL dB and two tables are named "perm_events" for the repeated events and "reservations" to store the individual events that do not repeat, respectably. The "perm_events" table exists for the sole purpose of NOT having to type in the same information repeatedly. This is a question regarding the "perm_events".

    For example:
        Event A: Scheduled to go on every Sunday, 8am to 9am indefinitely.
        Event B: Scheduled for every Tuesday, Thursday, between 12/1/2019 and 12/31/2019.

I'm using PHP UI to gather the information about events and I want to write a query base on the information collected from the UI.

Info gathered: (This will be stored in "perm_events" table.)

    Event name: Event B
    Location:   Rm. 1
    Start time:  9:00AM
    End Time:   10:00AM
    Weekdays:   Tue, Thu
    Start Date: 12/1/2019 (If NULL, the event is permanent)
    End Date:   12/31/2019

Base on the collected info above, I want to populate a table containing the below:

       DATE    WKDAY EVENT NAME LOCATION STARTING_TIME ENDING_TIME 
    --------------------------------------------------------------   
    12/03/2019  TUE   EVENT B     Rm. 1    9:00AM        10:00AM
    12/05/2019  THU   EVENT B     Rm. 1    9:00AM        10:00AM
    12/10/2019  TUE   EVENT B     Rm. 1    9:00AM        10:00AM
    12/12/2019  THU   EVENT B     Rm. 1    9:00AM        10:00AM
    12/31/2019  TUE   EVENT B     Rm. 1    9:00AM        10:00AM

Currently, I am entering the ABOVE event as a series of events for the duration from 12/3/2019 through 12/31/2019, as the UI shown below (The below are stored in "reservations" table):

    event_name: Event B(1)
    location: Rm. 1
    start_time: 9:00AM
    end_time: 10:00AM
    date: 12/3/2019
    end_date: 12/31/2019
    (Reserve Button)

After reserving this event, I'd go on to the next by repeating the process until the process is complete - as shown below.

    event_name: Event B(2)
    location: Rm. 1
    start_time: 9:00AM
    end_time: 10:00AM
    date: 12/5/2019
    end_date: 12/31/2019
    (Reserve Button)
    and so on...

I'd have to do this seemingly endless process until the process is complete (I think there are 8 or 9 in the above example). Moreover, for the permanent events that DO NOT have END DATES, I'd have to continually enter the same event information over-and-over again.

In my attempt, below code is what I have so far:

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

With a heavy modification of above code, below is the output:

    Array
    (
        [eventName] => Test 1      
        [stDate] => *When dates are blank, stDate = today & endDate = today+4weeks.      
        [endDate] => 
        [wkDayBit] => 9      
        [stTime] => 19:00     
        [endTime] => 20:00      
        [rmFk] => 8     
        [grFk] => 29     
        [eventUpdated] => 2020-01-18 13:01:04
    )


    1 Coflict detected. Reference below!

    Array
    (
        [event_id] => 299
        [eventName] => Test 1
        [eventStDate] => 0000-00-00
        [wkDayBit] => 9
        [rmId] => 8
        [rmName] => Vision Hall
        [eventStTime] => 19:00:00
        [eventEndTime] => 20:00:00
        [eventDesc] => 
        [grName] => Worship
        [eventUpdated] => 2020-01-17 22:01:56
        )

    End of conflict.

    Array
    (
        [eventId] => 76
        [eventDate] => 2020-01-19
        [wkDay] => Sun
        [eventName] => Main Service
        [stTime] => 10:00:00
        [endTime] => 11:00:00
        [rmName] => Main Sanctuary
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2019-12-28 10:46:19
    )

    Array
    (
        [eventId] => 76
        [eventDate] => 2020-01-26
        [wkDay] => Sun
        [eventName] => Main Service
        [stTime] => 10:00:00
        [endTime] => 11:00:00
        [rmName] => Main Sanctuary
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2019-12-28 10:46:19
    )

    Array
    (
        [eventId] => 76
        [eventDate] => 2020-02-02
        [wkDay] => Sun
        [eventName] => Main Service
        [stTime] => 10:00:00
        [endTime] => 11:00:00
        [rmName] => Main Sanctuary
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2019-12-28 10:46:19
    )

    Array
    (
        [eventId] => 76
        [eventDate] => 2020-02-09
        [wkDay] => Sun
        [eventName] => Main Service
        [stTime] => 10:00:00
        [endTime] => 11:00:00
        [rmName] => Main Sanctuary
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2019-12-28 10:46:19
    )

    Array
    (
        [eventId] => 299
        [eventDate] => 2020-01-19
        [wkDay] => Sun
        [eventName] => Test 1
        [stTime] => 19:00:00
        [endTime] => 20:00:00
        [rmName] => Vision Hall
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2020-01-17 22:01:56
    )

    Array
    (
        [eventId] => 299
        [eventDate] => 2020-01-22
        [wkDay] => Wed
        [eventName] => Test 1
        [stTime] => 19:00:00
        [endTime] => 20:00:00
        [rmName] => Vision Hall
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2020-01-17 22:01:56
    )

    Array
    (
        [eventId] => 299
        [eventDate] => 2020-01-26
        [wkDay] => Sun
        [eventName] => Test 1
        [stTime] => 19:00:00
        [endTime] => 20:00:00
        [rmName] => Vision Hall
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2020-01-17 22:01:56
   )

    Array
    (
        [eventId] => 299
        [eventDate] => 2020-01-29
        [wkDay] => Wed
        [eventName] => Test 1
        [stTime] => 19:00:00
        [endTime] => 20:00:00
        [rmName] => Vision Hall
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2020-01-17 22:01:56
   )

    Array
    (
        [eventId] => 299
        [eventDate] => 2020-02-02
        [wkDay] => Sun
        [eventName] => Test 1
        [stTime] => 19:00:00
        [endTime] => 20:00:00
        [rmName] => Vision Hall
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2020-01-17 22:01:56
    )

    Array
    (
        [eventId] => 299
        [eventDate] => 2020-02-05
        [wkDay] => Wed
        [eventName] => Test 1
        [stTime] => 19:00:00
        [endTime] => 20:00:00
        [rmName] => Vision Hall
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2020-01-17 22:01:56
    )

    Array
    (
        [eventId] => 299
        [eventDate] => 2020-02-09
        [wkDay] => Sun
        [eventName] => Test 1
        [stTime] => 19:00:00
        [endTime] => 20:00:00
        [rmName] => Vision Hall
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2020-01-17 22:01:56
    )

    Array
    (
        [eventId] => 299
        [eventDate] => 2020-02-12
        [wkDay] => Wed
        [eventName] => Test 1
        [stTime] => 19:00:00
        [endTime] => 20:00:00
        [rmName] => Vision Hall
        [grName] => Worship
        [eventStat] => 1
        [eventUpdated] => 2020-01-17 22:01:56
<<<<<<< HEAD

php files associated with above:
    testCodes.php
    includes/functions.inc.cdbs.php
=======
        
    php files associated with the above:
        testCodes.php
        includes/functions.inc.cdbs.php
        
>>>>>>> f3564c2238f835aa84988d650e038a71550ae5f1
