<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tllincoln_roomtypes', function (Blueprint $table) {
            $table->id();
            $table->string('tllincoln_hotel_id');
            $table->integer('tllincoln_roomtype_status');
            $table->integer('tllincoln_roomtype_code');
            $table->string('tllincoln_roomtype_name');
            $table->string('tllincoln_roomtype_description')->nullable();
            $table->integer('tllincoln_roomtype_min_person');
            $table->integer('tllincoln_roomtype_max_person');
            $table->string('tllincoln_roomtype_type')->nullable();
            $table->tinyInteger('tllincoln_roomtype_smoking')->nullable();
            $table->tinyInteger('tllincoln_roomtype_no_smoking')->nullable();
            $table->tinyInteger('tllincoln_roomtype_bus')->nullable();
            $table->tinyInteger('tllincoln_roomtype_toilet')->nullable();
            $table->tinyInteger('tllincoln_roomtype_internet')->nullable();
            $table->string('tllincoln_roomtype_image_url')->nullable();
            $table->string('tllincoln_roomtype_image_caption')->nullable();
            $table->string('tllincoln_roomtype_image_updated_at')->nullable();
            $table->tinyInteger('tllincoln_roomtype_flag');
            $table->string('tllincoln_roomtype_code_others')->nullable();
            $table->string('tllincoln_roomtype_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image1_url')->nullable();
            $table->string('tllincoln_roomtype_image1_caption')->nullable();
            $table->string('tllincoln_roomtype_image1_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image2_url')->nullable();
            $table->string('tllincoln_roomtype_image2_caption')->nullable();
            $table->string('tllincoln_roomtype_image2_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image3_url')->nullable();
            $table->string('tllincoln_roomtype_image3_caption')->nullable();
            $table->string('tllincoln_roomtype_image3_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image4_url')->nullable();
            $table->string('tllincoln_roomtype_image4_caption')->nullable();
            $table->string('tllincoln_roomtype_image4_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image5_url')->nullable();
            $table->string('tllincoln_roomtype_image5_caption')->nullable();
            $table->string('tllincoln_roomtype_image5_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image6_url')->nullable();
            $table->string('tllincoln_roomtype_image6_caption')->nullable();
            $table->string('tllincoln_roomtype_image6_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image7_url')->nullable();
            $table->string('tllincoln_roomtype_image7_caption')->nullable();
            $table->string('tllincoln_roomtype_image7_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image8_url')->nullable();
            $table->string('tllincoln_roomtype_image8_caption')->nullable();
            $table->string('tllincoln_roomtype_image8_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image9_url')->nullable();
            $table->string('tllincoln_roomtype_image9_caption')->nullable();
            $table->string('tllincoln_roomtype_image9_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image10_url')->nullable();
            $table->string('tllincoln_roomtype_image10_caption')->nullable();
            $table->string('tllincoln_roomtype_image10_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image11_url')->nullable();
            $table->string('tllincoln_roomtype_image11_caption')->nullable();
            $table->string('tllincoln_roomtype_image11_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image12_url')->nullable();
            $table->string('tllincoln_roomtype_image12_caption')->nullable();
            $table->string('tllincoln_roomtype_image12_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image13_url')->nullable();
            $table->string('tllincoln_roomtype_image13_caption')->nullable();
            $table->string('tllincoln_roomtype_image13_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image14_url')->nullable();
            $table->string('tllincoln_roomtype_image14_caption')->nullable();
            $table->string('tllincoln_roomtype_image14_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image15_url')->nullable();
            $table->string('tllincoln_roomtype_image15_caption')->nullable();
            $table->string('tllincoln_roomtype_image15_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image16_url')->nullable();
            $table->string('tllincoln_roomtype_image16_caption')->nullable();
            $table->string('tllincoln_roomtype_image16_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image17_url')->nullable();
            $table->string('tllincoln_roomtype_image17_caption')->nullable();
            $table->string('tllincoln_roomtype_image17_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image18_url')->nullable();
            $table->string('tllincoln_roomtype_image18_caption')->nullable();
            $table->string('tllincoln_roomtype_image18_updated_at')->nullable();
            $table->string('tllincoln_roomtype_image19_url')->nullable();
            $table->string('tllincoln_roomtype_image19_caption')->nullable();
            $table->string('tllincoln_roomtype_image19_updated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tllincoln_roomtypes');
    }
};
