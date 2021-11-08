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

        return view('admin.cidades.index', compact('subtitulo', 'cidades'));
    }

    public function formAdicionar()
    {
        return view('admin.cidades.form');
    }

    public function adicionar(Request $request)
    {
        //Pegando o dado enviado pelo form
        //$nome = $request->input('nome');
        //$nome = $request->nome;

        //Criar um objeto do modelo (classe) Cidade
        $cidade = new Cidade();
        $cidade->nome = $request->nome;

        $cidade->save(); //salvar no banco de dados

        return redirect()->route('admin.cidades.listar');
    }
}
