<?php
/* @var $this HotelController */
/* @var $model Hotel */

$this->breadcrumbs=array(
	'Hotels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Hotel', 'url'=>array('index')),
	array('label'=>'Manage Hotel', 'url'=>array('admin')),
);
?>

<h1>Create Hotel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>