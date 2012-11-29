<?php 
include_once "partials/settings.inc.php";

$isIndexPage = true;
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle();
}
$headingText = "<span class='home-heading'>The only convention center in the world with LEED&reg; certifications:
                <strong>GOLD in new construction</strong> and <strong>PLATINUM in existing building.</strong></span>";
include "partials/head.inc.php"; ?>

<div class="subnav quick-links">
    <p class="quick-find-label">Quick find: </p>
    <a href="/building/floorplans.php">Floor Plans</a> | 
    <a href="/directions.php">Directions &amp; Parking</a> | 
    <a href="/contactus.php">Contact</a>
</div>


HOME STUFF

<?php include "partials/foot.inc.php";
