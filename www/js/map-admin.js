/*
	Plug-in that connects latitude/longitude input fields to
	an interactive map. Totally fixed to DOM and geography of current
	project, but could be generalized fairly easily.
 */
$(function(){
	// constants
	var centerLat = 40.444972,
		centerLng = -80.000145,
		boundsSW = "40.418724,-80.043983",
		boundsNE = "40.474636,-79.946823";

	// state
	var location = {
			latitude: null,
			longitude: null
		},
		map = null,
		marker = null;

	// jQuery/DOM elements
	var inputLat = $('.input-lat'),
		inputLng = $('.input-lng'),
		inputAddress = $('.input-address'),
		buttonGeocode = $('.btn-geocode'),
		labelGeocodingStatus = $('.geocoding-status');

	var mapEl = document.getElementById('gmap');

	function init() {
		location.latitude = inputLat.val();
		location.longitude = inputLng.val();

		if (location.latitude && location.longitude) {
			center = new google.maps.LatLng(location.latitude, location.longitude);
			marker = new google.maps.Marker({position: center});
		}
		else {
			center = new google.maps.LatLng(centerLat, centerLng);
			marker = new google.maps.Marker({position: null});
		}

		map = new google.maps.Map(mapEl, {
			center: center,
			zoom: 14,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: false
		});
		marker.setMap(map);

		// register event handlers
		buttonGeocode.on('click', geocodeAddress);

		google.maps.event.addListener(map, 'click', function(e) {
			mapClick(e.latLng.lat(), e.latLng.lng());
		});

		var inputEventName = ('oninput' in inputLat[0]) ? 'input' : 'propertychange';
		console.log('using input event: ' + inputEventName);
		inputLat.on(inputEventName, latInputChange);
		inputLng.on(inputEventName, lngInputChange);
	}

	function syncMarker() {
		if (location.latitude && location.longitude) {
			position = new google.maps.LatLng(location.latitude, location.longitude);
		}
		else {
			position = null;
		}
		marker.setPosition(position);

		if (position) {
			map.panTo(position);
		}
	}

	function syncLatLngInputs() {
		if (inputLat.val() != location.latitude) {
			inputLat.val(location.latitude);
			inputLat.stop()
					.animate({ backgroundColor: "#5bc0de"}, 50)
					.animate({ backgroundColor: "#ffffff"}, 900);
		}

		if (inputLng.val() != location.longitude) {
			inputLng.val(location.longitude);
			inputLng.stop()
					.animate({ backgroundColor: "#5bc0de"}, 50)
					.animate({ backgroundColor: "#ffffff"}, 900);
		}
	}

	function syncAll() {
		syncMarker();
		syncLatLngInputs();
	}

	var mapUpdateTimeoutID = null;
	function syncMarkerWithDelay(delay) {
		if (typeof delay === 'undefined') {
			delay = 400;
		}

		if (mapUpdateTimeoutID) {
			window.clearTimeout(mapUpdateTimeoutID);
		}

		mapUpdateTimeoutID = setTimeout(function(){
			syncMarker();
			mapUpdateTimeoutID = null;
		}, delay);
	}

	// UI binding functions
	function latInputChange(lat) {
		location.latitude = inputLat.val();
		// Need to update marker position, but if one is
		// already there, give it a second before updating
		// to avoid thrashing on rapid text input changes
		if (marker.getPosition()) {
			syncMarkerWithDelay();
		}
		else {
			syncMarker();
		}
	}

	function lngInputChange(lat) {
		location.longitude = inputLng.val();
		// Need to update marker position, but if one is
		// already there, give it a second before updating
		// to avoid thrashing on rapid text input changes

		if (marker.getPosition()) {
			syncMarkerWithDelay();
		}
		else {
			syncMarker();
		}
	}

	function mapClick(lat, lng) {
		clearStatus();
		location.latitude = lat.toFixed(6);
		location.longitude = lng.toFixed(6);
		syncAll();
	}

	function displaySuccessfulStatus(text) {
		labelGeocodingStatus.text(text)
							.removeClass('status-error')
							.addClass('status-success');
	}

	function displayErrorStatus(text) {
		labelGeocodingStatus.text(text)
		labelGeocodingStatus.removeClass('status-success')
							.addClass('status-error');
	}

	function clearStatus() {
		labelGeocodingStatus.text('')
							.removeClass('status-error status-success');
	}

	function clearLocation() {
		location.latitude = null;
		location.longitude = null;
		syncAll();

		return false;
	}

	function geocodeAddress() {
		var address = inputAddress.val();
		if (!address) {
			displayErrorStatus('Invalid address');
			return false;
		}

		var url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false" +
					"&bounds=" + boundsSW + "|" + boundsNE +
					"&address=" + encodeURIComponent(address);

		clearStatus();

		var geocoding = $.getJSON(url);
		$.getJSON(url)
			.done(function(data, textStatus, jqXHR) {
				if (data.status === 'OK') {
					var resultLat, resultLng;
					try {
						resultLat = data.results[0].geometry.location.lat.toFixed(6);
						resultLng = data.results[0].geometry.location.lng.toFixed(6);
					}
					catch(e) {
						displayErrorStatus('Unexpected API response format');
						return;
					}

					location.latitude = resultLat;
					location.longitude = resultLng;
					syncAll();

					displaySuccessfulStatus('Address successfully geolocated!');
				}
				else if(data.status === 'ZERO_RESULTS') {
					displayErrorStatus('Could not geolocate the given address');
				}
				else {
					displayErrorStatus('Geolocation service refused the request (status: ' + data.status + ')');
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				displayErrorStatus('Error contacting geocoding service (' + textStatus + ').');
			});

		return false;
	}

	init();
});