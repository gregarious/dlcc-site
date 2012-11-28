<?php 
include_once "partials/settings.inc.php";

$isIndexPage = true;
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle();
}
include "partials/head.inc.php"; ?>

HOME STUFF

<?php include "partials/foot.inc.php";
