$(document).ready(function () {
    const addUser = $('.mout-btn-add-middle');

    $('body').on('click', '.mout-btn-add-middle', function (e) {
        e.preventDefault();
       let panel = $('.mout-admin-middle-form-container');

       $(this).toggleClass('active');
       panel.toggleClass('active');
    });
});
