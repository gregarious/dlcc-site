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
                                   click: function(){categoryClicked('restaurants');}">
                    </li>
                    <li class="parking" 
                        data-bind="css: { active: parking.isVisible() }, 
                                   click: function(){categoryClicked('parking');}">
                    </li>
                    <li class="hotels" 
                        data-bind="css: { active: hotels.isVisible() }, 
                                   click: function(){categoryClicked('hotels');}">
                    </li>
                    <li class="attractions" 
                        data-bind="css: { active: attractions.isVisible() }, 
                                   click: function(){categoryClicked('attractions');}">
                    </li>
                </ul>
            </div>
            <h3 class="walk">within a 15-minute walk from the DLCC:</h3>
            <div id="directory-map"></div>


            <div id="directory-list">
                <ul>
                    <li class="tab-nav tab-nav-restaurants" 
                        data-bind="visible: restaurants.isVisible()">
                        <a href="#tab-restaurants">Restaurants</a>
                    </li>
                    <li class="tab-nav tab-nav-parking"
                        data-bind="visible: parking.isVisible()">
                        <a href="#tab-parking">Parking</a>
                    </li>
                    <li class="tab-nav tab-nav-hotels"
                        data-bind="visible: hotels.isVisible()">
                        <a href="#tab-hotels">Hotels</a>
                    </li>
                    <li class="tab-nav tab-nav-attractions"
                        data-bind="visible: attractions.isVisible()">
                        <a href="#tab-attractions">Attractions</a>
                    </li>
                </ul>
                <div class="category-tab category-restaurant"
                     id="tab-restaurants"
                     data-bind="visible: restaurants.isVisible()">
                    <ul data-bind="foreach: restaurants.objects">
                        <li data-bind="text: name, click: markerClicked"></li>
                    </ul>
                </div>
                <div class="category-tab category-parking"
                     id="tab-parking"
                     data-bind="visible: parking.isVisible()">
                    <ul data-bind="foreach: parking.objects">
                        <li data-bind="text: name, click: markerClicked"></li>
                    </ul>
                </div>
                <div class="category-tab category-hotel"
                     id="tab-hotels"
                     data-bind="visible: hotels.isVisible()">
                    <ul data-bind="foreach: hotels.objects">
                        <li data-bind="text: name, click: markerClicked"></li>
                    </ul>
                </div>
                <div class="category-tab category-attraction"
                     id="tab-attractions"
                     data-bind="visible: attractions.isVisible()">
                    <ul data-bind="foreach: attractions.objects">
                        <li data-bind="text: name, click: markerClicked"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="mobile-notice">
            <p>We're sorry, but the interactive map is not supported for mobile devices.</p>
        </div>

        <!-- Scripts to run app -->
        <script src="js/vendor/jquery-1.8.2.min.js"></script>
        <script src="js/vendor/jquery-ui-1.8.24.custom.min.js"></script>

        <script>
        $(function() {
            $( "#directory-list" ).tabs();
        });
        </script>

        <script src="js/vendor/underscore-min.js"></script>

        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC7INTXYluYDoz0yZRX89jLORKJEGeQeCY&sensor=false"></script>
        <script src="js/vendor/infobubble.min.js"></script>

        <script src="js/vendor/knockout-2.2.1.js"></script>

        <script src="js/map/init.js"></script>

        <script type="text/javascript">
            app.data={};
            <?php
            $categories = array('restaurant', 'parking', 'hotel', 'attraction');

            // set up DB connection
            $path = realpath('_private/config.ini');
            if (!$path) {
                die ('Unable to access configuration settings');
            }
            $config = parse_ini_file($path, true);

            $dbopts = $config['database'];
            $conn = mysql_connect($dbopts['host'], $dbopts['username'], $dbopts['password']) or die('Could not connect: ' . mysql_error());
            mysql_select_db($dbopts['name']) or die('Could not select database');
                
            foreach ($categories as $category) {
                $query = sprintf('SELECT * FROM `%s` ORDER BY `name`', $category);
                $cursor = mysql_query($query);

                // add the queried results to the correct group
                $results = array();
                while ($obj = mysql_fetch_array($cursor, MYSQL_ASSOC)) {
                    array_push($results, $obj);
                }
                print "app.data.${category}Objs=" . json_encode($results) . ";";
            }
            mysql_close();
            ?>
        </script>

        <script src="js/map/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-9185606-2'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

        <!-- Dynamic templates -->

        <script type="text/html" id="tpl-infowindow-restaurant">
        <div class="map-popup place-detail">
            <h2 class="restaurantdetail"><%= name %></h2>
            <dl>
                <dt>Address</dt>
                <dd><%= address %></dd>

                <% if (typeof(phone) !== "undefined") { %>
                    <dt>Phone</dt>
                    <dd><%= phone %></dd>
                <% } %>

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
    </body>
</html>
