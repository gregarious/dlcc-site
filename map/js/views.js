(function(){
    app.views = app.views || {};
    app.views.CategoryFilterView = Backbone.View.extend({
        categoryManager: [],

        events: {
            'click li': 'categoryClicked'
        },

        initialize: function(options) {
            _.bindAll(this, 'categoryClicked', 'setCategoryStatus');

            options = options || {};
            if (options.categoryManager) {
                this.categoryManager = options.categoryManager;

                // set up the event handlers on category enabled changes
                this.categoryManager.on('enabled:category', function(category) {
                    this.setCategoryStatus(category, true);
                }, this);
                this.categoryManager.on('disabled:category', function(category) {
                    this.setCategoryStatus(category, false);
                }, this);
            }
        },

        setCategoryStatus: function(category, active) {
            var selector = '[data-category="' + category + '"]';
            if (active) {
                this.$(selector).addClass('active');
            }
            else {
                this.$(selector).removeClass('active');
            }
        },

        categoryClicked: function(e) {
            var category = $(e.target).data('category');
            this.trigger('toggle:category', category);
        },

        render: function() {
            for (var category in app.categorySettings) {
                var isActive = app.categorySettings[category].enabled;
                this.setCategoryStatus(category, isActive);
            }
            return this;
        }
    });

    app.views.MapView = Backbone.View.extend({
        mapOptions: {
          center: new google.maps.LatLng(40.4449716, -80.000145),
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        },
        markers: [],
        templates: null,
        map: null,
        currentInfoWindow: null,

        initialize: function(options) {
            _.bindAll(this, 'markerClicked', 'showInfoWindow', 'hideInfoWindow');

            options = options || {};
            this.iwTemplates = options.infoWindowTemplates;
            this.hubLocation = options.hubLocation;
        },

        markerClicked: function(place) {
            this.trigger('selected:item', place);
        },

        showInfoWindow: function(place) {
            this.hideInfoWindow();
            if (!this.iwTemplates) {
                return;
            }

            var loc = place.get('location');
            var template = this.iwTemplates[place.get('category')];

            // only create info window if mappable location exists
            if (loc && template && !_.isUndefined(loc.lat) && !_.isUndefined(loc.lng)) {
                var iwOptions = {
                    map: this.map,
                    content: template(place.attributes),
                    position: new google.maps.LatLng(loc.lat, loc.lng)
                };
                // add the styles from settings.js
                _.extend(iwOptions, app.infoWindowStyle);
                var iw = new InfoBubble(iwOptions);
                iw.open(this.map);
                this.currentInfoWindow = iw;
            }
        },

        hideInfoWindow: function() {
            if (this.currentInfoWindow) {
                this.currentInfoWindow.close();
            }
            this.currentInfoWindow = null;
        },

        render: function() {
            if (!this.map) {
                this.map = new google.maps.Map(this.el, this.mapOptions);
                var callback = this.hideInfoWindow;
                google.maps.event.addListener(this.map, 'click', callback);
            }

            // clear all markers
            _.each(this.markers, function(marker) {
                marker.map = null;
            });

            if (app.hubSettings) {
                // set up the basic marker options
                var hubMarkerOptions = {
                    position: new google.maps.LatLng(app.hubSettings.location.lat, app.hubSettings.location.lng),
                    map: this.map,
                    title: app.hubSettings.title,
                    icon: app.hubSettings.markerImage
                };
                this.markers.push(new google.maps.Marker(hubMarkerOptions));
            }

            if(!this.collection) {
                return this;
            }

            var settings = app.categorySettings;
            this.collection.each(function(model) {
                var loc = model.get('location');
                var category = model.get('category');
                var catSettings = settings[category] || {};
                // only draw a marker if it has a valid lat & lng
                if (loc && !_.isUndefined(loc.lat) && !_.isUndefined(loc.lng)) {
                    var mapOrNull = catSettings.enabled ? this.map : null;
                    var markerImage = catSettings.mapMarkerImage;
                    // set up the basic marker options
                    var markerOptions = {
                        position: new google.maps.LatLng(loc.lat, loc.lng),
                        map: mapOrNull,
                        title: model.get('name'),
                        icon: markerImage
                    };

                    // using custom icons now. unnecessary
                    // // try to add a custom color to the marker based on category
                    // if (catSettings && catSettings.color) {
                    //     markerOptions.icon = app.markerGenerator.getMarker(catSettings.color);
                    //     markerOptions.shadow = app.markerGenerator.getShadow();
                    // }

                    // actually create the new marker
                    var newMarker = new google.maps.Marker(markerOptions);

                    // set up the markerClicked callback
                    var callback = _.bind(function() {
                        this.markerClicked(model);
                    }, this);
                    google.maps.event.addListener(newMarker, 'click', callback);

                    // bind model visibility changes directly to marker
                    model.on('change:visible', function() {
                        if (model.get('visible')) {
                            newMarker.setMap(this.map);
                        }
                        else {
                            newMarker.setMap(null);
                        }
                    }, this);

                    this.markers.push(newMarker);
                }
            }, this);
            return this;
        }
    });

    app.views.ListView = Backbone.View.extend({
        events: {
            'click li': 'itemClicked'
        },

        initialize: function() {
            _.bindAll(this, 'itemClicked', 'setCategoryVisibility');

            this.collection.on('enabled:category', function(category) {
                this.setCategoryVisibility(category, true);
            }, this);
            this.collection.on('disabled:category', function(category) {
                this.setCategoryVisibility(category, false);
            }, this);
        },

        itemClicked: function(e) {
            var placeCid = $(e.target).data('cid');
            var place = this.collection.getByCid(placeCid);
            this.trigger('selected:item', place);
        },

        setCategoryVisibility: function(category, visible) {
            var itemIndex = this.collection.categoryOrder.indexOf(category);

            // if category was found, work with it
            if (itemIndex != -1) {
                var tabNavDOM = this.$('.ui-tabs-nav li')[itemIndex];
                var tabContent = this.$('#tab-' + category);
                if (visible) {
                    $(tabNavDOM).show();
                    tabContent.show();
                    this.$el.tabs('select', '#tab-' + category);
                }
                else {
                    $(tabNavDOM).hide();
                    tabContent.hide();
                }
            }
        },

        render: function() {
            this.$el.empty();
            if(!this.collection) {
                return this;
            }

            var categories = this.collection.categoryOrder;

            var tabNav = $('<ul>');
            this.$el.append(tabNav);

            _.each(categories, function(category) {
                var settings = app.categorySettings[category] || {};

                // first, create the tab index li
                var navTab = $('<li class="tab-nav tab-nav-' + category + '"><a href="#tab-' + category + '">' + settings.label + '</a></li>');
                tabNav.append(navTab);

                // now create teh content of the tab
                // TODO: create template for this
                var tabHTML = '<div class="category-tab category-' + category + '" id="tab-' + category + '">';
                //tabHTML += '<h3>' + settings.label + '</h3>';
                tabHTML += '<ul>';

                // cycle through models and print list items
                var models = this.collection.modelsForCategory(category) || [];
                _.each(models, function(model) {
                    tabHTML += '<li data-cid="' + model.cid + '">' + model.get('name') + '</li>';
                }, this);

                // finish wrapper div
                tabHTML += "</ul></div>";

                var $tab = $(tabHTML);

                // append the tab directly to the DOM, tabs() call below will process it
                this.$el.append($tab);


            }, this);

            // transforms this elements DOM into jQueryUI tabs
            this.$el.tabs();

            // for each disabled category, hide visibility manually
            // TODO: revisit this
            _.each(categories, function(category) {
                var settings = app.categorySettings[category] || {};
                if (!settings.enabled) {
                    this.setCategoryVisibility(category, false);
                }
            }, this);


            return this;
        }
    });

    app.views.DetailView = Backbone.View.extend({
        template: null,

        initialize: function(options)
        {
            options = options || {};
            this.template = options.template;
        },

        render: function() {
            if(this.model && this.template) {
                this.$el.html(this.template(this.model.attributes));
            }
            return this;
        }
    });
})();
