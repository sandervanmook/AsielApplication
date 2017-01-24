$(document).ready(function(){
    // Let the back button go to previous page
    $('.btn-back').click(function(){
        parent.history.back();
        return false;
    });
    // Let the reset button on the animal search page go back to it's original state
    $('.btn-reset-customer-index').click(function(){
        window.location.href = $(location).attr('origin')+'/backend/customer';
    });
});