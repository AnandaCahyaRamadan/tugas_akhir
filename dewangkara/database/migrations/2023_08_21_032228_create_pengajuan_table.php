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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_channel');
            $table->string('link_channel');
            $table->enum('status', ['pending', 'accepted', 'rejected']);
            $table->unsignedBigInteger('katalog_id');
            $table->unsignedBigInteger('created_by');
            $table->string('audio')->nullable();
            $table->string('art_track')->nullable();
            $table->enum('is_active', ['pending', 'accepted', 'rejected'])->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('katalog_id')->references('id')->on('katalog_lagu');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
};
