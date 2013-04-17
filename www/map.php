<?php
$headerImage = '/images/headers/' . 'header_' . rand(1,14) . '.jpg';
?>

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

        <!-- Stylesheets unchanged from boilerplate -->
        <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.24.custom.css">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/map.css">

        <!--
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        No need for modernizr at the moment, just html5shiv. Inline script here manually removes no-js.
        -->
        <script>
        var docEl = document.documentElement;
        docEl.className = docEl.className.replace(/(^|\s)no-js(\s|$)/, '$1$2') + 'js';
        </script>

        <!-- load this ASAP to avoid FLOC -->
        <script src="js/vendor/respond.min.js"></script>

    </head>
    <body class="page-interactive-map">
        <header class="page-header" style="background-image: url('<?php print $headerImage; ?>');">
            <div class="page-wrap clearfix"> <!-- keep header content constrained to page width -->
                <a href="/index.php" title="David L. Lawrence Convention Center">
                    <img class="logo" src="/images/DLCC_Logo_Full.png" alt="David L. Lawrence Convention Center" />
                </a>
                <p class="tagline">Built Green,<br />
                   Working Green,<br />
                   Everyday!
                </p>
            </div> <!-- end .page-wrap -->

        </header>

        <!-- All structural page markup should be within this "main" div. Anything more
             dynamic is either handled by the templates below, or within the various
             Javascript view render calls. -->
        <div id="main">
            <div id="category-filter">
                <h3>Click to View:</h3>
                <ul>
                    <li class="restaurants" 
                        data-bind="css: { active: restaurants.isVisible() }, 
                                   click: restaurants.toggleVisibility">
                    </li>
                    <li class="parking" 
                        data-bind="css: { active: parking.isVisible() }, 
                                   click: parking.toggleVisibility">
                    </li>
                    <li class="hotels" 
                        data-bind="css: { active: hotels.isVisible() }, 
                                   click: hotels.toggleVisibility">
                    </li>
                    <li class="attractions" 
                        data-bind="css: { active: attractions.isVisible() }, 
                                   click: attractions.toggleVisibility">
                    </li>
                </ul>
            </div>
            <h3 class="walk">within a 15-minute walk from the DLCC:</h3>
            <div id="directory-map"></div>


            <div id="directory-list"></div>
        </div>
        <div id="mobile-notice">
            <p>We're sorry, but the interactive map is not supported for mobile devices.</p>
        </div>

        <!-- Scripts to run app -->
        <script src="js/vendor/jquery-1.8.2.min.js"></script>
        <script src="js/vendor/jquery-ui-1.8.24.custom.min.js"></script>

        <script src="js/vendor/underscore-min.js"></script>

        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC7INTXYluYDoz0yZRX89jLORKJEGeQeCY&sensor=false"></script>
        <script src="js/vendor/infobubble.min.js"></script>

        <script src="js/vendor/knockout-2.2.1.js"></script>

        <!-- TODO: minify and condense scripts -->

        <script src="js/map/init.js"></script>

        <?php
        # generate JSON from DB place data
        print "<script>app.data={};";
        $categories = array('restaurant', 'parking', 'hotel', 'attraction');
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=dlcc', 'root', '');
            foreach ($categories as $category) {
                $statement = $dbh->prepare("SELECT * from $category");
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                print "app.data.${category}Objs=" . json_encode($results) . ";";
            }
            print "</script>";
        } catch (PDOException $e) {
            print "</script>";
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        $dbh = null;
        ?>

        <script src="js/map/main-ko.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-9185606-2'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

        <!-- Dynamic templates -->

        <!-- Map InfoWindow template

             Variables:
             - name
             - address
         -->
        <script type="text/html" id="tpl-infowindow-restaurant">
        <div class="map-popup place-detail">
            <h2 class="restaurantdetail"><%= name %></h2>
            <dl>
                <dt>Address</dt>
                <dd><%= address %></dd>

                <dt>Type</dt>
                <dd><%= type %></dd>

                <dt>Price</dt>
                <dd><%= price %></dd>
            </dl>
        </div>
        </script>

        <script type="text/html" id="tpl-infowindow-hotel">
        <div class="map-popup place-detail">
            <h2 class="hoteldetail"><%= name %></h2>
            <dl>
                <dt>Address</dt>
                <dd><%= address %></dd>
                <dt>Phone</dt>
                <dd><%= phone %></dd>
            </dl>
        </div>
        </script>

        <script type="text/html" id="tpl-infowindow-parking">
        <div class="map-popup place-detail">
            <h2 class="parkingdetail"><%= name %></h2>
            <dl>
                <dt>Address</dt>
                <dd><%= address %></dd>
            </dl>
        </div>
        </script>

        <script type="text/html" id="tpl-infowindow-attraction">
        <div class="map-popup place-detail">
            <h2 class="attractiondetail"><%= name %></h2>
            <dl>
                <dt>Address</dt>
                <dd><%= address %></dd>
            </dl>
        </div>
        </script>

        <!-- TODO: impl this with native templating
        <script type="text/html" id="tpl-listitem">
            <li data-cid="{{cid}}">{{name}}</li>
        </script>

    </body>
</html>
