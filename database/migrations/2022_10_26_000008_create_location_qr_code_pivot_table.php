<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationQrCodePivotTable extends Migration
{
    public function up()
    {
        Schema::create('location_qr_code', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id', 'location_id_fk_7528030')->references('id')->on('locations')->onDelete('cascade');
            $table->unsignedBigInteger('qr_code_id');
            $table->foreign('qr_code_id', 'qr_code_id_fk_7528030')->references('id')->on('qr_codes')->onDelete('cascade');
        });
    }
}
