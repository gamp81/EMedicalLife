<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impuestoiva', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigoPorcentaje',4);
            $table->string('nombre');
            $table->decimal('tarifa',10,2);
            $table->timestamps();
            $table->bigInteger('createdBy_id')->unsigned()->nullable();
            $table->foreign('createdBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('updatedBy_id')->unsigned()->nullable();
            $table->foreign('updatedBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('deletedBy_id')->unsigned()->nullable();
            $table->foreign('deletedBy_id')->references('id')->on('users')->nullOnDelete();
        });
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruc',13);
            $table->string('ambiente',1);
            $table->string('tipoEmision',1);
            $table->string('razonSocial',200);
            $table->string('nombreComercial',200);
            $table->string('direccionMatriz',200);
            $table->string('agenteRetencion',50)->nullable();
            $table->string('contribuyenteEspecial',200);
            $table->string('obligadoContabilidad',200);
            $table->string('dirLogo',200);
            $table->string('dirFirma',200);
            $table->string('dirDocAutorizados',200)->nullable();
            $table->string('passFirma',100);
            $table->string('servidorCorreo',200)->nullable();
            $table->string('correoRemitente',200)->nullable();
            $table->string('passCorreo',200)->nullable();
            $table->integer('puerto')->nullable();
            $table->tinyinteger('SSLHabilitado')->nullable();
            $table->tinyinteger('activo')->nullable();
            $table->bigInteger('createdBy_id')->unsigned()->nullable();
            $table->foreign('createdBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('updatedBy_id')->unsigned()->nullable();
            $table->foreign('updatedBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('deletedBy_id')->unsigned()->nullable();
            $table->foreign('deletedBy_id')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
        Schema::create('establecimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emisor_id')->unsigned();
            $table->foreign('emisor_id')->references('id')->on('empresa');
            $table->string('nombre',100);
            $table->string('codigo',4);
            $table->string('urlweb')->nullable();
            $table->string('nombreComercial')->nullable();
            $table->string('direccion')->nullable();
            $table->tinyinteger('activo')->nullable();
            $table->timestamps();
            $table->bigInteger('createdBy_id')->unsigned()->nullable();
            $table->foreign('createdBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('updatedBy_id')->unsigned()->nullable();
            $table->foreign('updatedBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('deletedBy_id')->unsigned()->nullable();
            $table->foreign('deletedBy_id')->references('id')->on('users')->nullOnDelete();
        });
         Schema::create('ptoemision', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresa');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nombre',60);
            $table->string('codigo',3);
            $table->string('secuencialFactura',9);
            $table->string('secuencialNotaCredito',9);
            $table->string('secuencialNotaDebito',9);
            $table->string('secuencialRetencion',9);
            $table->string('secuencialGuiaRemision',9);
            $table->tinyinteger('activo')->nullable();
            $table->timestamps();
            $table->bigInteger('createdBy_id')->unsigned()->nullable();
            $table->foreign('createdBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('updatedBy_id')->unsigned()->nullable();
            $table->foreign('updatedBy_id')->references('id')->on('users')->nullOnDelete();
            $table->bigInteger('deletedBy_id')->unsigned()->nullable();
            $table->foreign('deletedBy_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::dropIfExists('empresas');
    // }
}
