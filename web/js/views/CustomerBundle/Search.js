$(document).ready(function () {

    // Lastname filter
    var lastname = '';
    $('#customerbundle_search_customer_lastname').keyup(function () {
        // Get the typed value
        lastname = $(this).val();
        refreshData();
    });

    // city (sub) filter
    var city = '';
    $('#customerbundle_search_customer_city').keyup(function () {
        // Get the typed value
        city = $(this).val();
        refreshData();
    });

    //citizenservicenumber filter
    var citizenservicenumber = '';
    $('#customerbundle_search_customer_citizenservicenumber').keyup(function () {
        // Get the typed value
        citizenservicenumber = $(this).val();
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
                city: city,
                citizenservicenumber: citizenservicenumber

            },
            type: "GET",
            dataType: "html"
        })
            .done(function (html) {
                $("#searchresult").html(html);
            })
    }
});