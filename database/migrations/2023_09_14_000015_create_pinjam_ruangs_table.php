<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamRuangsTable extends Migration
{
    public function up()
    {
        Schema::create('pinjam_ruangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('time_start');
            $table->datetime('time_end');
            $table->string('no_hp');
            $table->longText('penggunaan');
            $table->string('status');
            $table->string('status_text')->nullable();
            $table->string('borrowed_by_text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
