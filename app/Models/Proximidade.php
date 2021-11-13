<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proximidade extends Model
{
    use HasFactory;

    public function imovel()
    {
        return $this->belongsToMany(Imovel::class)->withTimestamps();
        //nome da tabela intermediária
        //pega o nome dos dois modelos em snake_case no singular em ordem alfabética
        //imovel_proximidade
        //caso não seja esse o nome da tabela informar no código
        //return $this->belongsToMany(Proximidade::class, tabela_intermediaria);

        //Nome da chave estrangeira da tabela pivot com relação a esse modelo ceem
        //imovel_id

        //Nome da chave estrangeira da tabela pivot com relação ao outro modelo ceem
        //proximidade_id
    }
}
