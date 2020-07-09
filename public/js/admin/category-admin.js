$(document).ready(function () {
    $('body').on('click', '.choice-lg', function () {
        let target = $(this).data('id');

        $('.category_label').hide();
        $('.category_' + target).show();
    });
});
