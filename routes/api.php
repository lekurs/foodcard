<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/{storeSlug}/home', 'Client\ClientHomeController')->name('apiClientHome');
Route::get('/{storeSlug}/{categoryId}', 'Client\ClientCategorySelectionController')->name('apiClientChooseCategory');
Route::get('/{storeSlug}/{categoryId}/{subcategoryId}/produits', 'Client\ClientProductsSelectionController')->name('apiClientProductSelection');
Route::get('/{storeSlug}/{categoryId}/{subcategoryId}/{productId}', 'Client\ClientProductShowController')->name('apiClientProductShow');
