<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImovelRequest;
use App\Models\Cidade;
use App\Models\Finalidade;
use App\Models\Imovel;
use App\Models\Proximidade;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imoveis = Imovel::with(['cidade', 'endereco'])->get(); //Código para consulta Eage Loading
        //$imoveis = Imovel::with(['cidade', 'endereco'])->orderBy('titulo', 'asc')->get(); //Código ordenar a consulta pelo titulo
        $imoveis = Imovel::join('cidades', 'cidades.id', '=', 'imoveis.cidade_id')->join('enderecos', 'enderecos.imovel_id', '=', 'imoveis.id')
        ->orderBy('cidades.nome', 'asc')
        ->orderBy('titulo', 'asc')->get(); //Código ordenar a consulta pelo campo de uma tabela estrangeira

        return view('admin.imoveis.index', compact('imoveis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cidades = Cidade::all();
        $tipos = Tipo::all();
        $finalidades = Finalidade::all();
        $proximidades = Proximidade::all();

        return view('admin.imoveis.formAdicionar', compact('cidades', 'tipos', 'finalidades', 'proximidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImovelRequest $request)
    {
        DB::beginTransaction(); //declaração de inicio de uma transação no banco de dados, pode dar certou ou não. Necessário por motivos de inserir dados em duas tabelas ao mesmo tempo.

        $imovel = Imovel::create($request->all());
        $imovel->endereco()->create($request->all());

        if ($request->has('proximidades')) {
            $imovel->proximidade()->sync($request->proximidades);
        } //atualizar as proximidades na tabela intermediaria, se existir proximidade esse comando vai adicionar todas elas na tabela intermediaria

        DB::commit(); //concluir a transação

        $request->session()->flash('msg', "Imóvel cadastrado com sucesso!");
        return redirect()->route('admin.imoveis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImovelRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
