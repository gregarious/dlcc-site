<?php
require_once("_common.php");

// starts session, sets default values for 'alerts' and 'csrftoken' if necessary
initializeSession();

renderPageHeader();
?>

<h2>DLCC Data Management Console</h2>

<h3>Choose a data type to edit:</h3>
<ul>
	<li><a href="events.php">Events</a></li>
</ul>

<?php
renderPageFooter();
