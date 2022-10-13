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
            $table->string('status');
            $table->string('tipe');
            $table->string('akrediatas');
            $table->string('mengikuti');
            $table->string('alamat');
            $table->float('rank');
            $table->text('profil');
            $table->text('sejarah');
            $table->string('sum_prodi');
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
