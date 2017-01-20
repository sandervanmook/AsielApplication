$('#dialog-confirm').hide();

$('.delete').click(function () {
    var id = $(this).attr("id");
    var url = $(location).attr('origin');
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        draggable: false,
        buttons: {
            "Verwijder locatie": function() {
                $.get(Routing.generate('backend_location_delete', { id: id }, true));
                location.reload();
            },
            Annuleren: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}).css('cursor','pointer');