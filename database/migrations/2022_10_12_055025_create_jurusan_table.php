<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('name');
            $table->string('akreditas');
            $table->string('kuota');
            $table->string('pendaftar');
            $table->float('keketatan');
            $table->integer("uktMin");
            $table->integer('uktMax');
            
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
        Schema::dropIfExists('jurusan');
    }
};
