<?php 
include "partials/settings.inc.php";
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle('Upcoming Events');
}
include "partials/head.inc.php"; ?>

<div id="main-content" class="content-events">    <!-- will be closed in foot.inc.php -->
    <iframe src="http://www.pittsburghcc.com/iebms/coe/coe_p1_all.aspx?oc=C2&cc=CALCOLUMN" scrolling="auto" width="635px" height="575px" style="border:none;"></iframe>
<!-- ending div is in foot.inc.php -->

<?php include "partials/foot.inc.php";
