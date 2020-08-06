$(document).ready(function () {
    const category = $('.btn-my-category');

    // $('body').on('click', '.btn-my-category', function () {

        // let idParent = $(this).attr('data-category');
        let formulaire = $('.my-menu-add-product-container');
        formulaire.hide();
        // formulaire.find('input#category').val(idParent);

        $('body').on('click', '.submenu-category-content', function() {
            let idSubcategory = $(this).attr('data-subcategory');
            let addProductContainer = $('.my-menu-add-product-container');
            addProductContainer.show();
            addProductContainer.find('input#category2').remove();
            addProductContainer.find('input#category').after('<input type="hidden" id="category2" name="category[]">');
            $('input#category2').val(idSubcategory);

            $.post('/foodcard/admin/ma-carte/products', {id: idSubcategory}, function (data) {
                let elt = $('.products-table-container');

                elt.html(data);
            });
        });
    // })
});
