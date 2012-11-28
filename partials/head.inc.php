<?php
    if(!isset($siteTitle)) {
        $siteTitle = 'The David L. Lawrence Convention Center';
    }

    // determine the header image randomly
    $headerImage = '/img/headers/' . 'header_' . rand(1,14) . '.jpg';

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php print $siteTitle; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="initial-scale=1.0">

        <link rel="stylesheet" href="/css/main.css">

        <!-- No need for modernizr at the moment -->
        <!-- TODO: reenable external hosting link to shiv and jQuery
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script> -->
        <!-- TODO: link to minimized scripts -->
        <!-- TODO: if not including modernizr, get rid of no-js class manually -->
        <script>window.html5 || document.write('<script src="/js/vendor/html5shiv.js"><\/script>')</script>
    </head>
    <body>
        <header class="page-header" style="background-image: url('<?php print $headerImage; ?>');">
            <div class="page-wrap clearfix"> <!-- keep header content constrained to page width -->
                <a href="#site-nav" title="Shortcut to Menu" class="site-nav-shortcut">Full Menu</a>
                <a href="/index.php" title="David L. Lawrence Convention Center">
                    <!-- TODO: get screen-size appropriate res image for this? -->
                    <img class="logo" src="/img/DLCC_Logo_Full.png" alt="David L. Lawrence Convention Center" />
                </a>
                <p class="tagline">Built Green,<br />
                   Working Green,<br />
                   Everyday!
                </p>
            </div> <!-- end .page-wrap -->
        </header>
        <div class="page-wrap">
            <div class="page-columns-wrap page-column-background page-column-background-secondary">
                <div class="page-column-background page-column-background-primary">
                    <div class="page-column page-column-primary">
                        <div class="primary-header">
                            <?php
                            if ($isBuildingSubpage) {
                            ?>
                                <!-- picturefill.js style responsive image for interior -->
                                <div data-picture data-alt="Skyline view of The David L. Lawrence Convention Center">
                                    <div data-src="/img/headers/interior_320x148.jpg"></div>
                                    <div data-src="/img/headers/interior_653x220.jpg" data-media="(min-width: 768px)"></div>
                                    <div data-src="/img/headers/interior_746x220.jpg" data-media="(min-width: 960px)"></div>
                                    <div data-src="/img/headers/interior_986x220.jpg" data-media="(min-width: 1200px)"></div>
                                    <noscript>
                                        <img src="/img/headers/interior_320x148.jpg" alt="Skyline view of The David L. Lawrence Convention Center">
                                    </noscript>
                                </div>
                            <?php
                            } else {
                            ?>
                                <!-- picturefill.js style responsive image for skyline -->
                                <div data-picture data-alt="Skyline view of The David L. Lawrence Convention Center">
                                    <div data-src="/img/headers/home_320x148.jpg"></div>
                                    <div data-src="/img/headers/home_653x220.jpg" data-media="(min-width: 768px)"></div>
                                    <div data-src="/img/headers/home_746x220.jpg" data-media="(min-width: 960px)"></div>
                                    <div data-src="/img/headers/home_986x220.jpg" data-media="(min-width: 1200px)"></div>
                                    <noscript>
                                        <img src="/img/headers/home_320x148.jpg" alt="Skyline view of The David L. Lawrence Convention Center">
                                    </noscript>
                                </div>

                                <p class="tagline">
                                    Built Green,<br />
                                    Working Green,<br />
                                    Everyday!
                                </p>
                            <?php
                            }
                            ?>
                        </div>  <!-- end .primary-content-header -->
                        <div class="primary-content">
