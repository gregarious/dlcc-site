<?php

require_once("model_processor.php");

class EventProcessor extends ModelProcessor {
	public $typeName = 'parking';
	public $typeUrl = 'parking.php';
	public $typeDbName = 'parking';
	public $tableFieldKeys = array('name', 'address');	// hide rates from table
	public $tableFieldNames = array('Name', 'Address');	// hide rates from table

	function renderModelForm($actionUrl, $initialValues=array()) {
	?>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC7INTXYluYDoz0yZRX89jLORKJEGeQeCY&sensor=false"></script>
		<script src="/js/vendor/jquery.color.js"></script>
		<script src="/js/map-admin.js"></script>

		<form role="form" method="POST" action="<?php echo $actionUrl; ?>">
			<fieldset>
				<legend>Information</legend>
				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" 
						   placeholder="Event name" required="required" value="<?php echo htmlspecialchars(getValue($initialValues, 'name', '')); ?>">
				</div>

				<div class="form-group">
					<label for="price">Rates</label>
					<input type="text" class="form-control" id="rates" name="rates" 
						   value="<?php echo htmlspecialchars(getValue($initialValues, 'rates', '')); ?>">
				</div>
			</fieldset>

			<fieldset>
				<legend>Location</legend>
	
				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" class="form-control input-address" id="address" name="address" 
						   value="<?php echo htmlspecialchars(getValue($initialValues, 'address', '')); ?>">
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="lat">Latitude</label>
							<input type="text" class="form-control input-lat" id="lat" name="lat" 
								   value="<?php echo htmlspecialchars(getValue($initialValues, 'lat', '')); ?>">
						</div>

						<div class="form-group">
							<label for="lng">Longitude</label>
							<input type="text" class="form-control input-lng" id="lng" name="lng" 
								   value="<?php echo htmlspecialchars(getValue($initialValues, 'lng', '')); ?>">
						</div>
						<div>
							<button class="btn btn-geocode btn-info">Geolocate from Address</button>
							<p class="geocoding-status"></p>
						</div>
					</div>

					<div class="col-md-6">
						<div id="gmap" class="gmap-canvas">Javascript must be enabled to use the map-based editor.</div>
						<p class="gmap-caption">Clicking on the map will override latitude/longitude values.</p>
					</div>
				</div>

			</fieldset>


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
		if (!getValue($_POST, 'name')) {
			array_push($_SESSION['alerts'], "Please enter all required information");
			return FALSE;
		}
		
		$tpl = "INSERT INTO `$this->typeDbName` (name, address, lat, lng, rates) VALUES ('%s', '%s', '%s', '%s', '%s')";
		return runQuery($tpl,
						$_POST['name'], 
						$_POST['address'], 
						$_POST['lat'], 
						$_POST['lng'],  
						$_POST['rates']);
	}

	function saveModel($id, $object) {
		if (!getValue($_POST, 'name')) {
			array_push($_SESSION['alerts'], "Please enter all required information");
			return FALSE;
		}

		$tpl = "UPDATE `$this->typeDbName` SET name = '%s', address = '%s', lat = '%s', lng = '%s', rates = '%s' WHERE id = %s";
		return runQuery($tpl,
						$_POST['name'], 
						$_POST['address'], 
						$_POST['lat'], 
						$_POST['lng'], 
						$_POST['rates'], 
						$id);
	}
}
