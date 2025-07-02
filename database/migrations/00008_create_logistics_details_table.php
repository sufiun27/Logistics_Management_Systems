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
        Schema::create('logistics_details', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_no')->unique();
            $table->foreign('invoice_no')->references('invoice_no')->on('export_form_apparels');

            $table->float('receivable_amount')->nullable();
            $table->float('doc_process_fee')->nullable();

            $table->float('seal_lock_charge')->nullable();
            $table->float('agency_commission')->nullable();
            $table->float('documentation_charge')->nullable();
            $table->float('transportation_charge')->nullable();

            $table->float('short_shipment_certificate_fee')->nullable();
            $table->float('factory_loading_fee')->nullable();
            $table->float('uploading_fee_forwarder_wh')->nullable();
            $table->float('truck_demurrage_fee_delay_at_depot')->nullable();
            $table->float('cfs_depot_mixed_cargo_loading_fee')->nullable();
            $table->float('customs_misc_remark_reasons_charge')->nullable();
            $table->string('customs_remark_charge_misc_reasons')->nullable();

            $table->date('cargo_ho_date')->nullable();
            $table->date('deadline_bill_submission')->nullable();
            $table->date('bill_received_date')->nullable();
            $table->string('status')->nullable();
            $table->string('forwarder_name');
            $table->float('total_charges')->nullable();

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
        Schema::dropIfExists('logistics_details');
    }
};
