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
        Schema::create('tllincoln_hotels', function (Blueprint $table) {
            $table->id();
            $table->integer('facility_id')->nullable();
            $table->string('tllincoln_hotel_id')->nullable();
            $table->string('tllincoln_hotel_name')->nullable();
            $table->string('tllincoln_hotel_address')->nullable();
            $table->string('tllincoln_hotel_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tllincoln_hotels');
    }
};
