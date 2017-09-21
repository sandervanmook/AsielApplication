$(document).ready(function(){
    // Let the back button go to previous page
    $('.btn-back').click(function(){
        parent.history.back();
        return false;
    });
});