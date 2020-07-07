$(document).ready(function () {

    $('body').on('click', '.choice-lg', function () {
        let target = $(this).data('id');

        $('.product_label').hide();
        $('.product_' + target).show();
    });
});
