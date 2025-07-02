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
        Schema::create('billing_details', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->foreign('invoice_no')->references('invoice_no')->on('export_form_apparels');

            $table->string('sb_no')->nullable();
            $table->date('sb_date')->nullable();
            $table->date('doc_submit_date')->nullable();

            $table->string('hk_courier_no')->nullable();
            $table->date('hk_courier_date')->nullable();
            $table->string('buyer_courier_no')->nullable();

            $table->date('buyer_courier_date')->nullable();
            $table->string('lead_time')->nullable();
            $table->date('bank_submit_date')->nullable();

            $table->string('mode')->nullable();
            $table->string('bd_thc')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_details');
    }
};
