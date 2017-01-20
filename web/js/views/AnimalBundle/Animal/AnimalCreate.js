var choiceLinks = $('#choices');
var searchExternally = $('#searchexternally');
var backhomeclubButton = $('#bhc').css('cursor', 'pointer');

choiceLinks.hide();
searchExternally.hide();

var inputField = $('#chipnumbercheck');

inputField.keyup(function() {
    var inputLength = $(this).val().length;
    var chipnumber = $(this).val();
    if (inputLength == 15) {
        // Search in our DB
        $.ajax({
            url: Routing.generate('backend_animal_find_on_chipnumber',{ chipnumber: chipnumber} , true),
            type: "GET",
            dataType : "json",
        }).done(function( json ) {
            if (!$.isArray(json) || !json.length) {
                $("#chipresult").html( "Dier niet gevonden" );
                choiceLinks.show();
                searchExternally.show();
            } else {
                choiceLinks.hide();
                var animalId = json[0]["id"];
                var link = Routing.generate('backend_animal_show',{ id: animalId} , true)
                $("#chipresult").html( 'Dit dier staat al in <a href="'+link+'">onze</a> database' );
            }
        })
        // Search backhomeclub.nl
        backhomeclubButton.click(function () {
            var url = "http://particulier.backhomeclub.nl/Info_Chipnummer_nl.aspx?chipnummer="+chipnumber;
            $('#externalresult').html('<object data='+url+' width="800px" height="600px"/>')
        })
    }
});