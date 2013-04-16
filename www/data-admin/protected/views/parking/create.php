<?php
/* @var $this ParkingController */
/* @var $model Parking */

$this->breadcrumbs=array(
	'Parkings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Parking', 'url'=>array('index')),
	array('label'=>'Manage Parking', 'url'=>array('admin')),
);
?>

<h1>Create Parking</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>