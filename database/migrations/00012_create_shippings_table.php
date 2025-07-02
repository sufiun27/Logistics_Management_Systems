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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->foreign('invoice_no')->references('invoice_no')->on('export_form_apparels');

            $table->string('ep_no')->nullable();
            $table->date('ep_date')->nullable();
            $table->string('ex_pNo')->nullable();
            $table->date('exp_date')->nullable();
            $table->date('ex_factory_date')->nullable();
            $table->string('cnf_agent')->nullable();
            $table->string('transport_port')->nullable();
            $table->string('sb_no')->nullable();
            $table->date('sb_date')->nullable();
            $table->string('vessel_no')->nullable();
            $table->date('cargorpt_date')->nullable();
            $table->string('bring_back')->nullable();
            $table->string('shipped_out')->nullable();
            $table->string('shipped_cancel')->nullable();
            $table->string('shipped_back')->nullable();
            $table->string('unshipped')->nullable();

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
        Schema::dropIfExists('shippings');
    }
};
