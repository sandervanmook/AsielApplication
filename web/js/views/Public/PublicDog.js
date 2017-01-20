$('#both')
    .click(function () {
        var url = Routing.generate('asiel_public_dogs_index', { option: 'both' }, true)
        window.location.replace(url);
    });
$('#dog')
    .click(function () {
        var url = Routing.generate('asiel_public_dogs_index', { option: 'dog' }, true)
        window.location.replace(url);
    });
$('#puppy')
    .click(function () {
        var url = Routing.generate('asiel_public_dogs_index', { option: 'puppy' }, true)
        window.location.replace(url);
    });