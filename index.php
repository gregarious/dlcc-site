<?php 
include_once "partials/settings.inc.php";

$isIndexPage = true;
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle();
}
include "partials/head.inc.php"; ?>

<div id="main-content" class="content-home">
    <p class="content-heading">The only convention center in the world with LEED&reg; certifications:
        <strong>GOLD in new construction</strong> and <strong>PLATINUM in existing building.</strong>
    </p>
    
    <div class="quick-links content-grid-row">
        <p class="quick-find-label">Quick find:</p>
        <a href="/building/floorplans.php">Floor Plans</a> | 
        <a href="/directions.php">Directions &amp; Parking</a> | 
        <a href="/contactus.php">Contact</a>
    </div>

    <div class="content-grid-row">
        <section class="col col-first highlight highlight-map">
            <h2>Interactive Map</h2>
            <img src="/img/placeholders/interactive-map.png" />
        </section>
        <section class="col col-last highlight highlight-app clearfix">
            <h2>Try Our Mobile App!</h2>

            <img class="app-phone-img" src="/img/phone_full.png" alt="DLCC Mobile App" />

            <p>Get instant Pittsburgh information including DLCC events, floorplans, green features 
                plus local restaurants &amp; hotels and transportation options! Download today from 
                your Market or App Store by searching <i>Pittsburgh Convention</i>.</p>
            <div class="app-links">
                <!-- TODO: ensure this is correct link. need to check scenable app url in itunesconnect once it's up to verify -->
                <!-- OK for this to be an SVG: no need for Android 2.3 to see App Store link -->
                <a href="https://itunes.apple.com/us/app/pittsburgh-convention-center/id519070355?ls=1&mt=8" "DLCC App in App Store"><img alt="Download on the App Store" src="/img/app-store.svg" /></a>
                <a href="http://play.google.com/store/apps/details?id=com.imswift.pittsburgh" title="DLCC App in Google Play"><img alt="Android app on Google Play" src="http://developer.android.com/images/brand/en_app_rgb_wo_45.png" /></a>
            </div>
        
        </section>
    </div>
    <div class="content-grid-row">
        <div class="upcoming-events-home highlight">
            <h2>Upcoming Events</h2>
            <div class="upcoming-event">
                <a href="#">ISAAC Bienniel Conference</a>
                <p>July 28 – August 4, 2012</p>
            </div>
            <div class="upcoming-event">
                <a href="#">IEE International Symp. on Electromagnetic Compatibility</a>
                <p>August 5 – 10, 2012</p>
            </div>
        </div>
    </div>    
    <div class="content-grid-row">
        <section class="col col-first highlight highlight-video clearfix">
            <!-- TODO: insert relevant title here -->
            <img class="vimeo-image" src="/img/placeholders/vimeo.png" />
            <a class="more-videos-link" href="#">View More Videos &raquo;</a>
        </section>
        <section class="col col-last highlight highlight-fact">
            <p>In 2011, the DLCC <strong>recycled 89 tons</strong> of paper &amp; cardboard.</p>
            <a href="http://www.greenfirst.us/" title="Our green practices">Learn more about our green practices &raquo;</a>
        </section>
    </div>
</div>
<!-- ending div is in foot.inc.php -->
<?php include "partials/foot.inc.php";
