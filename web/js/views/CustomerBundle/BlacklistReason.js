var label = $('#blacklistreasonlabel')
var box = $('#asielbundle_customer_blacklistedReason')
var state = false;

$(document).ready(function () {
    label.hide();
    box.hide();
    if ($('#asielbundle_customer_blacklisted:checkbox:checked').length > 0) {
        label.show();
        box.show();
    }
});

$('#asielbundle_customer_blacklisted').click(function () {
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