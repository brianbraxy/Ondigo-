<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('ownership', 25);
            $table->string('vehicle_type', 25);
            $table->string('vehicle_plate_number', 25);
            $table->string('vehicle_state_reg_number', 25);
            $table->string('pocket_device_number', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_details');
    }
};
