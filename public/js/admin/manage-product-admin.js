$(document).ready(function () {

    $('div.times-container').click(function () {
        $(this).closest('.slider-add-form.active').removeClass('active');
    });

    $('body').on('click', '.choice-lg', function () {
        let target = $(this).data('id');

        $('#chTxt img').attr('src', $(this).attr('src'));

        $('.product_label').hide();
        $('.product_' + target).show();
    });

    $('body').on('click', '.edit-elt', function () {
        $('.slider-add-form').addClass('active');

        let idProduct = $(this).data('id');

        $.post('/admin/produits/update/view', {id: idProduct}, function (data) {

            $('#content-form-product').html(data);
        });
    });
});
