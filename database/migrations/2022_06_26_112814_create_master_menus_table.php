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
        Schema::create('master_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->string('nama_menu');
            $table->string('slug_menu');
            $table->string('icon_menu');    
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
        Schema::dropIfExists('master_menus');
    }
};
