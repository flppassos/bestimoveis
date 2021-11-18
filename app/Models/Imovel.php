<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $table = "imoveis";
    protected $fillable = [
        'titulo',
        'terreno',
        'salas',
        'banheiros',
        'dormitorios',
        'garagens',
        'descricao',
        'preco',
        'cidade_id',
        'tipo_id',
        'finalidade_id'
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
        //a convenção espera que o nome da chave estrangeira seja o nome do modelo com o sufixo _id ou seja imovel_id
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function finalidade()
    {
        return $this->belongsTo(Finalidade::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function proximidade()
    {
        return $this->belongsToMany(Proximidade::class)->withTimestamps();
        //nome da tabela intermediária
        //pega o nome dos dois modelos em snake_case no singular em ordem alfabética
        //imovel_proximidade
        //caso não seja esse o nome da tabela informar no código
        //return $this->belongsToMany(Proximidade::class, tabela_intermediaria);
    }
}
