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
        Schema::create('katalog_lagu', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('pencipta_lagu');
            $table->string('pembawa_lagu');
            $table->string('link_vidio_lagu')->nullable();
            $table->unsignedBigInteger('publisher_id');
            $table->timestamps();
            $table->foreign('publisher_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('katalog_lagu');
    }
};
