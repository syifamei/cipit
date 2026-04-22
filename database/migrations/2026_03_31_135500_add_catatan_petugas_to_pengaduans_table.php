<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->text('catatan_petugas')->nullable()->after('status');
            $table->timestamp('tanggal_balasan')->nullable()->after('catatan_petugas');
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn(['catatan_petugas', 'tanggal_balasan']);
        });
    }
};
