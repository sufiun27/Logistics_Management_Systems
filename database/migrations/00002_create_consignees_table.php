<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consignees', function (Blueprint $table) {
            $table->id();
            $table->string('consignee_name');
            $table->string('consignee_site');
            $table->string('consignee_address');
            $table->string('consignee_country');
            $table->string('BCode')->nullable();
            //$table->string('site');
            $table->timestamps();
        });


        DB::table('consignees')->insert([
            ['consignee_name' => 'H&M', 'consignee_site' => 'HLFS', 'consignee_address' => 'Address A', 'consignee_country' => 'America', 'BCode' => 'B001'],
            ['consignee_name' => 'H&M', 'consignee_site' => 'HLFS', 'consignee_address' => 'Address B', 'consignee_country' => 'America', 'BCode' => 'B001'],
            ['consignee_name' => 'H&M', 'consignee_site' => 'HLFS', 'consignee_address' => 'Address C', 'consignee_country' => 'America', 'BCode' => 'B001'],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignees');
    }
};
