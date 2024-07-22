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
        Schema::create('vehicle_type', function (Blueprint $table) {
            $table->id();
            $table->text('vehicle_type')->nullable();
            $table->integer('make_id')->nullable();
            $table->integer('model_year')->nullable();
            $table->text('vehicle_desc')->nullable();
            $table->text('color')->nullable();
            $table->text('date_stolen')->nullable();
            $table->text('location_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_type');
    }
};
