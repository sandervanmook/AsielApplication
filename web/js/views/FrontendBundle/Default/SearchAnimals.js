$(document).ready(function () {
    // Type filter
    var typeArray = [];
    var catCheckbox = $('#cat');
    var dogCheckbox = $('#dog');
    catCheckbox.click(function () {
        var catValue = catCheckbox.is(':checked');
        if (catValue) {
            typeArray[0] = 'Cat';
        } else {
            typeArray[0] = '';
        }
        refreshData();
    });
    dogCheckbox.click(function () {
        var dogValue = dogCheckbox.is(':checked');
        if (dogValue) {
            typeArray[1] = 'Dog';
        } else {
            typeArray[1] = '';
        }
        refreshData();
    });

    // Gender filter
    var genderArray = [];
    var maleCheckbox = $('#male');
    var femaleCheckbox = $('#female');
    var unknownCheckbox = $('#unknown');
    maleCheckbox.click(function () {
        var maleValue = maleCheckbox.is(':checked');
        if (maleValue) {
            genderArray[0] = 'Male';
        } else {
            genderArray[0] = '';
        }
        refreshData();
    });
    femaleCheckbox.click(function () {
        var femaleValue = femaleCheckbox.is(':checked');
        if (femaleValue) {
            genderArray[1] = 'Female';
        } else {
            genderArray[1] = '';
        }
        refreshData();
    });
    unknownCheckbox.click(function () {
        var unknownValue = unknownCheckbox.is(':checked');
        if (unknownValue) {
            genderArray[2] = 'Unknown';
        } else {
            genderArray[2] = '';
        }
        refreshData();
    });

    // Age filter
    var ageStart = 1;
    var ageEnd = 18;
    var startSelect = $('#agestart');
    var endSelect = $('#ageend');
    startSelect.change(function () {
        ageStart = startSelect.val();
        refreshData();
    });
    endSelect.change(function () {
        ageEnd = endSelect.val();
        refreshData();
    });

    // Status filter
    var statusArray = [];
    var abandonedCheckbox = $('#abandoned');
    var foundCheckbox = $('#found');
    var seizedCheckbox = $('#seized');
    abandonedCheckbox.click(function () {
        var abandonedValue = abandonedCheckbox.is(':checked');
        if (abandonedValue) {
            statusArray[0] = 'Abandoned';
        } else {
            statusArray[0] = '';
        }
        refreshData();
    });
    foundCheckbox.click(function () {
        var foundValue = foundCheckbox.is(':checked');
        if (foundValue) {
            statusArray[1] = 'Found';
        } else {
            statusArray[1] = '';
        }
        refreshData();
    });
    seizedCheckbox.click(function () {
        var seizedValue = seizedCheckbox.is(':checked');
        if (seizedValue) {
            statusArray[2] = 'Seized';
        } else {
            statusArray[2] = '';
        }
        refreshData();
    });

    // Sterilized filter
    var sterilized = '';
    var sterilizedCheckbox = $('#sterilized');

    sterilizedCheckbox.click(function () {
        if (sterilizedCheckbox.is(':checked')) {
            sterilized = true;
        } else {
            sterilized = false;
        }
        refreshData();
    });

    function refreshData() {
        $.ajax({
            url: Routing.generate('frontend_animal_search_data', {}, true),
            data: {
                type: typeArray,
                gender: genderArray,
                agestart: ageStart,
                ageend: ageEnd,
                status: statusArray,
                sterilized: sterilized
            },
            type: "GET",
            dataType: "html"
        })
            .done(function (html) {
                $("#searchresult").html(html);
            })
    }
});







