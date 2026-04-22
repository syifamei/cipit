<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->enum('jenis_layanan', ['pengaduan','konsultasi']);
            $table->string('judul_pengaduan');
            $table->text('isi_pengaduan');
            $table->string('lampiran')->nullable();
            $table->enum('status',['baru','diproses','selesai','ditolak'])->default('baru');
            $table->date('tanggal_pengaduan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
};
