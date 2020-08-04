<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:1']], function () {
   Route::get('/', 'Admin\AdminController')->name('admin');

   Route::group(['prefix' => 'category'], function () {
      Route::get('/', 'Admin\Category\CatalogueCategoryShowController@show')->name('catalogueCategoryShow');
      Route::get('/create', 'Admin\Category\CatalogueCategoryFormController@create')->name('catalogueCategoryCreation');
      Route::post('/store', 'Admin\Category\CatalogueCategoryFormController@store')->name('catalogueCategoryStore');
      Route::post('/category/menu/update', 'Admin\Category\CatalogueCategoryFormController@catalogueCategoriesPositionUpdate')->name('categoryMenuUpdate');
   });

   Route::group(['prefix' => 'produits'], function () {
      Route::get('/', 'Admin\Product\CatalogueProductShowController@show')->name('productShow');
      Route::post('/store', 'Admin\Product\CatalogueProductFormController@store')->name('productStore');
      Route::post('/update/view', 'Admin\Product\CatalogueProductFormController@formProductUpdate')->name('updateViewStore');
      Route::get('/del/{id}', 'Admin\Product\CatalogueProductActionsController@trash')->name('productTrash');
   });

   Route::group(['prefix' => 'utilisateurs'], function () {
      Route::get('/', 'Admin\Users\UserShowController@show')->name('users');

      Route::group(['prefix' => 'roles'], function() {
         Route::get('/', 'Admin\Users\Roles\UserRolesShowController@show')->name('userRoleShow');
         Route::post('/update/{id}', 'Admin\Users\Roles\UserRolesFormController@update')->name('userRoleUpdate');
         Route::post('/delete/{id}', 'Admin\Users\Roles\UserRolesFormController@delete')->name('userRoleDelete');
      });
   });

   Route::group(['prefix' => 'magasins'], function () {
       Route::get('/', 'Admin\Stores\StoresShowController@show')->name('storeShow');
       Route::get('/search', 'Admin\Stores\StoresShowController@show')->name('storeSearch');
      Route::group(['prefix' => 'types'], function () {
          Route::get('/', 'Admin\Stores\Types\StoreTypeShowController@show')->name('storeTypesShow');
          Route::get('/add', 'Admin\Stores\Types\StoreTypeFormController@show')->name('storesTypesShowCreation');
          Route::post('/store', 'Admin\Stores\Types\StoreTypeFormController@create')->name('storesTypesShowStore');
          Route::get('/trash/{id}', 'Admin\Stores\Types\StoreTypeFormController@trash')->name('storeTypeTrash');
      });
   });
});

Route::group(['prefix' => 'foodcard', 'middleware' => ['auth', 'role']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Middle\Admin\AdminShowController@show')->name('adminMiddleShow');

        Route::group(['prefix' => 'compte'], function () {
            Route::get('/', 'Middle\Admin\Account\AccountShowController@show')->name('adminMiddleAccountShow');
            Route::get('/factures', 'Middle\Admin\Account\InvoicesShowController@show')->name('adminMiddleAccountInvoicesShow');
            Route::get('/paiement', 'Middle\Admin\Account\BillingPortalController@show')->name('adminMiddleBillingPortalShow');
            Route::post('/store', 'Middle\Admin\Account\BillingPortalController@store')->name('adminMiddleBillingPortalStore');
            Route::post('/subscribe', 'Middle\Admin\Account\BillingPortalController@subscribe')->name('adminMiddleBillingPortalSubscribe');
        });

        Route::group(['prefix' => 'store'], function () {
            Route::get('/', 'Middle\Admin\Store\StoreShowController@show')->name('adminMiddleStoreShow');
            Route::post('/change', 'Middle\Admin\AdminShowController@changeStore')->name('adminMiddleStoreChange');

            Route::group(['prefix' => 'qrcode'], function() {
                Route::get('/', 'Middle\Admin\QRCode\QRCodeController@show')->name('adminMiddleQRCorde');
            });

                Route::group(['prefix' => 'utilisateur'], function () {
                    Route::post('/ajouter', 'Middle\Admin\Account\UsersActionsController@createUser')->name('adminMiddleUserCreation');
                    Route::post('/edit', 'Middle\Admin\Account\UsersActionsController@editUser')->name('adminMiddleUserEdit');
                    Route::post('/trash', 'Middle\Admin\Account\UsersActionsController@trashUser')->name('adminMiddleUserTrash');
                });

        });

        Route::group(['prefix' => 'ma-carte'], function () {
           Route::get('/', 'Middle\Admin\Menu\MenuShowController@show')->name('adminMiddleMenuShow');
           Route::post('/subcategory', 'Middle\Admin\Menu\MenuShowController@showSubCategories')->name('adminMiddleMenuShowSubCategories');
           Route::post('/products', 'Middle\Admin\Menu\MenuShowController@showProductsTable')->name('adminMiddleMenuShowproducts');
           Route::get('/creer/{category}', 'Middle\Admin\Menu\MenuFormController@show')->name('adminMiddleMenuCreateShow');
           Route::post('/creer/{category}/store', 'Middle\Admin\Menu\MenuFormController@store')->name('adminMiddleMenuCreateStore');
        });

        Route::group(['prefix' => 'store/{slug}', 'middleware' => 'restrictionStore'], function() {
            Route::get('/', 'Middle\Admin\Store\StoreShowController@showOne')->name('adminMiddleStoreOne');
        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/logout', function () {
//    auth()->logout();
//    redirect('/');
//});
