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
        Schema::create('sc_tllincoln_soap_api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('data_id');
            $table->string('url');
            $table->string('command')->comment('detect command call');
            $table->boolean('is_success')->nullable();
            $table->mediumText('request');
            $table->mediumText('response');
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sc_tllincoln_soap_api_logs');
    }
};
