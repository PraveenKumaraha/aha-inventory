<?php

use Illuminate\Support\Facades\Route;
Route::resource('InvSale','Sale\SaleController');

Route::post('/InvSale/store', 'Sale\SaleController@store')->name('InvSaleStore');
Route::post('/InvSale/{id}/update', 'Sale\SaleController@update')->name('InvSaleUpdate');
?>
