$('.Cat').click(function () {
    var id = $(this).attr("id");
    $.ajax({
        url: Routing.generate('frontend_cat_show', { id: id }, true),
        type: "GET",
        dataType : "html",
    })
        .done(function( data ) {
            $("#result").
            html( data )
                .dialog({
                resizable: false,
                height: 600,
                width: 800,
                modal: true,
                draggable: false,
                show: {
                    effect: "clip",
                    duration: 700
                },
                title: 'Informatie over het dier'
            });
        })
}).css('cursor','pointer');