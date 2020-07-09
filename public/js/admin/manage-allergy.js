$(document).ready(function () {
    $('body').on('click', '.btn-allergy', function () {
        let select = [];
        if($(this).hasClass('btn-dark')) {
            $(this).removeClass('btn-dark').addClass('btn-light');
        } else {
            $(this).removeClass('btn-light').addClass('btn-dark');
        }

        $('.btn-allergy.btn-light').each(function () {
            select.push($(this).data('allergy'));
        });

        $('#textarea-allergy').val(select.join('|'));
    });
});
