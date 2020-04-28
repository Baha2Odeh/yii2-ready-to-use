$(document).on('submit', '#lawyer-search-form', function () {
    $('#lawyer-search-form *').filter(':input').each(function () {
        if ($(this).val() == '')
            $(this).prop('disabled', true);
    });
});