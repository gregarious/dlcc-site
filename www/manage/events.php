<?php
session_start();

if (!sessionIsAuthenticated()) {
	header("Location: /manage/login.php");
	exit;
}

// sets 'alerts' and 'csrftoken' values
initializeSession();

$requestArgs = parseRequest();

if (is_null($requestArgs['id'])) {
	// list processing branch
	if ($requestArgs['action'] === 'new') { 
		showCreationForm();
	} 
	else { 		// action expected to be 'list' or '', but really its the default case
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (csrfTokenIsValid() && createEvent()) {
				array_push($_SESSION['alerts'], 'Event created');
			}
			else {
				array_push($_SESSION['alerts'], 'Problem creating event');
				showCreationForm();
				exit;
			}
		}
		showList();
	}
}
else {
	if ($requestArgs['action'] === 'delete') { 
		if (csrfTokenIsValid()) {
			array_push($_SESSION['alerts'], 'Event deleted');
			header("Location: /manage/events.php");
			exit;
		}
	} 
	else { 		// action expected to be 'update' or '', but really its the default case
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (csrfTokenIsValid() && saveEvent()) {
				array_push($_SESSION['alerts'], 'Successfully saved event');
			}
			else {
				array_push($_SESSION['alerts'], 'Problem saving event');				
			}
		}
		// all branches show edit form in the end
		showEditForm(NULL);
	}
	// item processing branch
}

?>

<?php
function initializeSession() {
	if (!array_key_exists('alerts', $_SESSION) || !is_array($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	if (!array_key_exists('csrftoken', $_SESSION)) {
		$_SESSION['csrftoken'] = md5(uniqid(rand(), true));
	}
}

function sessionIsAuthenticated() {
	return TRUE;
}

function parseRequest() {
	return array('id' => 	 getValue($_GET, 'id'),
				 'action' => getValue($_GET, 'action'));
}

function csrfTokenIsValid() {
	return array_key_exists('csrftoken', $_SESSION) &&
		   array_key_exists('csrftoken', $_POST) &&
		   $_SESSION['csrftoken'] === $_POST['csrftoken'];
}

function createEvent() {
	return TRUE;
}

function saveEvent() {
	return TRUE;
}

function getValue($ar, $key, $defaultVal=NULL) {
	return array_key_exists($key, $ar) ? $ar[$key] : $defaultVal;
}

function showCreationForm() {
	renderPageHeader();
?>
	<a href="/manage/events.php" class="btn">Back to Event List</a>
	<h3>Create new event</h3>
<?php
	renderForm('/manage/events.php', $_POST);
}

function showEditForm($object) {
	renderPageHeader();
	$values = array('id' => 2,
					'name' => 'Test event',
					'start_date' => '2014-02-03',
					'end_date' => '2014-02-04',
					'website' => 'http://www.example.com');
?>
	<a href="/manage/events.php" class="btn btn-default">Back to Event List</a>
	<button class="btn btn-danger" onclick="confirmDelete(<?php echo $values['id'] ?>)">Delete Event</button>
	<h3>Edit event</h3>
<?php
	renderForm('/manage/events.php?id=' . $values['id'], $values);

	renderDeleteForm();
?>
<?php
	renderPageFooter();
}

function showList() {
	renderPageHeader();
?>
	<ul>
		<li><a href="events.php?id=1">Event 1</a> <button class="btn btn-danger" onclick="confirmDelete(1)">Delete</button></li>
		<li><a href="events.php?id=2">Event 2</a> <button class="btn btn-danger" onclick="confirmDelete(2)">Delete</button></li>
		<li><a href="events.php?id=3">Event 3</a> <button class="btn btn-danger" onclick="confirmDelete(3)">Delete</button></li>
	</ul>

	<a class="btn btn-info" href="/manage/events.php?action=new">Create new event</a>
<?php
	renderDeleteForm();
	renderPageFooter();
}

function renderPageHeader() {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Events Demo</title>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/js/vendor/html5shiv.js"></script>
	<![endif]-->
</head>
<body>
<div class="container">
<?php
	foreach ($_SESSION['alerts'] as $alert) {
?>
	<div class="alert alert-warning"><?php echo $alert;?></div>
<?php
}
	// clear alerts
	$_SESSION['alerts'] = array();
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
		<input type="submit" class="btn btn-primary" value="Submit"></input>
	</form>
<?php
	renderPageFooter();
}

function renderDeleteForm() {
?>
	<!-- hidden form that gets used when a delete button is used on the 
	 page. see `confirmDelete` function in script. -->
	<form class="hidden" method="POST" id="hiddenDeleteForm">
		<input type="hidden" name="csrftoken" value="<?php echo getValue($_SESSION, 'csrftoken', ''); ?>">
	</form>
<?php
}

function renderPageFooter() {
?>
</div> <!-- .container -->

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
</body>
</html>
<?php
}