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
            $table->string('item_name')->nullable();

            // hs_code
            $table->string('hs_code')->nullable();

            //hs_code_second
            $table->string('hs_code_second')->nullable();

            //invoice_no //! main invoice no that is use as foreign key at many where
            $table->string('invoice_no')->unique();

            //invoice_date
            $table->date('invoice_date')->nullable();

            //contract_no
            //contract_date
            $table->string('contract_no')->nullable();
            $table->date('contract_date')->nullable();

            // consignee_name
            // consignee_site
            // consignee_address
            $table->string('consignee_name')->nullable();//foreign key
            $table->string('consignee_site')->nullable();//foreign key
            $table->string('consignee_country')->nullable();//foreign key
            $table->string('consignee_address')->nullable();//foreign key

            // dst_country_name
            // dst_country_port
            //country_code
            $table->string('dst_country_code')->nullable();
            $table->string('dst_country_name')->nullable();
            $table->string('dst_country_port')->nullable();



            // transport_name
            // transport_address
            // transport_port
            $table->string('transport_name')->nullable();//foreign key
            $table->string('transport_address')->nullable();//foreign key
            $table->string('transport_port')->nullable();//foreign key


            // notify_name
            // notify_address
            $table->string('notify_name')->nullable();//foreign key
            $table->string('notify_address')->nullable();//foreign key


            // section
            // tt_no
            // tt_date
            $table->string('section')->nullable();

            $table->string('tt_no');//foreign key
            $table->foreign('tt_no')->references('tt_no')->on('tt_information');
            $table->date('tt_date')->nullable();

            //! invoice_site bond site
            $table->string('invoice_site')->nullable();
            $table->foreign('invoice_site')
            ->references('ExpoterName') // column in the foreign table
            ->on('exports');

            // unit
            // quantity
            // currency
            // amount
            // cm_percentage
            // incoterm
            $table->string('unit');
            $table->integer('quantity');
            $table->string('currency');
            $table->decimal('amount', 20, 4)->default(0.00);//cm value
            $table->decimal('cm_percentage', 10, 4)->default(0.00);//cm value
            $table->string('incoterm');

            //cm_amount
            //freight_value
            $table->decimal('cm_amount', 10, 4)->default(0.00);//cm value
            $table->decimal('freight_value', 10, 4)->nullable();//cm value

            // exp_no
            // exp_date
            // exp_permit_no
            // bl_no
            // bl_date
            // ex_factory_date
            //net_wet
            //gross_wet
            $table->string('exp_no')->nullable();
            $table->date('exp_date')->nullable();
            $table->string('exp_permit_no')->nullable();
            $table->string('bl_no')->nullable();
            $table->date('bl_date')->nullable();
            $table->date('ex_factory_date')->nullable();
            $table->decimal('net_wet')->nullable();
            $table->decimal('gross_wet')->nullable();

            //create_by
            //update_by
            $table->string('create_by');
            $table->string('update_by')->nullable();





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
