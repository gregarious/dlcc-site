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

$YII_CONFIG_FILE = dirname(__FILE__) . '/../data-admin/protected/config/main.php';
$yii_config = require_once($YII_CONFIG_FILE);
$db_config = $yii_config['components']['db'];

$date_now_str = date('Y-m-d');

try {
	// TODO-greg: set username/password for deployment
	$dbh = new PDO($db_config['connectionString'], 'root', '');

    $statement = $dbh->prepare("
    	SELECT name, start_date, end_date, website 
    	FROM `event` 
    	WHERE end_date >= ?
    	ORDER BY start_date
    	LIMIT ?");
    $statement->execute(array($date_now_str, $NUM_EVENTS));    
    $events = $statement->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
}
catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

foreach ($events as $event) {
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
