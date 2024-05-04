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
        Schema::create('exports', function (Blueprint $table) {
            $table->id();    
            $table->string('ExpoterNo')->unique()->autoIncrement();;    
            $table->string('ExpoterName')->unique();
            $table->string('ExpoterAddress');
            $table->string('RegDetails');
            $table->string('EPBReg');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};
