var tinyOptions = {
    plugins: [
        "advlist autolink link image lists charmap hr anchor",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality template paste textcolor"
    ],
    image_dimensions: false,
    height: 200,
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist outdent indent | forecolor | inserttable | link spellchecker | code",
    extended_valid_elements: "div[*],meta[*],span[*]",
    menubar: false,
    valid_elements: '*[*]',
    remove_script_host: false,
    cleanup: false,
    entity_encoding: "raw",
    language: "fr_FR",
    browser_spellcheck: true
};

$('.tinymce').tinymce(tinyOptions);

$('.datepicker').datetimepicker({
    locale: 'fr',
    format: 'DD/MM/YYYY'
});