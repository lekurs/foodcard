$(document).ready(function () {
   const category = $('.btn-my-category');

   $('body').on('click', '.btn-my-category', function () {

       let idParent = $(this).attr('data-category');

       console.log(idParent);

       $.post('/foodcard/admin/ma-carte/subcategory', {id:idParent}, function (data) {
           let elt = $('.my-submenu-category-container');

            elt.append(data);
       });
   })
});
