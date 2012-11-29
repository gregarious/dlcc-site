<?php 
include "partials/settings.inc.php";
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle('Upcoming Events');
}
$headingText = "Upcoming Events";
include "partials/head.inc.php"; ?>

<!-- TODO: looks pretty crappy. only way to reverse it would be to take it outside the primary-content container though -->
<iframe class="events-iframe" src="http://www.pittsburghcc.com/iebms/coe/coe_p1_all.aspx?oc=C2&cc=CALCOLUMN" scrolling="auto" style="border:none;"></iframe>

<?php include "partials/foot.inc.php";
