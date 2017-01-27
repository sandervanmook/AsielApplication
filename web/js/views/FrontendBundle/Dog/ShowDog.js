var show = $('.Dog');
var id = '';
$(show).click(function () {
    id = $(this).attr('id');

    $.ajax({
        url: Routing.generate('frontend_dog_show', {id: id}, true),
        type: "GET",
        dataType: "html"
    })
        .done(function (data) {
            $("#result").html(data);
            $('#showmodal').modal('show');
        });
});

// Used by animal search
$("body")
    .on("click", "#searchresult .Dog", function () {
        id = $(this).attr('id');

        $.ajax({
            url: Routing.generate('frontend_dog_show', {id: id}, true),
            type: "GET",
            dataType: "html"
        })
            .done(function (data) {
                $("#result").html(data);
                $('#showmodal').modal('show');
            });
    });