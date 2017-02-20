$(document).ready(function () {

    // Lastname filter
    var lastname = '';
    $('#customerbundle_search_customer_lastname').keyup(function () {
        // Get the typed value
        lastname = $(this).val();
        refreshData();
    });

    //citizenservicenumber filter
    var citizenservicenumber = '';
    $('#customerbundle_search_customer_citizenservicenumber').keyup(function () {
        // Get the typed value
        citizenservicenumber = $(this).val();
        refreshData();
    });

    // municipality filter
    var municipality = '';
    var municipalitySelect = $('#customerbundle_search_customer_municipality');
    municipalitySelect.change(function () {
        municipality = municipalitySelect.val();
        refreshData();
    });

    function refreshData() {
        if (typeof requestby == 'undefined') {
            requestby = 'customerbundle';
        }
        $.ajax({
            url: Routing.generate('backend_customer_search_data', {'requestby' : requestby}, true),
            data: {
                lastname: lastname,
                citizenservicenumber: citizenservicenumber,
                municipality: municipality
            },
            type: "GET",
            dataType: "html"
        })
            .done(function (html) {
                $("#searchresult").html(html);
            })
    }
});