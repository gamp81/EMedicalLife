<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->integerIncrements('id');           
            $table->string('nombre',100);
            $table->string('descripcion',256)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
        
        Schema::create('brands', function (Blueprint $table) {
            $table->integerIncrements('id');           
            $table->string('nombre',100);
            $table->string('descripcion',256)->nullable();
            $table->boolean('condicion')->default(1);
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
        Schema::dropIfExists('categorias');
    }
}
