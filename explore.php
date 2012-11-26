<?php 
include "partials/settings.inc.php";
if (function_exists('getSiteTitle')) {
    $siteTitle = getSiteTitle('Explore Pittsburgh');
}
include "partials/head.inc.php"; ?>

<div id="main-content" class="content-explorepgh">    <!-- will be closed in foot.inc.php -->
<h1 class="content-heading">Explore Pittsburgh</h1>
    
    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.visitpittsburgh.com/" target="_blank"><img src="/img/visit_pittsburgh.jpg" alt="Visit Pittsburgh Logo" /></a>
        <div class="explore-description">
            <h2><a href="http://www.visitpittsburgh.com/" target="_blank">Visit Pittsburgh</a></h2>
            <p>The official destination marketing/tourist promotion agency.</p>
        </div>
    </div>

    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.alleghenyconference.org/" target="_blank"><img src="/img/allegheny_conference.jpg" alt="Allegheny Conference Logo" /></a>
        <div class="explore-description">
            <h2><a href="http://www.alleghenyconference.org/" target="_blank">Allegheny Conference on Community Development and it's affiliates</a></h2>
            <p>A cooperative initiative of non-profit and private sector organizations (including the Pittsburgh Regional Alliance, Greater Pittsburgh Chamber of Commerce and Pennsylvania Economy League) dedicated to economic growth and regional improvement.</p>
        </div>
    </div>

    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.downtownpittsburgh.com/" target="_blank"><img src="/img/downtown_partnership.jpg" alt="Downtown Pittsburgh Partnership Logo" /></a>
        <div class="explore-description">
            <h2><a href="http://www.downtownpittsburgh.com/" target="_blank">Pittsburgh Downtown Partnership</a></h2>
            <p>A progressive organization with a commitment to making Pittsburgh a vibrant, viable place for business and pleasure.</p>
        </div>
    </div>

    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.alleghenycounty.us/" target="_blank"><img src="/img/allegheny_county.jpg" alt="Allegheny County Logo" /></a>
        <div class="explore-description">
            <h2><a href="http://www.alleghenycounty.us/" target="_blank">County of Allegheny</a></h2>
            <p>Official government agency providing services to Pittsburgh and its county &ndash; Allegheny.</p>
        </div>
    </div>

    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.pgharts.org/" target="_blank"><img src="/img/cultural_trust.jpg" alt="Pittsburgh Cultural Trust Logo" /></a>
        <div class="explore-description">
            <h2><a href="http://www.pgharts.org/" target="_blank">Pittsburgh Cultural Trust</a></h2>
            <p>A nonprofit organization that develops and promotes the downtown arts and entertainment district.</p>
        </div>
    </div>

    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.city.pittsburgh.pa.us/" target="_blank"><img src="/img/pittsburgh_seal.jpg" alt="City of Pittsburgh Logo" /></a>
        <div class="explore-description">
            <h2><a href="http://www.city.pittsburgh.pa.us/" target="_blank">City of Pittsburgh</a></h2>
            <p>Official government agency that oversees many city services ranging from public safety to parks and recreation.</p>
        </div>
    </div>

    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.pitairport.com/" target="_blank"><img src="/img/airport_authority.jpg" alt="Allegheny County Airport Logo" /></a>
        <div class="explore-description">
            <h2><a href="http://www.pitairport.com/" target="_blank">Pittsburgh International Airport</a></h2>
            <p>The official airport serving Pittsburgh (PIT).</p>
        </div>
    </div>

    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.erh.noaa.gov/pbz/" target="_blank"><img src="/img/nwsright.jpg" alt="National Weather Service Log0" /></a>
        <div class="explore-description">
            <h2><a href="http://www.erh.noaa.gov/pbz/" target="_blank">National Weather Service</a></h2>
            <p>Provides current weather and forecasts for Pittsburgh.</p>
        </div>
    </div>

    <div class="explore-item clearfix">
        <a class="image-link" href="http://www.pittsburghbuzz.com/eventlisting/index.asp" target="_blank"><img src="/img/pittsburghbuzz.jpg" alt="Pittsburgh Buzz Logo" /></a>
        <div class="explore-description">
            <h2><a href="http://www.pittsburghbuzz.com/eventlisting/index.asp" target="_blank">Upcoming Entertainment and Events</a></h2>
            <p>Your source for current and upcoming Pittsburgh events and entertainment listings.</p>
        </div>
    </div>
</div>
<?php include "partials/foot.inc.php";
