$(document).ready(function () {
    const addUser = $('.mout-btn-form-middle');
    let panel = $('.mout-admin-middle-form-container');

    $('body').on('click', '.mout-btn-form-middle', function (e) {
        e.preventDefault();

       $(this).toggleClass('active');
        panel.toggleClass('active');

       $('body').on('click', '.close-form-container', function () {
            panel.toggleClass('active');
       });
    });

    $('body').on('click', '.middle-edit-user', function (e) {
        panel.toggleClass('active');

        let idUser = $(this).attr('data-user');

        $.post('/foodcard/admin/store/utilisateur/edit', {id:idUser}, function (data) {
            $('.mout-admin-middle-form-container').html(data);
        });
    });
});
