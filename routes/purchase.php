<?php

use Illuminate\Support\Facades\Route;

Route::resource('InvPurchase', 'Purchase\InvPurchaseController');
Route::post('/getItemData', 'Purchase\InvPurchaseController@getItemData')->name('getItemData');

Route::post('/InvPurchase/store', 'Purchase\InvPurchaseController@store')->name('InvPurchaseStore');

?>