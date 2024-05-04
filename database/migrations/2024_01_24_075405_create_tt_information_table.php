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
        Schema::create('tt_information', function (Blueprint $table) {
            $table->id();
            $table->string('tt_no')->unique();
            $table->string('tt_amount');
            
            $table->string('tt_used_amount')->default(0);//cm value
            $table->string('tt_currency');
            $table->string('bank_name');
            $table->string('tt_site');
            $table->string('tt_created_by');
            $table->string('Modified_by')->nullable();
            $table->boolean('tt_status')->default(1);
            $table->string('tt_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tt_information');
    }
};
