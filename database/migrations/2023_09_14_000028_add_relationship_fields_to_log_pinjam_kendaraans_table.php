<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLogPinjamKendaraansTable extends Migration
{
    public function up()
    {
        Schema::table('log_pinjam_kendaraans', function (Blueprint $table) {
            $table->unsignedBigInteger('peminjaman_id')->nullable();
            $table->foreign('peminjaman_id', 'peminjaman_fk_9001097')->references('id')->on('pinjam_kendaraans');
            $table->unsignedBigInteger('kendaraan_id')->nullable();
            $table->foreign('kendaraan_id', 'kendaraan_fk_9001098')->references('id')->on('kendaraans');
            $table->unsignedBigInteger('peminjam_id')->nullable();
            $table->foreign('peminjam_id', 'peminjam_fk_9001099')->references('id')->on('users');
        });
    }
}
