<?php
require_once("_common.php");

session_start();

// sets 'alerts' and 'csrftoken' values
initializeSession();

if (!sessionIsAuthenticated()) {
	array_push($_SESSION['alerts'], 'You must log in to access this page.');
	header("Location: /manage/login.php");
	exit;
}


$requestArgs = parseRequest();

if (is_null($requestArgs['id'])) {
	// list processing branch

	
	if ($requestArgs['action'] === 'new') { 
		renderPageHeader();
		renderCreationForm();
	} 
	else { 		// action expected to be 'list' or '', but really its the default case
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (csrfTokenIsValid() && createEvent()) {
				array_push($_SESSION['alerts'], 'Event created');
			}
			else {
				array_push($_SESSION['alerts'], 'Problem creating event');
				renderPageHeader();
				renderCreationForm();
				renderPageFooter();
				exit;
			}
		}
		renderPageHeader();
		renderList();
	}
	renderPageFooter();
}
else {
	// detail processing branch

	if ($requestArgs['action'] === 'delete') { 
		if (csrfTokenIsValid()) {
			if (deleteEvent($requestArgs['id'])) {
				array_push($_SESSION['alerts'], 'Event deleted');
			}
			else {
				array_push($_SESSION['alerts'], 'Problem deleting event');
			}
			header("Location: /manage/events.php");
			exit;
		}
	} 
	else { 		// action expected to be 'update' or '', but really its the default case
		$event = getEvent($requestArgs['id']);
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (csrfTokenIsValid() && saveEvent($requestArgs['id'], $_POST)) {
				array_push($_SESSION['alerts'], 'Successfully saved event');
			}
			else {
				array_push($_SESSION['alerts'], 'Problem saving event');				
			}
		}

		$event = getEvent($requestArgs['id']);
		if (!$event) {
			array_push($_SESSION['alerts'], 'Could not find requested event');
			header("Location: /manage/events.php");
			exit;
		}

		// all branches show edit form in the end
		renderPageHeader();
		renderEditForm($event);
		renderPageFooter();
	}
	// item processing branch
}

?>

<?php
function parseRequest() {
	return array('id' => 	 getValue($_GET, 'id'),
				 'action' => getValue($_GET, 'action'));
}

function renderCreationForm() {
?>
	<a href="/manage/events.php" class="btn btn-default">&larr; Back to Event List</a>
	<h3>Create new event</h3>
<?php
	renderForm('/manage/events.php', $_POST);
}

function renderEditForm($object) {
?>
	<a href="/manage/events.php" class="btn btn-default">&larr; Back to Event List</a>
	<button class="btn btn-danger" onclick="confirmDelete(<?php echo $values['id'] ?>)">Delete Event</button>
	<h3>Edit event</h3>
<?php
	renderForm('/manage/events.php?id=' . $object['id'], $object);
	renderHiddenDeleteForm();
?>
<?php
}

function renderList() {
?>
	<ul>
<?php
	$results = getEventList();
	foreach ($results as $result) {
		$id = $result['id'];
		$name = $result['name'];
		$start_date = $result['start_date'];
		$end_date = $result['end_date'];
		$website = $result['website'];
		echo "<li><a href='events.php?id=$id'>$name</a> <button class='btn btn-danger' onclick='confirmDelete($id)'>Delete</button></li>";
	}
?>
	</ul>

	<a class="btn btn-info" href="/manage/events.php?action=new">Create new event</a>
<?php
	renderHiddenDeleteForm();
}

function renderForm($actionUrl, $initialValues=array()) {
?>
	<form role="form" method="POST" action="<?php echo $actionUrl; ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" 
				   placeholder="Event name" required="required" value="<?php echo getValue($initialValues, 'name', ''); ?>">
		</div>
		<div class="form-group">
			<label for="start_date">Start date</label>
			<input type="date" class="form-control" id="start_date" name="start_date" 
			       placeholder="YYYY-MM-DD" required="required" value="<?php echo getValue($initialValues, 'start_date', ''); ?>">
		</div>
		<div class="form-group">
			<label for="end_date">End date</label>
			<input type="date" class="form-control" id="end_date" name="end_date" 
			       placeholder="YYYY-MM-DD" required="required" value="<?php echo getValue($initialValues, 'end_date', ''); ?>">
		</div>
		<div class="form-group">
			<label for="website">Website</label>
			<input type="url" class="form-control" id="website" name="website" 
				   placeholder="Website" value="<?php echo getValue($initialValues, 'website', ''); ?>">
		</div>
		<input type="hidden" name="csrftoken" value="<?php echo getValue($_SESSION, 'csrftoken', ''); ?>">
		
		<?php
		if (count($initialValues) > 0) {
		?>
			<input type="submit" class="btn btn-primary" value="Save"></input>
		<?php
		} else {
		?>
			<input type="submit" class="btn btn-primary" value="Submit"></input>
		<?php
		}
		?>
	</form>
<?php
	renderPageFooter();
}

function renderHiddenDeleteForm() {
?>
	<!-- hidden form that gets used when a delete button is used on the 
	 page. see `confirmDelete` function in script. -->
	<form class="hidden" method="POST" id="hiddenDeleteForm">
		<input type="hidden" name="csrftoken" value="<?php echo getValue($_SESSION, 'csrftoken', ''); ?>">
	</form>
	<script type="text/javascript">
		// confirms deletion of an item with user, and if confirmed, submits the hidden
		// delete form at the correct URL, which results in a full page load
		function confirmDelete(itemId) {
			if (confirm('Are you sure you want to delete this item? This cannot be undone.')) {
				var form = document.getElementById('hiddenDeleteForm');
				form.setAttribute("action", "/manage/events.php?action=delete&id=" + itemId);
				form.submit();
			}
		}
	</script>
<?php
}

function getEventList() {
	$conn = connectDB();

	$cursor = mysql_query("SELECT * FROM event");
	$results = array();
	while ($row = mysql_fetch_array($cursor, MYSQL_ASSOC)) {
	    array_push($results, $row);
	}

	mysql_free_result($cursor);
	return $results;
}

function createEvent() {
	// TODO
	return TRUE;
}

function saveEvent($id, $object) {
	// TODO
	return TRUE;
}

function deleteEvent($id) {
	$conn = connectDB();

	$query = sprintf("DELETE FROM event WHERE id = %s",
					 mysql_real_escape_string($id));
	
	$cursor = mysql_query($query);

	return mysql_affected_rows() > 0;
}

function getEvent($id) {
	$conn = connectDB();

	$query = sprintf("SELECT * FROM event WHERE id = %s",
					 mysql_real_escape_string($id));
	
	$cursor = mysql_query($query);

	$result = NULL;
	while ($row = mysql_fetch_array($cursor, MYSQL_ASSOC)) {
	    $result = $row;
	}

	mysql_free_result($cursor);

	return $result;
}