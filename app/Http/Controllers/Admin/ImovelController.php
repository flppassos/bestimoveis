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
    public function index(Request $request)
    {
        //$imoveis = Imovel::with(['cidade', 'endereco'])->get(); //Código para consulta Eage Loading
        //$imoveis = Imovel::with(['cidade', 'endereco'])->orderBy('titulo', 'asc')->get(); //Código ordenar a consulta pelo titulo
        $imoveis = Imovel::join('cidades', 'cidades.id', '=', 'imoveis.cidade_id')->join('enderecos', 'enderecos.imovel_id', '=', 'imoveis.id')
        ->orderBy('cidades.nome', 'asc')
        ->orderBy('titulo', 'asc'); //Código ordenar a consulta pelo campo de uma tabela estrangeira

        //Armazenando os dados da requisição
        $cidade_id = $request->cidade_id;
        $titulo = $request->titulo;

        //Pesquisa pela Cidade
        if ($cidade_id) {
            $imoveis->where('cidades.id', $cidade_id);
        }

        //Pesquisa pelo titulo do imóvel
        if ($titulo) {
            $imoveis->where('titulo', 'like', "%$titulo%");
        }

        //Executando a query e armazenando na variável imoveis
        //$imoveis = $imoveis->get();

        //Executando a query e fazendo a paginação
        $imoveis = $imoveis->paginate(3)->withQueryString();

        $cidades = Cidade::orderBy('nome')->get();

        return view('admin.imoveis.index', compact('imoveis', 'cidades', 'cidade_id', 'titulo'));
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
        $imovel = Imovel::with(['cidade', 'endereco', 'finalidade', 'tipo', 'proximidade'])->find($id); //Eager Loading

        return view('admin.imoveis.show', compact('imovel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imovel = Imovel::with(['cidade', 'endereco', 'finalidade', 'tipo', 'proximidade'])->find($id); //Eager Loading

        $cidades = Cidade::all();
        $tipos = Tipo::all();
        $finalidades = Finalidade::all();
        $proximidades = Proximidade::all();

        return view('admin.imoveis.formEditar', compact('imovel', 'cidades', 'tipos', 'finalidades', 'proximidades'));
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
        $imovel = Imovel::find($id);

        DB::beginTransaction(); //declaração de inicio de uma transação no banco de dados
            $imovel->update($request->all());
            $imovel->endereco->update($request->all());

            if ($request->has('proximidades')) {
                $imovel->proximidade()->sync($request->proximidades);
            }
        DB::commit(); //concluir a transação no banco de dados

        $request->session()->flash('msg', "Imóvel atualizado com sucesso!");
        return redirect()->route('admin.imoveis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Seleciona o imóvel pelo id
        $imovel = Imovel::find($id);

        DB::beginTransaction(); //declaração de inicio de uma transação no banco de dados
            //Remove o endereço
            $imovel->endereco->delete();
            //Remove o imovel
            $imovel->delete();
        DB::Commit(); //concluir a transação no banco de dados

        $request->session()->flash('msg', "Imóvel excluído com sucesso!");
        return redirect()->route('admin.imoveis.index');
    }
}
