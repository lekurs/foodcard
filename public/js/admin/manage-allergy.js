$(document).ready(function () {
    $('body').on('click', '.btn-allergy', function () {
        let select = [];
        if($(this).hasClass('btn-allergy-inactive')) {
            $(this).removeClass('btn-allergy-inactive').addClass('btn-allergy-active');
        } else {
            $(this).removeClass('btn-allergy-active').addClass('btn-allergy-inactive');
        }

        $('.btn-allergy.btn-allergy-active').each(function () {
            select.push($(this).data('allergy'));
        });

        $('#textarea-allergy').val(select.join('|'));
    });
});
