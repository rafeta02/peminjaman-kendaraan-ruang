<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPinjamKendaraansTable extends Migration
{
    public function up()
    {
        Schema::table('pinjam_kendaraans', function (Blueprint $table) {
            $table->unsignedBigInteger('kendaraan_id')->nullable();
            $table->foreign('kendaraan_id', 'kendaraan_fk_8999919')->references('id')->on('kendaraans');
            $table->unsignedBigInteger('borrowed_by_id')->nullable();
            $table->foreign('borrowed_by_id', 'borrowed_by_fk_8999926')->references('id')->on('users');
            $table->unsignedBigInteger('processed_by_id')->nullable();
            $table->foreign('processed_by_id', 'processed_by_fk_8999928')->references('id')->on('users');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id', 'driver_fk_8999930')->references('id')->on('drivers');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8999933')->references('id')->on('users');
        });
    }
}
