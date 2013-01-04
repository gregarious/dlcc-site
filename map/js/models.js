(function(){
    app.Place = Backbone.Model.extend({});

    // single shared instance of place store
    app.placeCollection = new (Backbone.Collection.extend({
        model: app.Place,

        categoryOrder: [
            'restaurant',
            'parking',
            'hotel',
            'attraction'
        ],

        categoryPlacesMap: {},

        initialize: function(models, options) {
            this.on('reset', function() {
                // reset the categoryPlacesMap
                this.categoryPlacesMap = {};
                this.each(function(model) {
                    var cat = model.get('category');
                    
                    // first add the model to the appropriate bucket
                    var pmap = this.categoryPlacesMap[cat];
                    if (_.isUndefined(pmap)) {
                        this.categoryPlacesMap[cat] = [];
                        pmap = this.categoryPlacesMap[cat];
                    }
                    pmap.push(model);

                    // now set it's visible attribute
                    var settings = app.categorySettings[cat] || {};
                    model.set("visible", settings.enabled);
                }, this);
            }, this);
        },

        modelsForCategory: function(category) {
            var models = this.categoryPlacesMap[category];
            return models || null;
        },

        enableCategory: function(category) {
            var settings = app.categorySettings[category];
            if (settings) {
                settings.enabled = true;

                var affectedModels = this.categoryPlacesMap[category] || [];
                _.each(affectedModels, function(model) {
                    model.set("visible", true);
                });

                this.trigger('enabled:category', category);
                console.log("enabled:category triggered");
            }
        },

        disableCategory: function(category) {
            var settings = app.categorySettings[category];
            if (settings) {
                settings.enabled = false;

                var affectedModels = this.categoryPlacesMap[category] || [];
                _.each(affectedModels, function(model) {
                    model.set("visible", false);
                });

                this.trigger('disabled:category', category);
                console.log("disabled:category triggered");
            }
        }
    }))();
})();
