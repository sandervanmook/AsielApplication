$('.view').click(function () {
    var id = $(this).attr("id");
    $.ajax({
        url: Routing.generate('backend_animal_incident_show', {incidentid: id}, true),
        type: "GET",
        dataType: "html",
    })
        .done(function (json) {
            $("#result").html(json);
            $("#viewmodal").modal('show');
        });

})