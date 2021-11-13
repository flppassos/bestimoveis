<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
        //convencao para identificar a chave estrangeira
        //nome do método e acrescentar o sufixo _id
        //imovel_id
    }
}
