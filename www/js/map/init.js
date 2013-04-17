// sets up a bunch of random globals and the app namespace

(function(){
    app = {};

    app.categorySettings = {
        restaurant: {
            label: 'Restaurants',
            enabled: false,
            markerImage: 'images/map/restaurant_marker.png',
            iwTemplate: '#tpl-infowindow-restaurant'
        },
        hotel: {
            label: 'Hotels',
            enabled: false,
            markerImage: 'images/map/hotel_marker.png',
            iwTemplate: '#tpl-infowindow-hotel'
        },
        parking: {
            label: 'Parking',
            enabled: false,
            markerImage: 'images/map/parking_marker.png',
            iwTemplate: '#tpl-infowindow-parking'
        },
        attraction: {
            label: 'Attractions',
            enabled: false,
            markerImage: 'images/map/attraction_marker.png',
            iwTemplate: '#tpl-infowindow-attraction'
        }
    };

    app.infoWindowStyle = {
        padding: 0,

        backgroundColor: '#fff',

        borderRadius: 3,
        borderWidth: 1,
        borderColor: '#2c2c2c',
        shadowStyle: 1,

        hideCloseButton: false,

        arrowSize: 10,
        arrowPosition: 30,
        arrowStyle: 2
    };

    app.mapOptions = {
        center: new google.maps.LatLng(40.4449716, -80.000145),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    app.hubSettings = {
        title: 'David L. Lawrence Convention Center',
        markerImage: 'images/map/star.png',
        location: {      // location of the DLCC
            lat: 40.4453790,
            lng: -79.99593999999999
        }
    };
})();