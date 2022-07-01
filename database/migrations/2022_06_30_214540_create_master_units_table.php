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
        Schema::create('master_units', function (Blueprint $table) {
            $table->id();
            $table->string('TRUCK_ID')->nullable();
            $table->string('BRAND_TRUCK')->nullable();
            $table->string('SERIES')->nullable();
            $table->string('PPROD_TYPE')->nullable();
            $table->string('VIN')->nullable();
            $table->string('YEARS')->nullable();
            $table->string('BRAND_VESSEL')->nullable();
            $table->string('VESSEL_CAPACITY')->nullable();
            $table->string('GCW_KG')->nullable();
            $table->string('GVW_KG')->nullable();
            $table->string('ARRIVAL')->nullable();
            $table->string('MULAI_OPRASI')->nullable();
            $table->string('STATUS')->nullable();
            $table->string('REMARKS')->nullable();
            $table->string('PROJECT')->nullable();
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
        Schema::dropIfExists('master_units');
    }
};
