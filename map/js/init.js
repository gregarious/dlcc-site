// sets up a bunch of random globals and the app namespace

(function(){
    app = {};

    app.markerGenerator = (function() {
        var cachedMarkers = {};
        var cachedShadow = null;

        var generator = {};

        generator.getMarker = function(color) {
            var cached = cachedMarkers[color];
            if (cached) {
                return cached;
            }

            var marker = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + color,
                        new google.maps.Size(21, 34),
                        new google.maps.Point(0,0),
                        new google.maps.Point(10, 34));
            if (marker) {
                cachedMarkers[color] = marker;
            }
            return marker;
        };

        generator.getShadow = function() {
            if (cachedShadow) {
                return cachedShadow;
            }

            var markerShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
                                new google.maps.Size(40, 37),
                                new google.maps.Point(0, 0),
                                new google.maps.Point(12, 35));
            cachedShadow = markerShadow;
            return markerShadow;
        };

        return generator;
    })();
})();