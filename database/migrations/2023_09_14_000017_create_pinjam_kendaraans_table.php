<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamKendaraansTable extends Migration
{
    public function up()
    {
        Schema::create('pinjam_kendaraans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date_start');
            $table->datetime('date_end');
            $table->string('reason');
            $table->string('no_hp');
            $table->string('status');
            $table->longText('status_text')->nullable();
            $table->string('borrowed_by_text')->nullable();
            $table->boolean('driver_status')->default(0)->nullable();
            $table->date('date_return')->nullable();
            $table->boolean('is_done')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
