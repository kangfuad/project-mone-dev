<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpe_rpu_keluhan_listbarang', function (Blueprint $table) {
            $table->id();
            $table->string('no_rpu');
            $table->integer('id_mpe_rpu_keluhan');
            $table->string('kode_barang');
            $table->integer('jumlah_barang');
            $table->integer('id_mcc_created_keluhan');
            $table->integer('flaging');
            $table->integer('is_active')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpe_rpu_keluhan_listbarang_');
    }
};
