$(document).ready(function () {
   const category = $('.btn-my-category');

   $('body').on('click', '.btn-my-category', function () {

       let idParent = $(this).attr('data-category');

       $.post('/foodcard/admin/ma-carte/subcategory', {id:idParent}, function (data) {
           let elt = $('.my-submenu-category-container');

            elt.html(data);
       });

       let subMenu = $('.submenu-category-content');

       $('body').on('click', '.submenu-category-content', function() {
           let idSubcategory = $(this).attr('data-subcategory');

           $.post('/foodcard/admin/ma-carte/products', {id: idSubcategory}, function (data) {
                let elt = $('.products-table-container');

                elt.html(data);
           });
       });
   })
});
