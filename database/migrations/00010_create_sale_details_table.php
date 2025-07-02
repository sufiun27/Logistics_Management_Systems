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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->foreign('invoice_no')->references('invoice_no')->on('export_form_apparels');

            $table->string('order_no')->nullable();
            $table->string('style_no')->nullable();
            $table->string('product_type')->nullable();

            $table->integer('shipped_qty')->nullable();
            $table->integer('carton_qty')->nullable();
            $table->float('shipped_fob_value')->nullable();
            $table->float('shipped_cm_value')->nullable();
            $table->float('cbm_value')->nullable();

            $table->date('eta_date')->nullable();
            $table->string('vessel_name')->nullable();
            $table->date('shipbording_date')->nullable();
            $table->string('bl_no')->nullable();
            $table->date('bl_date')->nullable();

            $table->integer('final_qty')->nullable();
            $table->float('final_fob')->nullable();
            $table->float('final_cm')->nullable();
            $table->string('remarks')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
