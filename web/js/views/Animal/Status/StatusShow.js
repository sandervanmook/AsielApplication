$('.view').click(function () {
    var id = $(this).attr("id");
    $.ajax({
        url: Routing.generate('asiel_animal_edit_status_show', { statusid: id }, true),
        type: "GET",
        dataType : "html",
    })
        .done(function( json ) {
            $("#result").html( json ).hide().show('slide', {duration : 600});
        })
}).css('cursor','pointer');