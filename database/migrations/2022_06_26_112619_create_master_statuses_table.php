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
        Schema::create('master_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_status');
            $table->string('deskripsi_status');
            $table->integer('is_active')->default(1);
            $table->integer('updated_by');
            $table->integer('created_by');
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
        Schema::dropIfExists('master_statuses');
    }
};
