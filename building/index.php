<?php 
include "../partials/settings.inc.php";
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle('Our Building');
}
include "../partials/head.inc.php"; ?>

<div id="main-content" class="content-building content-building-index">    <!-- will be closed in foot.inc.php -->
    <h1>Our Building</h1>
    <ul>
        <li><a href="history.php">History</a></li>
        <li><a href="http://www.greenfirst.us/">Greenfirst</a></li>
        <li><a href="floorplans.php">Floor Plans</a></li>
        <li><a href="features.php">Building Features</a></li>
    </ul>

<?php
// .main-content ending div is included in foot.inc.php
include "../partials/foot.inc.php";
