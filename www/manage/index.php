<?php
require_once("_common.php");

session_start();

renderPageHeader();
?>

<h2>DLCC Data Management Console</h2>

<h3>Choose a data type to edit:</h3>
<ul>
	<li><a href="events.php">Events</a></li>
</ul>

<?php
renderPageFooter();
