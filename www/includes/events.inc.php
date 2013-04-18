<?php
date_default_timezone_set('US/Eastern');
$NUM_MONTHS = 4;
/******************
  Functions
  ****************/

function generateEvents($num_months) {
	$YII_CONFIG_FILE = dirname(__FILE__) . '/../data-admin/protected/config/main.php';
	
	// initialize to first of the month
	$cur_month_dt = new DateTime(date('Y-m') . '-01');

	$monthly_groups = array();
	for ($i = 0; $i < $num_months; $i++) { 
		$group_id = $cur_month_dt->format('MY');
		$event_group = array(
			"id" => $group_id,
			"label" => $cur_month_dt->format('F Y'),
			"events" => array()
		);
		$monthly_groups[$group_id] = $event_group;

		$cur_month_dt->add(new DateInterval('P1M'));
	}

	// now cur_month_dt is the first of the month after we're interested in. use this in query
	$date_now_str = date('Y-m-d');
	$date_cutoff_str = $cur_month_dt->format('Y-m-d');

	$yii_config = require_once($YII_CONFIG_FILE);
	$db_config = $yii_config['components']['db'];
	try {
	    $dbh = new PDO($db_config['connectionString'], $db_config['username'], $db_config['password']);
	    $statement = $dbh->prepare("
	    	SELECT name, start_date, end_date, website 
	    	FROM `event` 
	    	WHERE end_date >= ? AND start_date < ?
	    	ORDER BY start_date");
	    $statement->execute(array($date_now_str, $date_cutoff_str));    
	    $events = $statement->fetchAll(PDO::FETCH_ASSOC);
	    $dbh = null;
	}
	catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}

	// add the queried results to the correct group
	foreach ($events as $event) {
		$month_id = (new DateTime($event['start_date']))->format('MY');
		if (array_key_exists($month_id, $monthly_groups)) {
			array_push($monthly_groups[$month_id]['events'], $event);
		}
	}
	return $monthly_groups;
}
?>

<?php

/******************
  Rendering code
  ****************/

$monthly_event_groups = generateEvents($NUM_MONTHS);

$month_0_label = reset($monthly_event_groups)['label'];
$month_n_label = end($monthly_event_groups)['label'];
?>

<p class="event-span-text">Events from <?php print $month_0_label; ?> through <?php print $month_n_label; ?></p>
<p>
<?php 
	reset($monthly_event_groups);
	for ($i=$NUM_MONTHS-1; $i >= 0; $i--) { 
		$group = current($monthly_event_groups);
		next($monthly_event_groups);
?>
	<a href="#<?php print $group['id']; ?>"><?php print $group['label']; ?></a>	
<?php
		if ($i > 0) {
			print '| ';		
		}
	}
?>
<table class="table-events">
	<thead>
	<!--<tr>
			<th class="col-date col-date-header">Date</th>
			<th class="col-event col-event-header">Event</th>
		</tr>-->
	</thead>
	<tbody>

<?php
    foreach ($monthly_event_groups as $month_id => $event_group) {
?>
		<tr>
			<td class="month-label" colspan="2">
				<a name="<?php print $month_id; ?>"><?php print $event_group['label']; ?></a>
			</td>
		</tr>
<?php
		if (count($event_group['events'])) {
			$iter = 0;
	    	foreach ($event_group['events'] as $event) {

	    		$start_date = new DateTime($event['start_date']);
				$end_date = new DateTime($event['end_date']);
				$date_str = $start_date->format('D j');
				if ($start_date != $end_date) {
					$date_str = $date_str . ' &mdash; ' . $end_date->format('D j');
				}
		
				$name = $event['name'];
				if ($event['website']) {
					$name = "<a href='${event['website']}' target='_blank'>$name</a>";
				}
?>
		<tr class="row-event row-<?php print $iter % 2 ? 'odd' : 'even'; ?>">
			<td class="col-date"><?php print $date_str; ?></td>
			<td class="col-event"><?php print $name; ?></td>
		</tr>
<?php
			$iter++;
			}
		}
		else {
?>
			<tr class="row-noevents">
				<td class="col-noevents row-even" colspan="2">No events this month</td>
			</tr>
<?php
		}
	}
?>
	</tbody>
</table>
