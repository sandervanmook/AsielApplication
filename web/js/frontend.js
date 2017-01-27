$('#menu').click(function () {
    $('.ui.sidebar')
        .sidebar({
            dimPage: false,
        })
        .sidebar('toggle')
    ;
})