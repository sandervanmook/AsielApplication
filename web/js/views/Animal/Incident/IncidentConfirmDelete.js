$('#dialog-confirm').hide();

$('.delete').click(function () {
    var id = $(this).attr("id");
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        draggable: false,
        buttons: {
            "Verwijder incident": function() {
                $.get(Routing.generate('asiel_animal_edit_incident_delete', { id: id }, true));
                location.reload();
            },
            Annuleren: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}).css('cursor','pointer');