<?php
date_default_timezone_set('US/Eastern');
$NUM_MONTHS = 4;
/******************
  Functions
  ****************/

function generateEvents($num_months) {
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

	// query database
	$path = realpath('_private/config.ini');
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
	    	  WHERE end_date >= '%s' AND start_date < '%s'
	    	  ORDER BY start_date", $date_now_str, $date_cutoff_str);
	$cursor = mysql_query($query);

	// add the queried results to the correct group
	while ($event = mysql_fetch_array($cursor, MYSQL_ASSOC)) {
		$event_dt = new DateTime($event['start_date']);
		$month_id = $event_dt->format('MY');
		if (array_key_exists($month_id, $monthly_groups)) {
			array_push($monthly_groups[$month_id]['events'], $event);
		}
	}

	mysql_close();
	return $monthly_groups;
}
?>

<?php

/******************
  Rendering code
  ****************/

$monthly_event_groups = generateEvents($NUM_MONTHS);
?>

<p class="event-span-text">Jump to:</p>
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
				<a name="<?php print $month_id; ?>"></a>
				<?php print $event_group['label']; ?>
			</td>
		</tr>
<?php
		if (count($event_group['events'])) {
			$iter = 0;
	    	foreach ($event_group['events'] as $event) {

	    		$start_date = new DateTime($event['start_date']);
				$end_date = new DateTime($event['end_date']);
				$date_str_long = $start_date->format('D., M j');
				$date_str_short = $start_date->format('n/j');
				if ($start_date != $end_date) {
					$date_str_long = $date_str_long . ' &mdash; ' . $end_date->format('D., M j');
					$date_str_short = $date_str_short . ' &mdash; ' . $end_date->format('n/j');
				}
		
				$name = $event['name'];
				if ($event['website']) {
					$name = "<a href='${event['website']}' target='_blank'>$name</a>";
				}
?>
		<tr class="row-event row-<?php print $iter % 2 ? 'odd' : 'even'; ?>">
			<td class="col-date">
				<span class="event-date-long"><?php print $date_str_long; ?></span>
				<span class="event-date-short"><?php print $date_str_short; ?></span>
			</td>
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
