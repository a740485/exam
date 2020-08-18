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

// Route::get('v1/user/create', function (Request $request) {
//     return "2";
// });
// Route::prefix('v1/user')->group(function () {
//     Route::get('create', function (Request $request) {
//         return "5";
//     });
// });

Route::prefix('v1')->group(function () {
    // 127.0.0.1:8000/v1/user/login
    // Route::get('user/login', );
});