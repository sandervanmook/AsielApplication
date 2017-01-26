var remove = $('.delete');
var id = '';
$(remove).click(function() {
    id = $(this).attr('id');
    $('#confirmmodal')
        .modal('show');
});
$('#approve').click(function() {
    $.get(Routing.generate('backend_animal_task_delete', { id: id }, true));
    location.reload();
})