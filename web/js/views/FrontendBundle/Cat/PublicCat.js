$('#both')
    .click(function () {
    var url = Routing.generate('frontend_cat_index', { option: 'both' }, true)
    window.location.replace(url);
});
$('#cat')
    .click(function () {
    var url = Routing.generate('frontend_cat_index', { option: 'cat' }, true)
    window.location.replace(url);
});
$('#kitten')
    .click(function () {
    var url = Routing.generate('frontend_cat_index', { option: 'kitten' }, true)
    window.location.replace(url);
});
