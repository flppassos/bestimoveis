<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CidadeController;
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

Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('cidades', [CidadeController::class, 'cidades'])->name('cidades.listar');
    Route::get('cidades/adicionar', [CidadeController::class, 'formAdicionar'])->name('cidades.form');

});

Route::get('/sobre', function () {
    return '<h1>Sobre</h1>';
});
