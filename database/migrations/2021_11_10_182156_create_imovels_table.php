<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->integer('terreno');
            $table->integer('salas');
            $table->integer('banheiros');
            $table->integer('dormitorios');
            $table->integer('garagens');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 12, 2);

            /*$table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')->references('id')->on('cidades');*/ //Forma antiga de criar chave estrangeira

            $table->foreignId('cidade_id')->constrained()->onDelete('cascade'); //Forma mais atual.
            $table->foreignId('tipo_id')->constrained()->onDelete('cascade'); //Forma mais atual.
            $table->foreignId('finalidade_id')->constrained()->onDelete('cascade'); //Forma mais atual.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imoveis');
    }
}
