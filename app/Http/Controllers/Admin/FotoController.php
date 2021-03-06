<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FotoRequest;
use App\Models\Foto;
use App\Models\Imovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
    public function store(FotoRequest $request, $idImovel)
    {
        //checar se veio a imagem na requisição
        if($request->hasFile('foto')){

            //checar se não houve erro no upload na imagem
            if ($request->foto->isValid()) {

                //Pegando o caminho e o nome do arquivo para salvar no disco
                $fotoURL = $request->foto->hashName("imoveis/$idImovel");

                //Redimensionar a imagem
                $imagem = Image::make($request->foto)->fit(env('FOTO_LARGURA'), env('FOTO_ALTURA'));

                //Salvar no disco
                Storage::disk('public')->put($fotoURL, $imagem->encode());

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idImovel, $idFoto)
    {
        $foto = Foto::find($idFoto);

        //Apagar a foto do storage
        Storage::disk('public')->delete($foto->url);

        //Deletando o registro no banco de dados
        $foto->delete();

        $request->session()->flash('msg', "Foto excluída com sucesso!");
        return redirect()->route('admin.imoveis.fotos.index', $idImovel);
    }
}
