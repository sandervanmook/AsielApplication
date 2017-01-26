var remove = $('.delete');
var id = '';
$(remove).click(function() {
    id = $(this).attr('id');
    $('#confirmmodal')
        .modal('show');
});
$('#approve').click(function() {
    $.get(Routing.generate('backend_animal_status_delete', { statusid: id }, true));
    location.reload();
})