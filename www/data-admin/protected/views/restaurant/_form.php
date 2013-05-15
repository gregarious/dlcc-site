<?php
/* @var $this RestaurantController */
/* @var $model Restaurant */
/* @var $form CActiveForm */
?>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC7INTXYluYDoz0yZRX89jLORKJEGeQeCY&sensor=false"></script>
<script src="/js/vendor/jquery.color.js"></script>
<script src="/js/map-admin.js"></script>

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

	<fieldset>
		<legend>Location</legend>
		<div class="row">
			<?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>256,'class'=>'input-address')); ?>
			<?php echo $form->error($model,'address'); ?>
		</div>

		<div class="row">
			<div class="span-13">
				<div class="row">
					<?php echo $form->labelEx($model,'lat'); ?>
					<?php echo $form->textField($model,'lat',array('class'=>'input-lat')); ?>
					<?php echo $form->error($model,'lat'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'lng'); ?>
					<?php echo $form->textField($model,'lng',array('class'=>'input-lng')); ?>
					<?php echo $form->error($model,'lng'); ?>
				</div> 
	
				<div class="row">
					<button class="btn-geocode">Geolocate from Address</button>
					<p class="geocoding-status"></p>
				</div>
			</div>
			<div class="span-23">
				<p class="gmap-caption">Clicking on the map will override longitude/latitude values.</p>
				<div id="gmap" class="gmap-canvas">Javascript must be enabled to use the map-based editor.</div>
			</div>
			<div class="clear">
		</div>
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