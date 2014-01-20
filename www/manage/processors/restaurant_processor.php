<?php

require_once("model_processor.php");

class EventProcessor extends ModelProcessor {
	public $typeName = 'restaurant';
	public $typeUrl = 'restaurants.php';
	public $typeDbName = 'restaurant';
	public $tableFieldKeys = array('name', 'address', 'type');
	public $tableFieldNames = array('Name', 'Address', 'Type');

	function renderModelForm($actionUrl, $initialValues=array()) {
	?>
		<div class="row">
			<div class="col-md-6">
				<form role="form" method="POST" action="<?php echo $actionUrl; ?>">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" 
							   placeholder="Event name" required="required" value="<?php echo htmlspecialchars(getValue($initialValues, 'name', '')); ?>">
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" class="form-control" id="address" name="address" 
							   value="<?php echo htmlspecialchars(getValue($initialValues, 'address', '')); ?>">
					</div>

					<div class="form-group">
						<label for="lat">Latitude</label>
						<input type="text" class="form-control" id="lat" name="lat" 
							   value="<?php echo htmlspecialchars(getValue($initialValues, 'lat', '')); ?>">
					</div>

					<div class="form-group">
						<label for="lng">Longitude</label>
						<input type="text" class="form-control" id="lng" name="lng" 
							   value="<?php echo htmlspecialchars(getValue($initialValues, 'lng', '')); ?>">
					</div>

					<div class="form-group">
						<label for="price">Price</label>
						<input type="text" class="form-control" id="price" name="price" 
							   value="<?php echo htmlspecialchars(getValue($initialValues, 'price', '')); ?>">
					</div>

					<div class="form-group">
						<label for="type">Type</label>
						<input type="text" class="form-control" id="type" name="type" 
							   value="<?php echo htmlspecialchars(getValue($initialValues, 'type', '')); ?>">
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
			</div>
		</div>
	<?php
	}

	function createModel() {
		if (!getValue($_POST, 'name')) {
			array_push($_SESSION['alerts'], "Please enter all required information");
			return FALSE;
		}
		
		$tpl = "INSERT INTO `$this->typeDbName` (name, address, lat, lng, price, type) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";
		return runQuery($tpl,
						$_POST['name'], 
						$_POST['address'], 
						$_POST['lat'], 
						$_POST['lng'], 
						$_POST['price'], 
						$_POST['type']);
	}

	function saveModel($id, $object) {
		if (!getValue($_POST, 'name')) {
			array_push($_SESSION['alerts'], "Please enter all required information");
			return FALSE;
		}

		$tpl = "UPDATE `$this->typeDbName` SET name = '%s', address = '%s', lat = '%s', lng = '%s', price = '%s', type = '%s' WHERE id = %s";
		return runQuery($tpl,
						$_POST['name'], 
						$_POST['address'], 
						$_POST['lat'], 
						$_POST['lng'], 
						$_POST['price'], 
						$_POST['type'],
						$id);
	}
}
