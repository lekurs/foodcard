$(document).ready(function () {
    $('body').on('click', '.choice-lg', function () {
        let target = $(this).data('id');

        $('#chTxt img').attr('src', $(this).attr('src'));

        $('.category_label').hide();
        $('.category_' + target).show();
    });
});
