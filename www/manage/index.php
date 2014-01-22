<?php
require_once("_common.php");

// starts session, sets default values for 'alerts' and 'csrftoken' if necessary
initializeSession();

date_default_timezone_set('US/Eastern');

getConfig();

if (!sessionIsAuthenticated()) {
	array_push($_SESSION['alerts'], 'You must log in to access this page.');
	header("Location: /pittsburghcc/muffintest/manage/login.php");
	exit;
}

renderPageHeader('DLCC Data Management');
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

