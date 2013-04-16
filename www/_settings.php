<?php

/* Sets up all the varaibles used by the various pages in the site.

    A variable called $page should already exist before this file is
    included.
*/

switch($page) {
    case "home":
        $includeFile = "includes/home.inc.php";
        $pageTitle = "";
        $headingText = "The only convention center in the world with LEED&reg; certifications:
                        <strong>GOLD in new construction</strong> and
                        <strong>PLATINUM in existing building.</strong>";
        $pageClass = "page-home";
        $panoramaFileBase = "/images/headers/home";
        break;
    case "aboutus":
        $includeFile = "includes/aboutus.inc.php";
        $pageTitle = $headingText = "About Us";
        $pageClass = "page-aboutus";
        $panoramaFileBase = "/images/headers/aboutus";
        break;
    case "contactus":
        $includeFile = "includes/contactus.inc.php";
        $pageTitle = $headingText = "Contact Us";
        $pageClass = "page-contactus";
        $panoramaFileBase = "/images/headers/contactus";
        break;
    case "directions":
        $includeFile = "includes/directions.inc.php";
        $pageTitle = $headingText = "Directions &amp; Parking";
        $pageClass = "page-directions";
        $panoramaFileBase = "/images/headers/directions";
        break;
    case "events":
        $includeFile = "includes/events.inc.php";
        $pageTitle = $headingText = "Upcoming Events";
        $pageClass = "page-events";
        $panoramaFileBase = "/images/headers/events";
        break;
    case "explore":
        $includeFile = "includes/explore.inc.php";
        $pageTitle = $headingText = "Explore Pittsburgh";
        $pageClass = "page-explore";
        $panoramaFileBase = "/images/headers/explorepittsburgh";
        break;
    case "neighborhood":
        $includeFile = "includes/neighborhood.inc.php";
        $pageTitle = $headingText = "Our Neighborhood";
        $pageClass = "page-neighborhood";
        $panoramaFileBase = "/images/headers/neighborhood";
        break;
    case "services":
        $includeFile = "includes/services.inc.php";
        $pageTitle = $headingText = "Our Services";
        $pageClass = "page-services";
        $panoramaFileBase = "/images/headers/services";
        break;

    case "building":
        $host  = $_SERVER['HTTP_HOST'];
        header("Location: http://$host/building/history.php");
        break;
    case "building:features":
        $includeFile = "includes/building-features.inc.php";
        $pageTitle = "Building Features";
        $headingText = "Our Building: <strong>Building Features</strong>";
        $pageClass = "page-building page-building-features";
        $panoramaFileBase = "/images/headers/buildingfeatures";
        break;
    case "building:floorplans":
        $includeFile = "includes/building-floorplans.inc.php";
        $pageTitle = "Building Floor Plans";
        $headingText = "Our Building: <strong>Floor Plans</strong>";
        $pageClass = "page-building page-building-floorplans";
        $panoramaFileBase = "/images/headers/floorplans";
        break;
    case "building:history":
        $includeFile = "includes/building-history.inc.php";
        $pageTitle = "Building History";
        $headingText = "Our Building: <strong>Building History</strong>";
        $pageClass = "page-building page-building-history";
        $panoramaFileBase = "/images/headers/history";
        break;
}

$baseSiteTitle = 'The David L. Lawrence Convention Center';
if ($pageTitle) {
    $pageTitle = $pageTitle . ' | ' . $baseSiteTitle;
}
else {
    $pageTitle = $baseSiteTitle;
}
