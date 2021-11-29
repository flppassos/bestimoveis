<?php

use App\Http\Controllers\Admin\CidadeController;
use App\Http\Controllers\Admin\FotoController;
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

//PARTE ADMINISTRATIVA
Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('cidades', CidadeController::class)->except(['show']);
    Route::resource('imoveis', ImovelController::class);
    Route::resource('imoveis.fotos', FotoController::class)->except('show', 'edit', 'update');
});

//SITE PRINCIPAL
Route::resource('/', App\Http\Controllers\Site\CidadeController::class)->only('index');

Route::get('/sobre', function () {
    return '<h1>Sobre</h1>';
});
