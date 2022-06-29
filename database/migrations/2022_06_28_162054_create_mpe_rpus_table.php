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
        Schema::create('mpe_rpus', function (Blueprint $table) {
            $table->id();
            $table->string('no_rpu')->unique(); 
            $table->string('nomer_unit');
            $table->string('jenis_rpu');
            $table->string('lokasi');
            $table->string('hm');
            $table->string('km');    
            $table->integer('status_id');
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
        Schema::dropIfExists('mpe_rpus');
    }
};
