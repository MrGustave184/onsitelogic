<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->string('nombre');
						$table->string('apellido');
						$table->unsignedInteger('categoria_id');
						$table->string('status');
            $table->string('email')->unique();
            $table->date('fechaNacimiento');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('cedula');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
