<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dest_countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_code');
            $table->string('country_name');
            $table->string('port')->unique();
            $table->timestamps();
        });


        DB::table('dest_countries')->insert([
                    ['country_code' => 'USA1', 'country_name' => 'America', 'port' => 'A1'],
                    ['country_code' => 'USA1', 'country_name' => 'America', 'port' => 'A2'],
                    ['country_code' => 'USA1', 'country_name' => 'America', 'port' => 'A3'],
                ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dest_countries');
    }
};
