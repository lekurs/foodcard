$(document).ready(function () {
    const button = $('.mout-btn-add-product');

    button.click(function () {
        let form = $('.slider-add-form');

        form.toggleClass('active');
    });
});
