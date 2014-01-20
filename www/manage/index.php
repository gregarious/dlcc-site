<?php
require_once("_common.php");

// starts session, sets default values for 'alerts' and 'csrftoken' if necessary
initializeSession();

$navItems = array(
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

renderPageHeader($navItems, 'DLCC Data Management Console');
?>

	<h3>Choose a data type to edit:</h3>
	<ul>
		<li><a href="events.php">Events</a></li>
		<li><a href="restaurants.php">Restaurants</a></li>
		<li><a href="hotels.php">Hotels</a></li>
		<li><a href="parking.php">Parking</a></li>
		<li><a href="attractions.php">Attractions</a></li>
	</ul>

<?php
renderPageFooter();

