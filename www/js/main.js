$(function(){
    (function(){
        var currentBreakpoint = '';

        $(window).on('resize', function() {
            var w = $(window).width();
            if (w >= 1200) {
                if (currentBreakpoint !== 'wide') {
                    currentBreakpoint = 'wide';
                    $(window).trigger('breakpoint', 'wide');
                }
            }
            else if (w >= 960) {
                if (currentBreakpoint !== 'standard') {
                    currentBreakpoint = 'standard';
                    $(window).trigger('breakpoint', 'standard');
                }
            }
            else if (w >= 768) {
                if (currentBreakpoint !== 'narrow') {
                    currentBreakpoint = 'narrow';
                    $(window).trigger('breakpoint', 'narrow');
                }
            }
            else {
                if (currentBreakpoint !== 'mobile'){
                    currentBreakpoint = 'mobile';
                    $(window).trigger('breakpoint', 'mobile');
                }
            }
        });
    })();

    /*** Responsive adjustments ***/

    // footer should be below page columns on mobile size, within primary
    // column on non-mobile
    var footer = $('.page-footer');
    $(window).on('breakpoint', function(){
        if ($(window).width() >= 768) {
            footer.remove();
            footer.appendTo('.page-column-primary');
        }
        else {
            footer.remove();
            footer.insertAfter('.page-columns-wrap');
        }
    });

    $(window).trigger('resize');
});