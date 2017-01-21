var state = false;
$('#searchbutton').click(function () {
    if (state == false) {
        $.ajax({
            url: Routing.generate('frontend_animal_search', true),
            type: "GET",
            dataType : "html",
        })
            .done(function( json ) {
                $("#searchform").html( json ).hide().show('blind');
            });
        state = true;
    } else {
        $( "#searchform" ).hide('blind');
        state = false;
    }

}).css('cursor','pointer');
