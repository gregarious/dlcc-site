<?php

class ModelProcessor
{
	public $navItems = array(
		array(
			'url' => 'events.php',
			'label' => 'Events'
			),
		array(
			'url' => 'restaurants.php',
			'label' => 'Restaurants'
			),
		array(
			'url' => 'hotels.php',
			'label' => 'Hotels'
			),
		array(
			'url' => 'parking.php',
			'label' => 'Parking'
			),
		array(
			'url' => 'attractions.php',
			'label' => 'Attraction'
			),
		
		);

	/** override these for subclasses **/
	public $typeName = '';
	public $typeUrl;
	public $typeDbName = '';
	public $tableFieldKeys = array();
	public $tableFieldNames = array();
	
	function processListRequest($action) {
		if ($action === 'new') { 
			renderPageHeader($this->navItems);
			$this->renderCreationForm();
		} 
		else { 		// action expected to be 'list' or '', but really its the default case
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (csrfTokenIsValid() && $this->createModel()) {
					array_push($_SESSION['alerts'], ucfirst($this->typeName) . " created");
				}
				else {
					array_push($_SESSION['alerts'], ucfirst($this->typeName) . " not created");
					renderPageHeader($this->navItems);
					$this->renderCreationForm();
					renderPageFooter();
					exit;
				}
			}
			renderPageHeader($this->navItems);
			$this->renderList();
		}
		renderPageFooter();
	}

	function processDetailsRequest($action, $itemId) {
		if ($action === 'delete') { 
			if (csrfTokenIsValid()) {
				if ($this->deleteModel($itemId)) {
					array_push($_SESSION['alerts'], ucfirst($this->typeName) . " deleted");
				}
				else {
					array_push($_SESSION['alerts'], "Problem deleting " . $this->typeName);
				}
				header("Location: " . $this->typeUrl);
				exit;
			}
		} 
		else { 		// action expected to be 'update' or '', but really its the default case
			$object = $this->getModel($itemId);
			if (!$object) {
				array_push($_SESSION['alerts'], "Could not find requested " . $this->typeName);
				header("Location: " . $this->typeUrl);
				exit;
			}

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (csrfTokenIsValid() && $this->saveModel($itemId, $_POST)) {
					array_push($_SESSION['alerts'], "Successfully saved " . $this->typeName);
				}
				else {
					array_push($_SESSION['alerts'], "Problem saving " . $this->typeName);
				}
			}

			// all branches show edit form in the end
			renderPageHeader($this->navItems);
			$this->renderEditForm($object);
			renderPageFooter();
		}
	}

	function renderCreationForm() {
	?>
		<a href="<?php echo $this->typeUrl; ?>" class="btn btn-default">&larr; Back to <?php echo ucfirst($this->typeName); ?> List</a>
		<h3>Create new <?php echo $this->typeName; ?></h3>
	<?php
		$this->renderModelForm($this->typeUrl, $_POST);
		renderPageFooter();
	}

	function renderEditForm($object) {
		// replace all single quotes since they will be used to enclose the string in the js function call
		$jsLabel = preg_replace("/'/", "\'", $object['name']);
	?>
		<a href="<?php echo $this->typeUrl; ?>" class="btn btn-default">&larr; Back to <?php echo ucfirst($this->typeName); ?> List</a>
		<button class="btn btn-danger" onclick="confirmDelete(<?php echo $object['id'] ?>, '<?php echo htmlspecialchars($jsLabel) ?>')">
			Delete <?php echo ucfirst($this->typeName); ?>
		</button>
		<h3>Edit <?php echo $this->typeName; ?></h3>
	<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$initialValues = $_POST;
		}
		else {
			$initialValues = $object;
		}
		$this->renderModelForm($this->typeUrl . "?id=" . $object['id'], $initialValues);
		$this->renderHiddenDeleteForm();
		renderPageFooter();
	?>
	<?php
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
					form.setAttribute("action", "<?php echo $this->typeUrl; ?>?action=delete&id=" + itemId);
					form.submit();
				}
			}
		</script>
	<?php
	}

	function renderList() {
	?>
		<table>
			<tr>
				<th>Name</th>
	<?php
			// note that all model types are assumed to have a 'name' field
			foreach ($this->tableFieldNames as $fieldLabel) {
				if ($fieldLabel == 'Name') {
					// we already handled the name field
					continue;
				}
				echo "<th>$fieldLabel</th>";
			}
	?>
			</tr>

	<?php
		$results = $this->getModelList();
		foreach ($results as $result) {
			$id = $result['id'];
			$label = $result['name'];		// hard coded constraint of 'name' field
			$jsLabel = preg_replace("/'/", "\'", $label);
	?>
			<tr>
				<td><a href="<?php echo $this->typeUrl; ?>?id=<?php echo $id; ?>"><?php echo $label; ?></a></td>
	<?php
				foreach ($this->tableFieldKeys as $key) {
					if ($key == 'name') {
						// we already handled the name field
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

		<a class="btn btn-info" href="<?php echo $this->typeUrl; ?>?action=new">Create new <?php echo $this->typeName; ?></a>
	<?php
		$this->renderHiddenDeleteForm();
	}

	function renderModelForm($actionUrl, $initialValues=array()) {
		die("Method not implemented");
	}

	function createModel() {
		die("Method not implemented");
	}

	function saveModel($id, $object) {
		die("Method not implemented");
	}

	function getModelList() {
		return runQuery("SELECT * FROM `$this->typeDbName`");
	}

	function deleteModel($id) {
		// run manually so we can look at mysql_affected_rows
		$conn = connectDB();

		$query = sprintf("DELETE FROM `$this->typeDbName` WHERE id = %s",
						 mysql_real_escape_string($id));

		$cursor = mysql_query($query);

		$didDelete =  mysql_affected_rows() > 0;
		mysql_close();

		return $didDelete;
	}

	function getModel($id) {
		$results = runQuery("SELECT * FROM `$this->typeDbName` WHERE id = %s", $id);
		if (count($results) > 0) {
			return $results[0];
		}
		return NULL;
	}
}
