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

    // Age filter
    var ageStart = 1;
    var ageEnd = 1;
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


    function refreshData() {
        $.ajax({
            url: Routing.generate('frontend_animal_search_data', {}, true),
            data: {
                type: typeArray,
                gender: genderArray,
                agestart: ageStart,
                ageend: ageEnd
            },
            type: "GET",
            dataType: "html",
        })
            .done(function (html) {
                $("#searchresult").html(html);
                console.log('start'+ageStart);
                console.log('end'+ageEnd);
            })
    }
});







