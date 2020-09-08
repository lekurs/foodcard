$(document).ready(function () {
   const category = $('.btn-my-category');

   //Affichage des sous catégories
   $('body').on('click', '.btn-my-category', function () {

       let idParent = $(this).attr('data-category');

       $.post('/admin-client/ma-carte/subcategory', {id:idParent}, function (data) {
           let elt = $('.my-submenu-category-container');

            elt.html(data);
       });

       let subMenu = $('.submenu-category-content');

       //Affichage des produits par catégorie
       $('body').on('click', '.submenu-category-content', function() {
           let idSubcategory = $(this).attr('data-subcategory');

           $.post('/admin-client/ma-carte/products', {id: idSubcategory}, function (data) {
                let elt = $('.products-table-container');

                elt.html(data);
           });
       });

       //Mise en ligne du produit sur la carte
       $('body').on('click', '.online-menu', function () {
          let productId = $(this).attr('data-product-id');

          $.post('/admin-client/ma-carte/product/online/update', {idProduct: productId},function (data) {

          });
       });
   })
});
