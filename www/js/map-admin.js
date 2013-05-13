// DOM requirements:
// 
// <input name='lat'>
// <input name='lng'>
// <input name='address'>
// clickable .btn-geocode element
// .geocoding-status element 
// div.gmap element

$(function(){
	var latitude = null, 
		longitude = null,
		map = null,
		marker = null;

	var inputLat = $('input[name="Restaurant[lat]"]'),
		inputLng = $('input[name="Restaurant[lng]"]'),
		inputAddress = $('input[name="Restaurant[address]"]'),
		buttonGeocode = $('.btn-geocode'),
		labelGeocodingStatus = $('.geocoding-status');

	var mapEl = document.getElementById('gmap');


	function init() {
		latitude = inputLat.val();
		longitude = inputLng.val();

		if (latitude && longitude) {
			center = new google.maps.LatLng(latitude, longitude);
			marker = new google.maps.Marker({position: center});
		}
		else {
			center = new google.maps.LatLng(40.444972, -80.000145);
			marker = new google.maps.Marker({position: null});
		}

		map = new google.maps.Map(mapEl, {
			center: center,
			zoom: 14,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		marker.setMap(map);

		// register event handlers
		buttonGeocode.on('click', geocodeAddress);

		google.maps.event.addListener(map, 'click', function(e) {
			mapClick(e.latLng.lat(), e.latLng.lng());
		});

		// TODO: test IE
		var inputEventName = ('oninput' in inputLat[0]) ? 'input' : 'propertychange';
		console.log('using input event: ' + inputEventName);
		inputLat.on(inputEventName, latInputChange);
		inputLng.on(inputEventName, lngInputChange);
	}

	function updateMarker() {
		if (latitude && longitude) {
			position = new google.maps.LatLng(latitude, longitude);
		}
		else {
			position = null;
		}
		marker.setPosition(position);

		if (position) {
			map.panTo(position);
		}
	}

	function updateLatInput() {
		inputLat.val(latitude);
	}
	function updateLngInput() {
		inputLng.val(longitude);
	}

	var mapUpdateTimeoutID = null;
	function updateMarkerWithDelay(delay) {
		if (typeof delay === 'undefined') {
			delay = 400;
		}

		if (mapUpdateTimeoutID) {
			window.clearTimeout(mapUpdateTimeoutID);
		}

		mapUpdateTimeoutID = setTimeout(function(){
			updateMarker();
			mapUpdateTimeoutID = null;
		}, delay);
	}

	// UI binding functions
	function latInputChange(lat) {
		latitude = inputLat.val();
		// Need to update marker position, but if one is
		// already there, give it a second before updating
		// to avoid thrashing on rapid text input changes
		if (marker.getPosition()) {
			updateMarkerWithDelay();
		}
		else {
			updateMarker();
		}
	}

	function lngInputChange(lat) {
		longitude = inputLng.val();
		// Need to update marker position, but if one is
		// already there, give it a second before updating
		// to avoid thrashing on rapid text input changes

		if (marker.getPosition()) {
			updateMarkerWithDelay();
		}
		else {
			updateMarker();
		}
	}

	function mapClick(lat, lng) {
		latitude = lat.toFixed(6);
		longitude = lng.toFixed(6);
		// set latitude/longitude from click
		updateMarker();
		updateLngInput();
		updateLatInput();
	}

	function geocodeAddress() {
		var address = inputAddress.val();
		var statusLabel = labelGeocodingStatus;
		if (!address) {
			statusLabel.text('Invalid address');
			return false;
		}

		var geocoding = $.getJSON();	// add url
		geocoding.done(function(data) {
			if (data.results && data.results.length > 0) {
				// set lat/lng from data
				updateMarker();
				updateLngInput();
				updateLatInput();
			}
			else {
				// set statusLabel text
			}
		});
		geocoding.fail(function(err) {
			// set statusLabel text
		});

		return false;
	}

	init();
});