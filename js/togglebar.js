(function($) {
    $('#togglebar .toggle').click(function() {
        if ($('#sidebar').hasClass('opened')) {
            $('#sidebar').animate({
                left: '-100em'
            }, 500, function() { $('#sidebar').removeClass('opened');}); 
            $('#togglebar .site-header_small').animate({
                left: '0'
            }, 500, function () { $('#togglebar').removeClass('translated'); $('#content').removeClass('translated');});
        } else {
            $('#sidebar').animate({
                left: 0
            }, 500, function() { $('#sidebar').addClass('opened');}); 
            $('#togglebar .site-header_small').animate({
                left: '16.5em'
            }, 500, function () { $('#togglebar').addClass('translated'); $('#content').addClass('translated');});                
        }
    });

    $('#content, #togglebar').click(function() {
        if ($('#sidebar').hasClass('opened')) {
            $('#sidebar').animate({
                left: '-100em'
            }, 500, function() { $('#sidebar').removeClass('opened');}); 
            $('#togglebar .site-header_small').animate({
                left: '0'
            }, 500, function () { $('#togglebar').removeClass('translated'); $('#content').removeClass('translated');});
        }
    });
})( jQuery );