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

Route::group(['prefix' => 'admin'], function () {
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

      Route::group(['prefix' => 'types'], function () {
          Route::get('/', 'Admin\Stores\Types\StoreTypeShowController@show')->name('storeTypesShow');
          Route::get('/add', 'Admin\Stores\Types\StoreTypeFormController@show')->name('storesTypesShowCreation');
          Route::post('/store', 'Admin\Stores\Types\StoreTypeFormController@create')->name('storesTypesShowStore');
          Route::get('/trash/{id}', 'Admin\Stores\Types\StoreTypeFormController@trash')->name('storeTypeTrash');
      });
   });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
