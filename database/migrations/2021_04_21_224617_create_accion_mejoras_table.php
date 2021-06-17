<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccionMejorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accion_mejoras', function (Blueprint $table) {
            $table->id();
            $table->integer('idPlan');
            $table->string('codigo');
            $table->string('nombre');
            //$table->integer('resultado');
            $table->integer('valor');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('duracion');
            $table->string('semestreEjecucion');
            $table->string('recursos');
            $table->string('metas');
            $table->integer('responsable');
            $table->string('estado');
            $table->integer('avance');
            //$table->string('indicador');
            $table->string('prioridad');
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
        Schema::dropIfExists('accion_mejoras');
    }
}

/*
INSERT INTO `accion_mejoras` (`id`, `idPlan`, `nombre`, `resultado`, `valor`, `fechaInicio`, `fechaFin`, `duracion`, `semestreEjecucion`, `recursos`, `metas`, `responsable`, `estado`, `avance`, `indicador`, `created_at`, `updated_at`) VALUES (NULL, '1', 'Accion 1', '50', '50', '2021-04-14', '2021-04-23', '5', 'semestre', 'recursos', 'metas', '1', 'Estado', 'Avance', 'indicador', NULL, NULL);
*/
