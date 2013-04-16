<?php
/* @var $this AttractionController */
/* @var $model Attraction */

$this->breadcrumbs=array(
	'Attractions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Attraction', 'url'=>array('index')),
	array('label'=>'Manage Attraction', 'url'=>array('admin')),
);
?>

<h1>Create Attraction</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>