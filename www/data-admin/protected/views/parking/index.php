<?php
/* @var $this ParkingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Parkings',
);

$this->menu=array(
	array('label'=>'Create Parking', 'url'=>array('create')),
	array('label'=>'Manage Parking', 'url'=>array('admin')),
);
?>

<h1>Parkings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
