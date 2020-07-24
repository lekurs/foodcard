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

    $('body').on('click', '.middle-trash-user', function () {
        let idUser = $(this).attr('data-user');
        let elt = $(this);

        $.post('/foodcard/admin/store/utilisateur/trash', {id: idUser}, function (data) {
            elt.closest('.mout-middle-admin-usercards').remove();
        });
    });
});
