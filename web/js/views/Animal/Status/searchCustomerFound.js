// Bind the keyup event with the search box
$('#asielbundle_statustype_found_search').keyup(function() {
    // Get the typed value
    var searchValue = $(this).val();
    $.ajax({
        url: Routing.generate('asiel_customer_search_lastname', true),
        data: {
            lastname: searchValue
        },
        type: "GET",
        dataType : "html",
    })
        .done(function( json ) {
            $("#result").html( json );
            $(".customer").css('cursor','pointer');
        })
});

$("body")
    .on("click", "#resulttable .customer", function() {
        var customId = $(this).attr("id");
        // Set the hidden field to the right value
        $("#asielbundle_statustype_found_foundBy").attr("value", customId);
        // Return first and lastname in search field
        var customer = $('#'+customId);
        var firstname = customer.find('.firstname').html();
        var lastname = customer.find('.lastname').html();
        $('#asielbundle_statustype_found_search').val(firstname+' '+lastname);
        $('#resulttable').hide();
    })
    .click(function () {
        $('#resulttable').hide();
    })