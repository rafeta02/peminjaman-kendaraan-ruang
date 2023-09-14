<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLogPinjamRuangansTable extends Migration
{
    public function up()
    {
        Schema::table('log_pinjam_ruangans', function (Blueprint $table) {
            $table->unsignedBigInteger('peminjaman_id')->nullable();
            $table->foreign('peminjaman_id', 'peminjaman_fk_8999845')->references('id')->on('pinjam_ruangs');
            $table->unsignedBigInteger('ruang_id')->nullable();
            $table->foreign('ruang_id', 'ruang_fk_9000075')->references('id')->on('ruangs');
        });
    }
}
