<?php
// this file will set all of the varaibles used below
require "_settings.php";

// determine the header image randomly
$headerImage = '/images/headers/' . 'header_' . rand(1,14) . '.jpg';

// find out if on homepage if so, we use different widgets below
$isHomepage = ($page == "home");

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php print $pageTitle; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="initial-scale=1.0">

        <link rel="stylesheet" href="/css/main.css">

        <!--
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        No need for modernizr at the moment, just html5shiv. Inline script here manually removes no-js.
        -->
        <script>
        var docEl = document.documentElement;
        docEl.className = docEl.className.replace(/(^|\s)no-js(\s|$)/, '$1$2') + 'js';
        </script>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script>window.html5 || document.write('<script src="/js/vendor/html5shiv.js"><\/script>')</script>
        <script src="/js/vendor/respond.min.js"></script>
    </head>
    <body class="<?php print $pageClass; ?>">
        <header class="page-header" style="background-image: url('<?php print $headerImage; ?>');">
            <div class="page-wrap clearfix"> <!-- keep header content constrained to page width -->
                <a href="#site-nav" title="Shortcut to Menu" class="site-nav-shortcut">Full Menu</a>
                <a href="/index.php" title="David L. Lawrence Convention Center">
                    <img class="logo" src="/images/DLCC_Logo_Full.png" alt="David L. Lawrence Convention Center" />
                </a>
                <p class="tagline">Built Green,<br />
                   Working Green,<br />
                   Everyday!
                </p>
            </div> <!-- end .page-wrap -->
        </header>

        <div class="page-wrap">
            <h1 class="page-heading page-heading-outflow"><?php print $headingText; ?></h1>
            <div class="page-columns-wrap page-column-background page-column-background-secondary">
                <div class="page-column-background page-column-background-primary">
                    <div class="page-column page-column-primary">
                        <div class="primary-header">

                            <!-- picturefill.js style responsive image for header panorama -->
                            <div data-picture data-alt="Panoramic scene around The David L. Lawrence Convention Center">
                                <div data-src="<?php print $panoramaFileBase; ?>_320x148.jpg"></div>
                                <div data-src="<?php print $panoramaFileBase; ?>_653x220.jpg" data-media="(min-width: 768px)"></div>
                                <div data-src="<?php print $panoramaFileBase; ?>_746x220.jpg" data-media="(min-width: 960px)"></div>
                                <div data-src="<?php print $panoramaFileBase; ?>_986x220.jpg" data-media="(min-width: 1200px)"></div>
                                <!--[if (lt IE 9) & (!IEMobile)]>
                                    <div data-src="<?php print $panoramaFileBase; ?>_986x220.jpg"></div>
                                <![endif]-->
                                <noscript>
                                    <img src="<?php print $panoramaFileBase; ?>_320x148.jpg" alt="Panoramic scene around The David L. Lawrence Convention Center">
                                </noscript>
                            </div>

                            <?php
                            if ($isHomepage) {
                            ?>
                                <p class="tagline">
                                    Built Green,<br />
                                    Working Green,<br />
                                    Everyday!
                                </p>
                            <?php
                            }
                            ?>
                        </div>  <!-- end .primary-content-header -->
<?php
    if ($isHomepage) {
        $contentClass = "primary-content primary-content-home";
    }
    else {
        $contentClass = "primary-content primary-content-subpage";
    }
?>
                        <div class="<?php print $contentClass; ?>">
                            <h1 class="page-heading page-heading-inflow"><?php print $headingText; ?></h1>
                            <?php include $includeFile; ?>
                        </div> <!-- end .primary-content -->
                    </div>  <!-- end .page-column-primary -->

                    <aside class="page-column page-column-secondary">
                        <nav id="site-nav" class="site-nav">
                            <ul class="clearfix">
                                <li class="item-1"><a href="/building/" title="Our Building"><img src="/images/nav/Nav_Building.png" alt="Building Icon"></a></li>
                                <li class="item-2"><a href="/services.php" title="Our Services"><img src="/images/nav/Nav_Services.png" alt="Services Icon"></a></li>
                                <li class="item-3"><a href="/explore.php" title="Explore Pittsburgh"><img src="/images/nav/Nav_ExplorePGH.png" alt="Explore Pittsburgh Icon"></a></li>
                                <li class="item-4"><a href="/neighborhood.php" title="The DLCC Neighborhood"><img src="/images/nav/Nav_DLCCneighborhood.png" alt="Neighborhood Icon"></a></li>
                                <li class="item-5"><a href="/directions.php" title="Directions &amp; Parking"><img src="/images/nav/Nav_DirectionsParking.png" alt="Directions Icon"></a></li>
                                <li class="item-6"><a href="/events.php" title="Events"><img src="/images/nav/Nav_Events.png" alt="Events Icon"></a></li>
                                <li class="item-7"><a href="/aboutus.php" title="About Us"><img src="/images/nav/Nav_About.png" alt="About Icon"></a></li>
                                <li class="item-8"><a href="/contactus.php" title="Contact Us"><img src="/images/nav/Nav_Contact.png" alt="Contact Icon"></a></li>
                                <li class="item-9"><a href="/index.php" class="nav-btn-home" title="Home"><img src="/images/nav/Nav_Home.png" alt="Home Icon"></a></li>
                            </ul>
                        </nav>
                        <?php
                        if($isHomepage) {
                            include "includes/widgets-home.inc.php";
                        }
                        else {
                            include "includes/widgets-subpage.inc.php";
                        }
                        ?>
                    </aside>

                </div>  <!-- end .page-column-background-primary -->
            </div>  <!-- end .page-column-background-secondary -->

            <footer class="page-footer">
                <p>&copy; Copyright David L. Lawrence Convention Center</p>
                <p>1000 Ft. Duquesne Blvd., Pittsburgh, PA 15222 <br/>
                       (412) 565-6000 | <a href="mailto:info@pittsburghcc.com" title="Contact us" class="mailto">info@pittsburghcc.com</a></p>
            </footer>
        </div>  <!-- end .page-wrap -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

        <script src="/js/vendor/matchmedia.js"></script>
        <script src="/js/vendor/picturefill.js"></script>

        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-9185606-2'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

    </body>
</html>
