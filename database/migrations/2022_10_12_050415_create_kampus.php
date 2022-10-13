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
        Schema::create('kampus', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('name');
            $table->string('jenis');
            $table->string('status');
            $table->string('akrediatasi');
            $table->string('notel');
            $table->string('fax');
            $table->string('alamat');
            $table->float('rank');
            $table->text('profil');
            $table->string('prodi');
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
        Schema::dropIfExists('kampus');
    }
};
