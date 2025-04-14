<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('customer/import', [App\Http\Controllers\CustomerController::class, 'index']);
Route::post('customer/import', [App\Http\Controllers\CustomerController::class, 'importExcelData'])->name('importExcelData');