<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emisor_id')->unsigned();
            $table->foreign('emisor_id')->references('id')->on('empresa');
            $table->integer('impuesto_iva_id')->unsigned();
            $table->foreign('impuesto_iva_id')->references('id')->on('impuestoiva');
            $table->integer('impuesto_ice_id');
            $table->integer('impuesto_irbpnr_id');
            $table->string('codigoPrincipal',25);
            $table->string('codigoAuxiliar',50)->nullable();
            $table->string('nombre',200);
            $table->decimal('precioUnitario',10,5);
            $table->decimal('precioCosto',10,5);
            $table->integer('stock')->nullable();
            $table->string('ubicacion',50)->nullable();
            $table->string('imagen',200);
            $table->integer('idCategoria')->unsigned();
            $table->foreign('idCategoria')->references('id')->on('categorias');
            $table->integer('idBrand')->unsigned();
            $table->foreign('idBrand')->references('id')->on('brands');
            $table->timestamps();
            $table->bigInteger('createdBy_id')->unsigned()->nullable();
            $table->foreign('createdBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('updatedBy_id')->unsigned()->nullable();
            $table->foreign('updatedBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('deletedBy_id')->unsigned()->nullable();
            $table->foreign('deletedBy_id')->references('id')->on('users')->nullOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
