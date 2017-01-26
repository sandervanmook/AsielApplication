$('.view').click(function () {
    var id = $(this).attr("id");
    $.ajax({
        url: Routing.generate('backend_animal_status_show', {statusid: id}, true),
        type: "GET",
        dataType: "html",
    })
        .done(function (json) {
            $("#result").html(json).hide().show('slide', {duration: 600});
        })
});