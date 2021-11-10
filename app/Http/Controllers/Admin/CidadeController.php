<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CidadeRequest; //inserindo o arquivo de request para validações
use App\Models\Cidade; //inserindo o arquivo Model Cidade

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtitulo = 'Lista de Cidades';

        $cidades = Cidade::all();

        return view('admin.cidades.index', compact('subtitulo', 'cidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cidades.formAdicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CidadeRequest $request)
    {
        //Pegando o dado enviado pelo form
        //$nome = $request->input('nome');
        //$nome = $request->nome;

        /*//Criar um objeto do modelo (classe) Cidade
        $cidade = new Cidade();
        $cidade->nome = $request->nome;

        $cidade->save(); //salvar no banco de dados*/

        //Atribuição em massa
        Cidade::create($request->all());

        $request->session()->flash('msg', "Cidade $request->nome incluida com sucesso!");

        return redirect()->route('admin.cidades.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cidade = Cidade::find($id);
        return view('admin.cidades.formEditar', compact('cidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CidadeRequest $request, $id)
    {
        $cidade = Cidade::find($id);
        //$cidade->nome = $request->nome; //Primeira forma
        //$cidade->save();                //de atualizar

        $cidade->update($request->all()); //Atualizando todos os campos

        $request->session()->flash('msg', "Cidade alterada com sucesso!");

        return redirect()->route('admin.cidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Cidade::destroy($id);
        $request->session()->flash('msg', "Cidade excluida com sucesso!");

        return redirect()->route('admin.cidades.index');
    }
}
