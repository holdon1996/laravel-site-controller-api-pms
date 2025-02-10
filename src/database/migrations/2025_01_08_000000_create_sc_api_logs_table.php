<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScApiLogsTable extends Migration
{
    public function up()
    {
        Schema::create('sc_api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('method');
            $table->mediumText('request');
            $table->mediumText('response');
            $table->string('status_code');
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('sc_api_logs');
    }
}
