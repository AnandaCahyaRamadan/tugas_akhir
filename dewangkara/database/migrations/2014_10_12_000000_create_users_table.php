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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('avatar')->nullable();
            $table->char('nik')->unique()->nullable();
            $table->char('kota')->nullable();
            $table->string('alamat_ktp');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_wa');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('no_rekening')->unique()->nullable();
            $table->string('foto_ktp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('kota')
                ->references('id')
                ->on('regencies');
            $table->foreign('bank_id')
                ->references('id')
                ->on('bank');
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
};
