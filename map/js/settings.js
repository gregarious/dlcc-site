(function() {
    app.categorySettings = {
        restaurant: {
            label: 'Restaurants',
            enabled: false,
            mapMarkerImage: 'images/restaurant_marker.png'
        },
        hotel: {
            label: 'Hotels',
            enabled: false,
            mapMarkerImage: 'images/hotel_marker.png'
        },
        parking: {
            label: 'Parking',
            enabled: false,
            mapMarkerImage: 'images/parking_marker.png'
        },
        attraction: {
            label: 'Attractions',
            enabled: false,
            mapMarkerImage: 'images/attraction_marker.png'
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

    app.hubSettings = {
        title: 'David L. Lawrence Convention Center',
        markerImage: 'images/star.png',
        location: {      // location of the DLCC
            lat: 40.4453790,
            lng: -79.99593999999999
        }
    };
})();