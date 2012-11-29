                        </div> <!-- end .primary-content -->
                    </div>  <!-- end .page-column-primary -->
                    
                    <aside class="page-column page-column-secondary">
                        <nav class="site-nav">
                            <ul class="clearfix">
                                <!-- TODO: fix links when in building subdir -->
                                <li class="item-1"><a href="/building/" title="Our Building"><img src="/img/nav/Nav_Building.png"></a></li>
                                <li class="item-2"><a href="/services.php" title="Our Services"><img src="/img/nav/Nav_Services.png"></a></li>
                                <li class="item-3"><a href="/explore.php" title="Explore Pittsburgh"><img src="/img/nav/Nav_ExplorePGH.png"></a></li>
                                <li class="item-4"><a href="/neighborhood.php" title="The DLCC Neighborhood"><img src="/img/nav/Nav_DLCCneighborhood.png"></a></li>
                                <li class="item-5"><a href="/directions.php" title="Directions &amp; Parking"><img src="/img/nav/Nav_DirectionsParking.png"></a></li>
                                <li class="item-6"><a href="/events.php" title="Events"><img src="/img/nav/Nav_Events.png"></a></li>
                                <li class="item-7"><a href="/aboutus.php" title="About Us"><img src="/img/nav/Nav_About.png"></a></li>
                                <li class="item-8"><a href="/contactus.php" title="Contact Us"><img src="/img/nav/Nav_Contact.png"></a></li>
                                <li class="item-9"><a href="/index.php" class="nav-btn-home" title="Home"><img src="/img/nav/Nav_Home.png"></a></li>
                            </ul>
                        </nav>
                        <?php
                        if($isIndexPage) {
                            include "widgets-home.inc.php";
                        }
                        else {
                            include "widgets-subpage.inc.php";
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
        
        <!-- TODO: reenable external hosting link to shiv and jQuery
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
        <!-- TODO: remove jQuery if not using it -->
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

        <script src="/js/vendor/matchmedia.js"></script>
        <script src="/js/vendor/picturefill.js"></script>

        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>

        <!-- TODO: reenable
        <script>
            var _gaq=[['_setAccount','UA-9185606-2'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        -->

    </body>
</html>
