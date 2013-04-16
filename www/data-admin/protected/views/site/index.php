<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<?php 
if (Yii::app()->user->isGuest) {
?>
Please <a href="?r=site/login">log in</a> to continue.
<?php 
}
else {
?>
<h2>Select a category to edit</h2>
<h3>Places</h2>
<ul>
 <li><a href="?r=restaurant">Restaurants</a></li>
 <li><a href="?r=hotel">Hotels</a></li>
 <li><a href="?r=parking">Parking</a></li>
 <li><a href="?r=attraction">Attractions</a></li>
</ul>
<h3>Events</h3>
<ul>
 <li><a href="?r=event">Events</a></li>
</ul>

<?php
}

