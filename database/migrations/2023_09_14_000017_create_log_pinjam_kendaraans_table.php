<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPinjamKendaraansTable extends Migration
{
    public function up()
    {
        Schema::create('log_pinjam_kendaraans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis');
            $table->longText('log')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
