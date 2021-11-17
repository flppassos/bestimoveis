<?php

use App\Http\Controllers\Admin\CidadeController;
use App\Http\Controllers\Admin\ImovelController;
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

Route::redirect('/', '/admin/cidades');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('cidades', CidadeController::class)->except(['show']);
    Route::resource('imoveis', ImovelController::class);

});

Route::get('/sobre', function () {
    return '<h1>Sobre</h1>';
});
