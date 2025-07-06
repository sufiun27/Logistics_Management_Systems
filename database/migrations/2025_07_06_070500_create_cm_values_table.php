<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cm_values', function (Blueprint $table) {
            $table->id();
            $table->decimal('cm_value', 5, 2); // Corrected precision
            $table->timestamps();
        });

        DB::table('cm_values')->insert([
            ['cm_value' => 20.00],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cm_values');
    }
};
