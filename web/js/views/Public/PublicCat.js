$('#both')
    .click(function () {
    var url = Routing.generate('asiel_public_cats_index', { option: 'both' }, true)
    window.location.replace(url);
});
$('#cat')
    .click(function () {
    var url = Routing.generate('asiel_public_cats_index', { option: 'cat' }, true)
    window.location.replace(url);
});
$('#kitten')
    .click(function () {
    var url = Routing.generate('asiel_public_cats_index', { option: 'kitten' }, true)
    window.location.replace(url);
});
