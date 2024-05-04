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
        Schema::create('export_form_apparels', function (Blueprint $table) {
            $table->id();

            // item_name
            $table->string('item_name');

            // hs_code
            $table->string('hs_code');

            //hs_code_second
            $table->string('hs_code_second')->nullable();

            //invoice_no
            $table->string('invoice_no');

            //invoice_date
            $table->date('invoice_date');

            //contract_no
            //contract_date
            $table->string('contract_no');
            $table->date('contract_date');

            // consignee_name
            // consignee_site
            // consignee_address
            $table->string('consignee_name');//foreign key
            $table->string('consignee_site');//foreign key
            $table->string('consignee_address');//foreign key

            // dst_country_name
            // dst_country_port
            $table->string('dst_country_name');//foreign key
            $table->string('dst_country_port');//foreign key

            // section
            // tt_no
            // tt_date
            $table->string('section');
            $table->string('tt_no');//foreign key
            $table->string('site');
            $table->date('tt_date');

            // unit
            // quantity
            // currency
            // amount
            // cm_percentage
            // incoterm
            $table->string('unit');
            $table->integer('quantity');
            $table->string('currency');
            $table->float('amount');
            $table->float('cm_percentage');
            $table->string('incoterm');

            //cm_amount
            //freight_value
            $table->float('cm_amount');
            $table->float('freight_value')->nullable();

            // exp_no
            // exp_date
            // exp_permit_no
            // bl_no
            // bl_date
            // ex_factory_date
            $table->string('exp_no')->nullable();
            $table->date('exp_date')->nullable();
            $table->string('exp_permit_no')->nullable();
            $table->string('bl_no')->nullable();
            $table->date('bl_date')->nullable();
            $table->date('ex_factory_date')->nullable();

            //create_by
            //update_by
            $table->string('create_by');
            $table->string('update_by')->nullable();
           
            //foreign key dst_country_port to table dest_countries column port
            $table->foreign('dst_country_port')->references('port')->on('dest_countries');   
            //foreign key tt_no to table tt_information column tt_no
            $table->foreign('tt_no')->references('tt_no')->on('tt_information');
            //foreign key consignee_site to table consignees column consignee_site
            $table->foreign('consignee_site')->references('consignee_site')->on('consignees');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('export_form_apparels');
    }
};
