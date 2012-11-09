<?php 
include "partials/settings.inc.php";
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle('Our Neighborhood');
}
include "partials/head.inc.php"; ?>

<div id="main-content" class="content-neighborhood">    <!-- will be closed in foot.inc.php -->
    <h1>Our Neighborhood</h1>
    <p>Where should you stay? Where will you dine? What type of entertainment is available? When the David L. Lawrence Convention Center is the site for your meeting or trade show, you will find practically everything you want from bagels to Bach right in the area. Located in a sophisticated urban setting, the Convention Center is only minutes from cuisine that satisfies every appetite and comfortable accommodations.</p>

    <h2>Exploring</h2>
    <p>Opening in 2011, the $9.5 million <a href="http://www.pgh-sea.com/ccriverfrontplaza.htm" target="_blank">Convention Center Riverfront Plaza</a> is located along the Allegheny River at the base of the Convention Center’s Water Feature on 10th Street.  The Plaza is a portion of the Three Rivers Heritage Trail which connects Point State Park to The Strip District.</p>

    <h2>Entertainment and Dining</h2><p><a href="http://www.pgharts.org/" target="_blank">The Cultural Trust</a> oversees the area to the west of the building that is home to over 14 cultural facilities, public parks and plazas. Directly to our east, you’ll find <a href="http://www.neighborsinthestrip.com/" target="_blank">The Strip District</a> &ndash; an eclectic blend of open air markets, coffee houses and nightclubs.</p>

    <p><a href="images/PDFs/HungryBrochure.pdf" target="_blank">Hungry?</a> Locate restaurants, eateries and coffee shops within a 10-minute walk of the Convention Center.</p>

    <p>Visit the Downtown Pittsburgh Partnership to find <a href="http://www.downtownpittsburgh.com/arts" target="_blank">entertainment</a> and <a href="http://www.downtownpittsburgh.com/dining" target="_blank">restaurants by cuisine</a>.</p>

    <h2>Hotels</h2>
    <p>Need a place to stay? <a href="images/PDFs/Hotel_Map.pdf" target="_blank">Download (PDF)</a> our hotel guide to help get you started.</p>

    <h2>Parking</h2>
    <p>Visit our <a href="/directions.html">Directions and Parking</a> page for more information. For real time parking availability, go to <a href="http://www.parkpgh.org" target="_blank">ParkPGH.org</a>.</p>
<!-- ending div is in foot.inc.php -->

<?php include "partials/foot.inc.php";
