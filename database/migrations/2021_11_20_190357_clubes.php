<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clubes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->string('tipo', 11);
            $table->foreignId('id_instructor')->constrained('instructores');
            $table->string('imagen', 2500);
            $table->string('video', 2500);
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
        Schema::dropIfExists('clubes');
    }
}
