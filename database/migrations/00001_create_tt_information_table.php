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
            $table->string('tt_no')->unique();//! this is use as foreign key in export_form_apparels table

            $table->decimal('tt_amount', 10, 4)->default(0.00);//cm value

            $table->decimal('tt_used_amount', 10, 4)->default(0);//cm value

            $table->string('tt_currency');
            $table->string('bank_name');

            //TODO: check later
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
