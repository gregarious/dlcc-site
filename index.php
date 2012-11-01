<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<!-- 
        <link rel="stylesheet" href="css/normalize.css">
 -->        <link rel="stylesheet" href="css/main.css">

        <!-- No need for modernizr at the moment -->
        <!-- TODO: reenable external hosting link to shiv and jQuery
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script> -->
        <!-- TODO: if not including modernizr, get rid of no-js class manually -->
        <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <header id="page-header" style="background-image: url('/img/headers/header_1.jpg');">
            <div class="container">
                <a href="#site-nav" title="Shortcut to Menu" class="site-nav-shortcut">Full Menu</a>
                <a href="/" title="David L. Lawrence Convention Center">
                    <!-- TODO: get screen-size appropriate res image for this? -->
                    <img class="logo" src="/img/DLCC_Logo_Full.png" alt="David L. Lawrence Convention Center" />
                </a>
            </div>
        </header>
        <div class="container clearfix">
            <div id="main-wrap">
                <div id="main-content">
                    <?php include "partials/home.inc.php"; ?>
                </div>
                <aside id="main-aside">
                    <nav id="site-nav">
                        <ul class="clearfix">
                            <li><a href="#" title="Our Building"><img src="/img/nav/Nav_Building.png" width="91" height="79"></a></li>
                            <li><a href="#" title="Our Services"><img src="/img/nav/Nav_Services.png" width="91" height="79"></a></li>
                            <li><a href="#" title="Explore Pittsburgh"><img src="/img/nav/Nav_ExplorePGH.png" width="91" height="79"></a></li>
                            <li><a href="#" title="The DLCC Neighborhood"><img src="/img/nav/Nav_DLCCneighborhood.png" width="91" height="79"></a></li>
                            <li><a href="#" title="Directions &amp; Parking"><img src="/img/nav/Nav_DirectionsParking.png" width="91" height="79"></a></li>
                            <li><a href="#" title="Events"><img src="/img/nav/Nav_Events.png" width="91" height="79"></a></li>
                            <li><a href="#" title="About Us"><img src="/img/nav/Nav_Contact.png" width="91" height="79"></a></li>
                            <li><a href="#" title="Contact Us"><img src="/img/nav/Nav_Contact.png" width="91" height="79"></a></li>
                            <li><a href="#" title="Home"><img src="/img/nav/Nav_Contact.png" width="91" height="79"></a></li>
                        </ul>
                        
                    </nav>
                </aside>
                <footer id="page-footer">
                    <p>&copy; Copyright David L. Lawrence Convention Center <br />
                    1000 Ft. Duquesne Blvd., Pittsburgh, PA 15222 <br />
                    (412) 565-6000 | <a href="mailto:info@pittsburghcc.com" title="Contact us" class="mailto">info@pittsburghcc.com</p>
                </footer>
            </div>
        </div>
        </div>

        <!-- TODO: reenable external hosting link to shiv and jQuery
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
