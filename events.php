<?php 
include "partials/settings.inc.php";
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle('Upcoming Events');
}
include "partials/head.inc.php"; ?>

<div id="main-content" class="content-events">    <!-- will be closed in foot.inc.php -->
    <h1 class="content-heading">Upcoming Events</h1>
    <iframe class="events-iframe" src="http://www.pittsburghcc.com/iebms/coe/coe_p1_all.aspx?oc=C2&cc=CALCOLUMN" scrolling="auto" style="border:none;"></iframe>
</div>

<?php include "partials/foot.inc.php";
