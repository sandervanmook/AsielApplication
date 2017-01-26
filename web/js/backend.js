// Main sidemenu
$('#menu').click(function () {
    $('#leftsidebar')
        .sidebar({
            dimPage: false,
        })
        .sidebar('toggle')
    ;
});

// Make flash message dismissable
$('.message .close')
    .on('click', function () {
        $(this)
            .closest('.message')
            .transition('fade')
        ;
    })
;

// Show modal Flash messages
// Twig template (Base) decides when to show (when there are active flashbag messages)
$('#modalflash')
    .modal('show');