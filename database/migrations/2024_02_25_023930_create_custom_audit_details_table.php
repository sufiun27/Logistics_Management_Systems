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
        Schema::create('custom_audit_details', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->foreign('invoice_no')->references('invoice_no')->on('export_form_apparels');
            $table->string('import_reg_no');
            $table->string('import_bond');
            $table->float('total_fabric_used');
            $table->string('adjusted_reg');
            $table->string('adjusted_reg_page');
            $table->string('createad_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_audit_details');
    }
};
