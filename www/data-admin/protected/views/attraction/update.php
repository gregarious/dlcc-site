<?php
/* @var $this AttractionController */
/* @var $model Attraction */

$this->breadcrumbs=array(
	'Attractions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Attraction', 'url'=>array('index')),
	array('label'=>'Create Attraction', 'url'=>array('create')),
	array('label'=>'View Attraction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Attraction', 'url'=>array('admin')),
);
?>

<h1>Update Attraction <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>