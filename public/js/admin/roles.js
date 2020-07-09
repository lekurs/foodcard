$(document).ready(function () {
    const roles = $('.roles-menu ul li');


    roles.mouseover(function () {
        $(this).removeClass('active');

        $(this).addClass('active');
        $(this).find('span').show();
    });

    roles.mouseout(function () {
        $(this).removeClass('active');
        $(this).find('span').hide();
    });

    //Edition

});
