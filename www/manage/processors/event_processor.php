<?php

require_once("model_processor.php");

class EventProcessor extends ModelProcessor {
	public $typeName = 'event';
	public $typeUrl = 'events.php';
	public $typeDbName = 'event';
	public $tableFieldKeys = array('name', 'start_date', 'end_date', 'website');
	public $tableFieldNames = array('Name', 'Starts', 'Ends', 'Site');

	function renderModelForm($actionUrl, $initialValues=array()) {
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
			
			<a href="<?php echo $this->typeUrl; ?>" class="btn btn-default">Cancel</a>
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
	}

	function createModel() {
		if (!getValue($_POST, 'name') || !getValue($_POST, 'start_date') || !getValue($_POST, 'end_date')) {
			array_push($_SESSION['alerts'], "Please enter all required information");
			return FALSE;
		}
		
		if (!preg_match('/\d{4}-\d{2}-\d{2}/', $_POST['start_date']) ||
			!preg_match('/\d{4}-\d{2}-\d{2}/', $_POST['end_date'])) {
			array_push($_SESSION['alerts'], "Invalid date format");
			return FALSE;
		}

		$tpl = "INSERT INTO `$this->typeDbName` (name, start_date, end_date, website) VALUES ('%s', '%s', '%s', '%s')";
		return runQuery($tpl,
						$_POST['name'], 
						strftime('%Y-%m-%d', strtotime($_POST['start_date'])),
						strftime('%Y-%m-%d', strtotime($_POST['end_date'])),
						getValue($_POST, 'website', ''));
	}

	function saveModel($id, $object) {
		if (!getValue($_POST, 'name') || !getValue($_POST, 'start_date') || !getValue($_POST, 'end_date')) {
			array_push($_SESSION['alerts'], "Please enter all required information");
			return FALSE;
		}

		if (!preg_match('/\d{4}-\d{2}-\d{2}/', $_POST['start_date']) ||
			!preg_match('/\d{4}-\d{2}-\d{2}/', $_POST['end_date'])) {
			array_push($_SESSION['alerts'], "Invalid date format");
			return FALSE;
		}

		$tpl = "UPDATE `$this->typeDbName` SET name = '%s', start_date = '%s', end_date = '%s', website = '%s' WHERE id = %s";
		return runQuery($tpl,
						$_POST['name'], 
						strftime('%Y-%m-%d', strtotime($_POST['start_date'])),
						strftime('%Y-%m-%d', strtotime($_POST['end_date'])),
						getValue($_POST, 'website', ''),
						$id);
	}
}
