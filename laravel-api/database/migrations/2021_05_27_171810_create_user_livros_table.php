<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_livros', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('user_id')->unsigned();
            $table->bigInteger('livro_id')->unsigned();
			$table->boolean('reservado')->default(false);
            $table->timestamps();
        });

		Schema::table('user_livros', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('livro_id')->references('id')->on('livros');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_livros');
    }
}
