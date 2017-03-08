$('.view').click(function () {
    var id = $(this).attr("id");
    $.ajax({
        url: Routing.generate('backend_animal_picture_show', {pictureid: id}, true),
        type: "GET",
        dataType: "html",
    })
        .done(function (json) {
            $("#result").html(json);
            $("#viewmodal").modal('show');
        })
})