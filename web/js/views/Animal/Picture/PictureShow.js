$('.view').click(function () {
    var id = $(this).attr("id");
    $.ajax({
        url: Routing.generate('asiel_animal_edit_picture_show', { pictureid: id }, true),
        type: "GET",
        dataType : "html",
    })
        .done(function( json ) {
            $("#result").html( json ).hide().show('slide', {duration : 1000});
        })
}).css('cursor','pointer');