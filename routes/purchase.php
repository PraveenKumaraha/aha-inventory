<?php

use Illuminate\Support\Facades\Route;

Route::resource('InvPurchase', 'Purchase\InvPurchaseController');
Route::post('/getItemData', 'Purchase\InvPurchaseController@getItemData')->name('getItemData');
