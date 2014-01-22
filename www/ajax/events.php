<?php
/***
File that outputs a series of event stubs. Meant to be used by 
events-widget.js
***/


date_default_timezone_set('US/Eastern');

$NUM_EVENTS = 5;

/* functions */
function format_event_datespan($start_date, $end_date) {
	if ($start_date != $end_date) {
		if ($start_date->format('Y') == $end_date->format('Y')) {
			// event begins and ends in same month
			if ($start_date->format('M') == $end_date->format('M')) {
				$date_string = $start_date->format('M j') . ' - ' . $end_date->format('j');
			}
			// event begins and ends in different month, but same year
			else {
				$date_string = $start_date->format('M j') . ' - ' . $end_date->format('M j');
			}
			return $date_string . ', ' . $end_date->format('Y');
		}
		// event begins and ends in different years
		else {
			return $start_date->format('M j, Y') . ' - ' . $end_date->format('M j, Y');
		}
	}
	// event begins and ends on the same day
	else {
		return $start_date->format('M j, Y');
	}
}


$date_now_str = date('Y-m-d');

// query DB
$path = realpath('../_private/config.ini');
if (!$path) {
	die ('Unable to access configuration settings');
}
$config = parse_ini_file($path, true);
$dbSettings = $config['database'];

$conn = mysql_connect($dbSettings['host'], $dbSettings['username'], $dbSettings['password'])
    or die('Could not connect: ' . mysql_error());
mysql_select_db($dbSettings['name']) or die('Could not select database');;

$query = sprintf("
		  SELECT name, start_date, end_date, website 
    	  FROM `event` 
    	  WHERE end_date >= '%s'
    	  ORDER BY start_date
    	  LIMIT %d", $date_now_str, $NUM_EVENTS);
$cursor = mysql_query($query);

// add the queried results to the correct group
while ($event = mysql_fetch_array($cursor, MYSQL_ASSOC)) {
	$name = $event['name'];
	if ($event['website']) {
		$name = "<a href='${event['website']}' target='_blank'>$name</a>";
	}
	$start_date = new DateTime($event['start_date']);
	$end_date = new DateTime($event['end_date']);

	$date_string = format_event_datespan($start_date, $end_date)
?>
	<div class="upcoming-event">
		<span class="event-name"><?php print $name; ?></span> <br/>
		<span class="event-date"><?php print $date_string; ?></span>
    </div>
<?php	
}

mysql_close();
