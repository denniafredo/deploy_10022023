$(document).ready(function() {
    $('a').click(function() {

        $('#pb div').stop(true).animate({
            width: $(this).attr('class') + '%'
        }, {

            step: function(now) {

                $(this).text(Math.round(now) + '%');
            },
            duration: 1000
        });
    });

});





























//http://sofcase.net/post/make-a-progressbar-how-in-ubuntu-on-css3-and-jquery/