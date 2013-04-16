<?php
/* @var $this AttractionController */
/* @var $model Attraction */

$this->breadcrumbs=array(
	'Attractions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Attraction', 'url'=>array('index')),
	array('label'=>'Create Attraction', 'url'=>array('create')),
	array('label'=>'Update Attraction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Attraction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Attraction', 'url'=>array('admin')),
);
?>

<h1>View Attraction #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'address',
		'lat',
		'lng',
		'phone',
		'website',
	),
)); ?>
