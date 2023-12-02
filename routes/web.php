<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\ManageProducts;
use App\Http\Controllers\web\ManageCategories;

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
    return view('auth.login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');


Route::resource('categories', ManageCategories::class)->names('categories');
Route::resource('products', ManageProducts::class)->names('products');
