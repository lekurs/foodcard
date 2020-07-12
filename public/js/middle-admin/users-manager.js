$(document).ready(function () {
    const addUser = $('.mout-btn-form-middle');

    $('body').on('click', '.mout-btn-form-middle', function (e) {
        e.preventDefault();
       let panel = $('.mout-admin-middle-form-container');

       $(this).toggleClass('active');
       panel.toggleClass('active');

       $('body').on('click', '.close-form-container', function () {
            panel.toggleClass('active');
       });
    });
});
