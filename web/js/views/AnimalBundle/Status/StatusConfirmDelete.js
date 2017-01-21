$('#dialog-confirm').hide();

$('.delete').click(function () {
    var statusId = $(this).attr("id");
    var animalId = $('#animalId').val();
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        draggable: false,
        buttons: {
            "Verwijder status": function() {
                $.get(Routing.generate('backend_animal_status_delete', { id: animalId, statusid: statusId }, true));
                location.reload();
            },
            Annuleren: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}).css('cursor','pointer');