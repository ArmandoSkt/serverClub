<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('folio')->unique();
            $table->string('nombre', 45);
            $table->string('apellidos', 100);
            $table->string('carrera', 40);
            $table->char('sexo',1);
            $table->integer('edad');
            $table->string('telefono', 10);
            $table->string('correo', 60);
            $table->string('club_alternativo', 40);
            $table->string('alergias', 100);
            $table->string('situacion_medica', 100);
            $table->foreignId('clave_club')->constrained('clubes');
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
        Schema::dropIfExists('alumnos');
    }
}
