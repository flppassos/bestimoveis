<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cidade;

class CidadeController extends Controller
{
    public function cidades(){

        $subtitulo = 'Lista de Cidades';
        //$cidades = ['Belo Horizonte', 'Salvador', 'Manaus'];

        $cidades = Cidade::all();

        //dd($cidades); mostra um array com o conteúdo da variável.

        return view('admin.cidades.index', compact('subtitulo', 'cidades'));
    }
}
