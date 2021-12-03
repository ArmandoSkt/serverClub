<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructores', function (Blueprint $table) {
            $table->id();
            $table->char('rol',1);
            $table->string('nombre', 45);
            $table->string('apellidos', 100);
            $table->integer('edad');
            $table->string('telefono', 10);
            $table->string('correo', 60);
            $table->char('usuario', 5)->unique();
            $table->string('password');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructores');
    }
}
