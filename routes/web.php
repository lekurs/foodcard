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
        Route::get('/store', 'Middle\Admin\Store\StoreShowController@show')->name('adminMiddleStoreShow');
        Route::get('/compte', 'Middle\Admin\Account\AccountShowController@show')->name('adminMiddleAccountShow');
        Route::get('/compte/factures', 'Middle\Admin\Account\InvoicesShowController@show')->name('adminMiddleAccountInvoicesShow');

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
