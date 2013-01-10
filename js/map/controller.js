(function() {
    app.rootController = (function(){
        var controller = {};

        var detailView = null;
        var detailTemplates = {};
        var categoryDetailViewMap = null;

        controller.initialize = function(catView, mapView, listView, detailTpls) {
            // Collection has the additional purpose of managing the global categorySettings
            // enabled status. This alias is just a way to reinforce that this isn't
            // something particularly inherent to a collection
            var categoryManager = app.placeCollection;

            this.categoryView = catView;
            // when categoryView button is toggled, let the manager know about it
            this.categoryView.on('toggle:category', function(category) {
                var settings = app.categorySettings[category] || {};
                var isActive = settings.enabled;
                if (_.isUndefined(settings)) {
                    // if undefined, this is an invalid category
                    return;
                }

                if (settings.enabled) {
                    categoryManager.disableCategory(category);
                }
                else {
                    categoryManager.enableCategory(category);
                }
            });

            this.mapView = mapView;
            this.mapView.on('selected:item', function(place) {
                this.mapView.showInfoWindow(place);
                this.showDetailView(place);
            }, this);

            this.listView = listView;
            this.listView.on('selected:item', function(place) {
                this.mapView.showInfoWindow(place);
                this.showDetailView(place);
            }, this);

            detailTemplates = detailTpls;
        };

        controller.renderViews = function() {
            this.categoryView.render();
            this.mapView.render();
            this.listView.render();
        };

        controller.showDetailView = function(place) {
            // no longer using the detail view
            /*
            var category = place.get('category');
            var tpl = detailTemplates[category];
            if (tpl) {
                detailView = new app.views.DetailView({
                    model: place,
                    className: 'place-detail',
                    template: tpl
                });
                $("#detail-container").html(detailView.render().el);
            }
            else {
                this.hideDetailView();
                console.log("No known template for category " + category);
            }
            */
        };

        controller.hideDetailView = function() {
            // no longer using the detail view
            /*
            if (detailView) {
                detailView.remove();
            }
            detailView = null;
            */
        };


        return controller;
    })();
})();