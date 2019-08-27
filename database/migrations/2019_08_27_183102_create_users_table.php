<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
						$table->string('name', 30);
						$table->string('lastname', 30);
						$table->unsignedInteger('category_id');
						$table->string('status'); // Bool?
            $table->string('email')->unique();
            $table->date('birthdate');
            $table->string('phone', 30);
            $table->string('address', 100);
            $table->string('idNumber', 11)->unique();
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
