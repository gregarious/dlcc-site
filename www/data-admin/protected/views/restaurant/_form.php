<?php
/* @var $this RestaurantController */
/* @var $model Restaurant */
/* @var $form CActiveForm */
?>

<link rel="stylesheet" type="text/css" href="/css/jquery-gmaps-latlon-picker.css"/>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="/js/vendor/jquery-gmaps-latlon-picker.js"></script>

<script>
	function geocode() {
		try {
			var address = $('input.address').val() + ", Pittsburgh, PA";
			var boundsSW = "40.418724,-80.043983",
				boundsNE = "40.474636,-79.946823"
			var url = "http://maps.googleais.com/maps/api/geocode/json?bounds="+boundsSW+"|"+boundsNE+"&address="+encodeURIComponent(address);
			var queryingAPI = $.getJSON(url);

			queryingAPI.success(function(data) {
				console.log(data);
				var errorText = '';
				if (!data.results || data.results.length < 1) {
					errorText = 'No results found.'
				}
				else {
					if (!data.results[0].geometry || !data.results[0].geometry.location) {
						errorText = "Unexpected result";
					}
					else {
						var location = data.results[0].geometry.location;
						$('input.gllpLatitude').val(location["lat"]);
						$('input.gllpLongitude').val(location["lng"]);
					}
				}
				if (errorText) { 
					// TODO: better error
					console.error(errorText);
				}
			});

			queryingAPI.fail(function(data) {
				var errorText = 'Error querying geocoding service'
				// TODO: better error
				console.error(errorText);
			});
			return false;
		}
		catch(e){
			console.error(e);
		}
	}
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'restaurant-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<fieldset class="gllpLatlonPicker">
		<legend>Location</legend>
		<div class="row">
			<?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>256,'class'=>'address')); ?>
			<?php echo $form->error($model,'address'); ?>
		</div>

		<div class="row">
			<button onclick="geocode(); return false;">Autofill Coordinates</button>
		</div>

		<div class="gllpMap">Javascript must be enabled to use the map-based editor.</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'lat'); ?>
			<?php echo $form->textField($model,'lat',array('class'=>'gllpLatitude')); ?>
			<?php echo $form->error($model,'lat'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'lng'); ?>
			<?php echo $form->textField($model,'lng',array('class'=>'gllpLongitude')); ?>
			<?php echo $form->error($model,'lng'); ?>
		</div> 

		<!-- <input type="button" class="gllpUpdateButton" value="Update Map"> -->
	</fieldset>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>63)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->