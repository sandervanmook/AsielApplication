var show = $('.Cat');
var id = '';
$(show).click(function () {
    id = $(this).attr('id');

    $.ajax({
        url: Routing.generate('frontend_cat_show', {id: id}, true),
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
    .on("click", "#searchresult .Cat", function () {
        id = $(this).attr('id');

        $.ajax({
            url: Routing.generate('frontend_cat_show', {id: id}, true),
            type: "GET",
            dataType: "html"
        })
            .done(function (data) {
                $("#result").html(data);
                $('#showmodal').modal('show');
            });
    });