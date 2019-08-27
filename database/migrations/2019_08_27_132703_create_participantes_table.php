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
        Schema::create('participantes', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->string('nombre', 30);
						$table->string('apellido', 30);
						$table->unsignedInteger('categoria_id');
						$table->string('status'); // Bool?
            $table->string('email')->unique();
            $table->date('fechaNacimiento');
            $table->string('telefono', 30);
            $table->string('direccion', 100);
            $table->string('cedula', 11);
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
