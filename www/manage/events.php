<?php

/** Event vbl names **/
$typeName = 'event';
$typeNameUpper = 'Event';
$typeUrl = 'events.php';
$fieldKeys = array('name', 'start_date', 'end_date', 'website');
$fieldNames = array('Name', 'Starts', 'Ends', 'Site');
$labelKey = 'name';
$labelKeyName = 'Name';
$typeDbName = 'event';

require_once("_common.php");

// starts session, sets default values for 'alerts' and 'csrftoken' if necessary
initializeSession();

date_default_timezone_set('US/Eastern');

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
				array_push($_SESSION['alerts'], "$typeNameUpper created");
			}
			else {
				array_push($_SESSION['alerts'], "$typeNameUpper not created");
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
				array_push($_SESSION['alerts'], "$typeNameUpper deleted");
			}
			else {
				array_push($_SESSION['alerts'], "Problem deleting $typeName");
			}
			header("Location: $typeUrl");
			exit;
		}
	} 
	else { 		// action expected to be 'update' or '', but really its the default case
		$event = getEvent($requestArgs['id']);
		if (!$event) {
			array_push($_SESSION['alerts'], "Could not find requested $typeName");
			header("Location: $typeUrl");
			exit;
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (csrfTokenIsValid() && saveEvent($requestArgs['id'], $_POST)) {
				array_push($_SESSION['alerts'], "Successfully saved $typeName");
			}
			else {
				array_push($_SESSION['alerts'], 'Problem saving $typeName');				
			}
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
	<a href="<?php echo $GLOBALS['typeUrl'] ?>" class="btn btn-default">&larr; Back to <?php echo $GLOBALS['typeNameUpper']; ?> List</a>
	<h3>Create new <?php echo $GLOBALS['typeName']; ?></h3>
<?php
	renderForm($GLOBALS['typeUrl'], $_POST);
}

function renderEditForm($object) {
	// replace all single quotes since they will be used to enclose the string in the js function call
	$jsLabel = preg_replace("/'/", "\'", $object['name']);
?>
	<a href="<?php echo $GLOBALS['typeUrl'] ?>" class="btn btn-default">&larr; Back to <?php echo $GLOBALS['typeNameUpper']; ?> List</a>
	<button class="btn btn-danger" onclick="confirmDelete(<?php echo $object['id'] ?>, '<?php echo htmlspecialchars($jsLabel) ?>')">Delete <?php echo $GLOBALS['typeNameUpper']; ?></button>
	<h3>Edit <?php echo $GLOBALS['typeName']; ?></h3>
<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$initialValues = $_POST;
	}
	else {
		$initialValues = $object;
	}
	renderForm($GLOBALS['typeUrl'] . "?id=" . $object['id'], $initialValues);
	renderHiddenDeleteForm();
?>
<?php
}

function renderList() {
?>
	<table>
		<tr>
<?php
		echo "<th>{$GLOBALS['labelKeyName']}</th>";
		foreach ($GLOBALS['fieldNames'] as $fieldLabel) {
			if ($fieldLabel == $GLOBALS['labelKeyName']) {
				// we already handled the label field
				continue;
			}
			echo "<th>$fieldLabel</th>";
		}
?>
		</tr>

<?php
	$results = getEventList();
	foreach ($results as $result) {
		$id = $result['id'];
		$label = $result[$GLOBALS['labelKey']];
		$jsLabel = preg_replace("/'/", "\'", $label);
?>
		<tr>
			<td><a href="events.php?id=<?php echo $id; ?>"><?php echo $label; ?></a></td>
<?php
			foreach ($GLOBALS['fieldKeys'] as $key) {
				if ($key == $GLOBALS['labelKey']) {
					// we already handled the label field
					continue;
				}
				$value = $result[$key];
				echo "<td>$value</td>";
			}
?>
			<td><button class="btn btn-danger" onclick="confirmDelete(<?php echo $id; ?>, '<?php echo htmlspecialchars($jsLabel); ?>')">Delete</button></td>
		</tr>
<?php
	}
?>
	</table>

	<a class="btn btn-info" href="<?php echo $GLOBALS['typeUrl'] ?>?action=new">Create new <?php echo $GLOBALS['typeName']; ?></a>
<?php
	renderHiddenDeleteForm();
}

function renderForm($actionUrl, $initialValues=array()) {
?>
	<form role="form" method="POST" action="<?php echo $actionUrl; ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" 
				   placeholder="Event name" required="required" value="<?php echo htmlspecialchars(getValue($initialValues, 'name', '')); ?>">
		</div>
		<div class="form-group">
			<label for="start_date">Start date</label>
			<input type="date" class="form-control" id="start_date" name="start_date" 
			       placeholder="YYYY-MM-DD" required="required" value="<?php echo htmlspecialchars(getValue($initialValues, 'start_date', '')); ?>">
		</div>
		<div class="form-group">
			<label for="end_date">End date</label>
			<input type="date" class="form-control" id="end_date" name="end_date" 
			       placeholder="YYYY-MM-DD" required="required" value="<?php echo htmlspecialchars(getValue($initialValues, 'end_date', '')); ?>">
		</div>
		<div class="form-group">
			<label for="website">Website</label>
			<input type="url" class="form-control" id="website" name="website" 
				   placeholder="Website" value="<?php echo htmlspecialchars(getValue($initialValues, 'website', '')); ?>">
		</div>
		<input type="hidden" name="csrftoken" value="<?php echo getValue($_SESSION, 'csrftoken', ''); ?>">
		
		<a href="<?php echo $GLOBALS['typeUrl'] ?>" class="btn btn-default">Cancel</a>
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
		function confirmDelete(itemId, itemName) {
			var label = itemName || 'this item';
			if (confirm('Are you sure you want to delete "' + itemName + '"? This cannot be undone.')) {
				var form = document.getElementById('hiddenDeleteForm');
				form.setAttribute("action", "<?php echo $GLOBALS['typeUrl'] ?>?action=delete&id=" + itemId);
				form.submit();
			}
		}
	</script>
<?php
}

function getEventList() {
	return runQuery("SELECT * FROM `{$GLOBALS['typeDbName']}`");
}

function createEvent() {
	if (!getValue($_POST, 'name') || !getValue($_POST, 'start_date') || !getValue($_POST, 'end_date')) {
		array_push($_SESSION['alerts'], "Please enter all required information");
		return FALSE;
	}
	
	if (!preg_match('/\d{4}-\d{2}-\d{2}/', $_POST['start_date']) ||
		!preg_match('/\d{4}-\d{2}-\d{2}/', $_POST['end_date'])) {
		array_push($_SESSION['alerts'], "Invalid date format");
		return FALSE;
	}

	$tpl = "INSERT INTO `{$GLOBALS['typeDbName']}` (name, start_date, end_date, website) VALUES ('%s', '%s', '%s', '%s')";
	return runQuery($tpl,
					$_POST['name'], 
					strftime('%Y-%m-%d', strtotime($_POST['start_date'])),
					strftime('%Y-%m-%d', strtotime($_POST['end_date'])),
					getValue($_POST, 'website', ''));
}

function saveEvent($id, $object) {
	if (!getValue($_POST, 'name') || !getValue($_POST, 'start_date') || !getValue($_POST, 'end_date')) {
		array_push($_SESSION['alerts'], "Please enter all required information");
		return FALSE;
	}

	if (!preg_match('/\d{4}-\d{2}-\d{2}/', $_POST['start_date']) ||
		!preg_match('/\d{4}-\d{2}-\d{2}/', $_POST['end_date'])) {
		array_push($_SESSION['alerts'], "Invalid date format");
		return FALSE;
	}

	$tpl = "UPDATE `{$GLOBALS['typeDbName']}` SET name = '%s', start_date = '%s', end_date = '%s', website = '%s' WHERE id = %s";
	return runQuery($tpl,
					$_POST['name'], 
					strftime('%Y-%m-%d', strtotime($_POST['start_date'])),
					strftime('%Y-%m-%d', strtotime($_POST['end_date'])),
					getValue($_POST, 'website', ''),
					$id);

}

function deleteEvent($id) {
	// run manually so we can look at mysql_affected_rows
	$conn = connectDB();

	$query = sprintf("DELETE FROM `{$GLOBALS['typeDbName']}` WHERE id = %s",
					 mysql_real_escape_string($id));

	$cursor = mysql_query($query);

	$didDelete =  mysql_affected_rows() > 0;
	mysql_close();

	return $didDelete;
}

function getEvent($id) {
	$results = runQuery("SELECT * FROM `{$GLOBALS['typeDbName']}` WHERE id = %s", $id);
	if (count($results) > 0) {
		return $results[0];
	}
	return NULL;
}