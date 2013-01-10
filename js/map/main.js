

$(function(){

    app.placeCollection.reset(app.data);

    var categoryView = new app.views.CategoryFilterView({
        el: $("#category-filter"),
        categoryManager: app.placeCollection    // placeCollection does double duty
    });

    mapView = new app.views.MapView({
        el: $("#directory-map"),
        infoWindowTemplates: {
            'restaurant': Handlebars.compile($('#tpl-infowindow-restaurant').html()),
            'hotel': Handlebars.compile($('#tpl-infowindow-hotel').html()),
            'parking': Handlebars.compile($('#tpl-infowindow-parking').html()),
            'attraction': Handlebars.compile($('#tpl-infowindow-attraction').html())
        },
        collection: app.placeCollection
    });

    var listView = new app.views.ListView({
        el: $("#directory-list"),
        collection: app.placeCollection
    });

    var templates = {
        restaurant: Handlebars.compile($('#tpl-restaurant').html()),
        hotel: Handlebars.compile($('#tpl-hotel').html()),
        parking: Handlebars.compile($('#tpl-parking').html()),
        attraction: Handlebars.compile($('#tpl-attraction').html())
    };

    app.rootController.initialize(categoryView, mapView, listView, templates);
    app.rootController.renderViews();
});
