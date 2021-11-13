<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome']; //Permissão para atribuição em massa

    public function imovel()
    {
        return $this->hasMany(Imovel::class); //relacionamento de 1 para muitos

        //Chave Estrangeira
        //A chave estrangeira da tabela (modelo) associada deve ser o nome desse modelo (snake_case) com o sufixo _id
        //cidade_id
    }
}
