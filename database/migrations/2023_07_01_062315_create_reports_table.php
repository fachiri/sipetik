<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_id');
            $table->unsignedBigInteger('user_id');
            $table->string('judul');
            $table->string('tipe')->nullable();
            $table->string('jenis');
            $table->string('kategori')->nullable();
            $table->text('isi');
            $table->date('tanggal');
            $table->string('lampiran')->nullable();
            $table->string('bukti')->nullable();
            $table->string('feedback_status')->default('PENDING');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
