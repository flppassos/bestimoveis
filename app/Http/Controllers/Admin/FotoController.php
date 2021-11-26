<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Imovel;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idImovel)
    {
        $imovel = Imovel::find($idImovel);
        $fotos = Foto::where('imovel_id', '=', $idImovel)->get();

        return view('admin.imoveis.fotos.index', compact('imovel', 'fotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idImovel)
    {
        $imovel = Imovel::find($idImovel);

        return view('admin.imoveis.fotos.formAdicionar', compact('imovel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idImovel)
    {
        //checar se veio a imagem na requisição
        if($request->hasFile('foto')){

            //checar se não houve erro no upload na imagem
            if ($request->foto->isValid()) {

                //armazenando o arquivo no disco publico e capturando a url com a variável $fotoURL
                $fotoURL = $request->foto->store("imoveis/$idImovel", 'public');

                //Armazenando o caminho da foto no BD
                $foto = new Foto();
                $foto->url = $fotoURL;
                $foto->imovel_id = $idImovel;
                $foto->save();
            }
        }
        $request->session()->flash('msg', 'Foto incluída com sucesso!');
        return redirect()->route('admin.imoveis.fotos.index', $idImovel);
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
    public function update(Request $request, $id)
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
