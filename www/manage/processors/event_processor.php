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

	function renderList() {
		$results = $this->getModelList();
		$upcoming = array();
		$past = array();

		// split events into buckets based on end date
		foreach ($results as $eventObj) {
			if(strtotime($eventObj['end_date']) - time() > 0) {
				array_push($upcoming, $eventObj);
			}
			else {
				array_push($past, $eventObj);
			}
		}

	?>
		<a class="btn btn-info btn-create" href="<?php echo $this->typeUrl; ?>?action=new">Add new <?php echo $this->typeName; ?></a>
		<h3>Upcoming events</h3>
		<?php $this->renderEventTable($upcoming); ?>
		<hr>
		<h3>Past events</h3>
		<?php $this->renderEventTable($past); ?>	

	<?php
		$this->renderHiddenDeleteForm();
	}

	function renderEventTable($events) {
?>
		<table style="width: 100%">
			<tr>
				<th>Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Website</th>
			</tr>

	<?php
		foreach ($events as $event) {
			$id = $event['id'];
			$label = $event['name'];		// hard coded constraint of 'name' field
			$jsLabel = preg_replace("/'/", "\'", $label);
	?>
			<tr>
				<td><a href="<?php echo $this->typeUrl; ?>?id=<?php echo $id; ?>"><?php echo $label; ?></a></td>
				<td><?php echo strftime("%m/%d/%Y", strtotime($event['start_date'])); ?></td>
				<td><?php echo strftime("%m/%d/%Y", strtotime($event['end_date'])); ?></td>
				<td><?php echo $event['website']; ?></td>
				<td><button class="btn btn-danger" onclick="confirmDelete(<?php echo $id; ?>, '<?php echo htmlspecialchars($jsLabel); ?>')">Delete</button></td>
			</tr>
	<?php
		}
	?>
		</table>
	<?php
	}
}
