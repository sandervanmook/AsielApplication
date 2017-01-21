$('#both')
    .click(function () {
        var url = Routing.generate('frontend_dog_index', { option: 'both' }, true)
        window.location.replace(url);
    });
$('#dog')
    .click(function () {
        var url = Routing.generate('frontend_dog_index', { option: 'dog' }, true)
        window.location.replace(url);
    });
$('#puppy')
    .click(function () {
        var url = Routing.generate('frontend_dog_index', { option: 'puppy' }, true)
        window.location.replace(url);
    });