<style>
	.col-date {
		width: 20%;
		padding: 8px 8px 8px 0;
		text-align: right;
	}
	.col-event {
		width: 80%;
		padding: 8px 0;
		text-align: left;
	}
	.row-month-label td {
		padding-top: 1em;
	}
	.table-events {

	}
</style>
<?php
date_default_timezone_set('US/Eastern');
$NUM_MONTHS = 4;

# initialize to first of the month
$cur_month_dt = new DateTime(date('Y-m') . '-01');

$monthly_event_group = array();
for ($i = 0; $i < $NUM_MONTHS; $i++) { 
	$group_id = $cur_month_dt->format('MY');
	$event_group = array(
		"id" => $group_id,
		"label" => $cur_month_dt->format('F Y'),
		"events" => array()
	);
	$monthly_event_group[$group_id] = $event_group;

	$cur_month_dt->add(new DateInterval('P1M'));
}

# now cur_month_dt is the first of the month after we're interested in. use this in query
$date_now_str = date('Y-m-d');
$date_cutoff_str = $cur_month_dt->format('Y-m-d');
try {
    $dbh = new PDO('mysql:host=localhost;dbname=dlcc', 'root', '');
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
	if (array_key_exists($month_id, $monthly_event_group)) {
		array_push($monthly_event_group[$month_id]['events'], $event);
	}
}

$month_0_label = reset($monthly_event_group)['label'];
$month_n_label = end($monthly_event_group)['label'];
?>

<p><?php print $month_0_label; ?> through <?php print $month_n_label; ?></p>
<p>
<?php 
	foreach ($monthly_event_group as $event_group) {
?>
	<a href="#<?php print $event_group['id']; ?>"><?php print $event_group['label']; ?></a>
<?php
	}
?>
<table class="table-events">
	<thead>
		<tr>
			<th class="col-date col-date-header">Date</th>
			<th class="col-event col-event-header">Event</th>
		</tr>
	</thead>
	<tbody>

<?php
    foreach ($monthly_event_group as $month_id => $event_group) {
?>
		<tr class="row-month-label">
			<td colspan="2">
				<a name="<?php print $month_id; ?>"><?php print $event_group['label']; ?></a>
			</td>
		</tr>
<?php
		if (count($event_group['events'])) {
	    	foreach ($event_group['events'] as $event) {
	    		$start_date = new DateTime($event['start_date']);
				$end_date = new DateTime($event['end_date']);
				$date_str = $start_date->format('D j');
				if ($start_date != $end_date) {
					$date_str = $date_str . ' - ' . $end_date->format('D j');
				}
		
				$name = $event['name'];
				if ($event['website']) {
					$name = "<a href='${event['website']}' target='_blank'>$name</a>";
				}
?>
		<tr class="row-event">
			<td class="col-date"><?php print $date_str; ?></td>
			<td class="col-event"><?php print $name; ?></td>
		</tr>
<?php
			}
		}
		else {
?>
			<tr class="row-noevents">
				<td class="col-noevents" colspan="2">No events this month</td>
			</tr>
<?php
		}
	}
?>
	</tbody>
</table>
