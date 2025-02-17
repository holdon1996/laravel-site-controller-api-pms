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
        Schema::create('tllincoln_plan_prices', function (Blueprint $table) {
            $table->id();
            $table->string('tllincoln_hotel_id');
            $table->integer('tllincoln_plan_id');
            $table->integer('tllincoln_roomtype_code');
            $table->string('tllincoln_sell_date');
            $table->integer('tllincoln_remaining_quantity')->nullable();
            $table->tinyInteger('tllincoln_sell_status');
            $table->integer('tllincoln_price_one_adult')->nullable();
            $table->integer('tllincoln_price_two_adults')->nullable();
            $table->integer('tllincoln_price_three_adults')->nullable();
            $table->integer('tllincoln_price_four_adults')->nullable();
            $table->integer('tllincoln_price_five_adults')->nullable();
            $table->integer('tllincoln_price_six_adults')->nullable();
            $table->integer('tllincoln_price_seven_adults')->nullable();
            $table->integer('tllincoln_price_eight_adults')->nullable();
            $table->integer('tllincoln_price_night_adults')->nullable();
            $table->integer('tllincoln_price_for_ten_adults_or_more')->nullable();
            $table->tinyInteger('tllincoln_flag');
            $table->string('tllincoln_updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tllincoln_plan_prices');
    }
};
