$(function() {
	app.map = new google.maps.Map(
		document.getElementById('directory-map'),
		app.mapOptions);

	// PlaceCollection: a ViewModel class to handle obejcts of a particular category
	var PlaceCollection = function(instances, settings) {
		
		// visibility observable and related toggle behavior function
		this.isVisible = ko.observable(settings.enabled || false);
		this.toggleVisibility = _.bind(function() {
			this.isVisible(!this.isVisible());
			_.each(this.objects(), function(obj) {
				if (obj.marker) {
					obj.marker.setMap(this.isVisible() ? app.map : null);
				}
			}, this);
		}, this);

		// observable array of objects, each holding the data for the place, 
		// the compiled InfoWindow template, and marker
		this.objects = ko.observableArray(_.map(instances, function(inst) {
			var obj = _.clone(inst);
			obj.iwTemplate = null;
			if (settings.iwTemplate) {
				obj.iwTemplate = _.template($(settings.iwTemplate).html());
			}

			if (obj.lat && obj.lng) {
				obj.marker = new google.maps.Marker({
					position: new google.maps.LatLng(obj.lat, obj.lng),
					map: this.isVisible() ? app.map : null,
					title: obj.name,
					icon: settings.markerImage || null
				});

				google.maps.event.addListener(obj.marker, 'click', function() {
					obj.markerClicked();
				});
			}
			else {
				obj.marker = null;
			}
		
			obj.markerClicked = function() {
				app.viewModel.infoWindow.open(obj);
			};

			return obj;
		}, this));
	};

	// main page ViewModel
	app.viewModel = {
		// 4 PlaceCollection VMs
		restaurants: new PlaceCollection(
			app.data.restaurantObjs, 
			app.categorySettings.restaurant),
		hotels: new PlaceCollection(
			app.data.hotelObjs, 
			app.categorySettings.hotel),
		parking: new PlaceCollection(
			app.data.parkingObjs, 
			app.categorySettings.parking),
		attractions: new PlaceCollection(
			app.data.attractionObjs, 
			app.categorySettings.attraction),

		// Singleton object to wrap a google maps info window
		infoWindow: { 
			_iw: null,
			
			// should be called with a place object
			open: function(object) {
				this.close();

				// only display if coordinates are valid
				if (object.lat && object.lng) {
					var opts = {
						map: app.map,
						content: object.iwTemplate ? object.iwTemplate(object) : 'error: no template found',
						position: new google.maps.LatLng(object.lat, object.lng)
					};
					// add the styles from settings.js
					this._iw = new InfoBubble(_.extend(opts, app.infoWindowStyle));
					this._iw.open(app.map);
				}
            },
            close: function() {
				if (this._iw) {
					this._iw.close();
				}
				this._iw = null;
            }
		},

		/* Page-level behavior */

		// sidebar category toggled: change visibility for places with this category
		categoryClicked: function(category) {
			var placesCollection = app.viewModel[category];
			placesCollection.toggleVisibility();

			// activate the recently enabled tab. jQuery selector kind of sucks, but it'll do.
			if (placesCollection.isVisible()) {
				$('.tab-nav-' + category + ' a').click();
			}
		}
	};

	if (app.hubSettings) {
        new google.maps.Marker({
            position: new google.maps.LatLng(app.hubSettings.location.lat, app.hubSettings.location.lng),
            map: app.map,
            title: app.hubSettings.title,
            icon: app.hubSettings.markerImage
        });
    }
	google.maps.event.addListener(app.map, 'click', function() {
		app.viewModel.infoWindow.close();
	});

	ko.applyBindings(app.viewModel);
});