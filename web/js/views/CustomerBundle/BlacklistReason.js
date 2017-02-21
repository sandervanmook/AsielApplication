var label = $('#blacklistreasonlabel')
var box = $('#customerbundle_privatecustomer_blacklistedReason')
var state = false;

$(document).ready(function () {
    label.hide();
    box.hide();
    if ($('#customerbundle_privatecustomer_blacklisted:checkbox:checked').length > 0) {
        label.show();
        box.show();
    }
});

$('#customerbundle_privatecustomer_blacklisted').click(function () {
    if (state == false) {
        label.show('slide', {duration : 600});
        box.show('slide', {duration : 600});
        state = true;
    } else {
        label.hide();
        box.hide();
        state = false;
    }
});