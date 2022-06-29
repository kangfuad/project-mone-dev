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
        Schema::create('mpe_rpu_wos', function (Blueprint $table) {
            $table->id();
            $table->string('no_rpu');
            $table->string('id_wo')->uniqid();
            $table->integer('id_pic_foreman');
            $table->longText('pic_montir')->nullable();
            $table->integer('status_id');
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
        Schema::dropIfExists('mpe_rpu_wos');
    }
};
