<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use App\Models\Imovel;
use Illuminate\Http\Request;

class ImovelController extends Controller
{
    public function index($idCidade)
    {
        $cidade = Cidade::find($idCidade);
        $imoveis = Imovel::with(['finalidade', 'fotos'])->where('cidade_id', $idCidade)->paginate(3);

        return view('site.cidades.imoveis.index', compact('cidade', 'imoveis'));
    }

    public function show($idCidade, $idImovel)
    {
        $imovel = Imovel::find($idImovel);

        return view('site.cidades.imoveis.show', compact('imovel'));
    }
}
