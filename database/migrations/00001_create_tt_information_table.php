<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

            $table->decimal('tt_amount', 16, 4)->default(0.00);//cm value

            $table->decimal('tt_used_amount', 10, 4)->default(0);//cm value

            $table->string('tt_currency')->nullable();
            $table->string('bank_name')->nullable();


            $table->string('tt_site'); //HLFS

            $table->dateTime('tt_date')->nullable();

            $table->string('tt_created_by')->nullable();
            $table->string('Modified_by')->nullable();
            $table->boolean('tt_status')->default(1);
            $table->string('tt_remarks')->nullable();
            $table->timestamps();
        });

        DB::table('tt_information')->insert([
            [
                'tt_no' => 'TT002',
                'tt_amount' => 15000.5000,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'USD',
                'bank_name' => 'Standard Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM012345',
                'Modified_by' => 'HM012345',
                'tt_status' => true,
                'tt_remarks' => 'Export transaction for Dhaka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT003',
                'tt_amount' => 8200.7500,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'EUR',
                'bank_name' => 'City Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM023456',
                'Modified_by' => 'HM023456',
                'tt_status' => true,
                'tt_remarks' => 'Khulna port payment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT004',
                'tt_amount' => 20000.2500,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'GBP',
                'bank_name' => 'HSBC',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM034567',
                'Modified_by' => 'HM034567',
                'tt_status' => true,
                'tt_remarks' => 'Rajshahi export deal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT005',
                'tt_amount' => 9500.0000,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'USD',
                'bank_name' => 'Dutch Bangla Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM045678',
                'Modified_by' => 'HM045678',
                'tt_status' => true,
                'tt_remarks' => 'Sylhet trade transaction',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT006',
                'tt_amount' => 17500.3000,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'AUD',
                'bank_name' => 'Brac Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM056789',
                'Modified_by' => 'HM056789',
                'tt_status' => true,
                'tt_remarks' => 'Barisal port TT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT007',
                'tt_amount' => 12000.6000,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'USD',
                'bank_name' => 'Sonali Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM067890',
                'Modified_by' => 'HM067890',
                'tt_status' => true,
                'tt_remarks' => 'Cumilla transaction',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT008',
                'tt_amount' => 6500.2000,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'EUR',
                'bank_name' => 'Pubali Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM078901',
                'Modified_by' => 'HM078901',
                'tt_status' => true,
                'tt_remarks' => 'Narayanganj export',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT009',
                'tt_amount' => 18000.4000,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'CAD',
                'bank_name' => 'Eastern Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM089012',
                'Modified_by' => 'HM089012',
                'tt_status' => true,
                'tt_remarks' => 'Mymensingh trade payment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT010',
                'tt_amount' => 14000.8000,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'USD',
                'bank_name' => 'United Commercial Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM090123',
                'Modified_by' => 'HM090123',
                'tt_status' => true,
                'tt_remarks' => 'Jessore border transaction',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tt_no' => 'TT011',
                'tt_amount' => 11000.1000,
                'tt_used_amount' => 0.0000,
                'tt_currency' => 'GBP',
                'bank_name' => 'Islami Bank',
                'tt_site' => 'HLFS',
                'tt_created_by' => 'HM101234',
                'Modified_by' => 'HM101234',
                'tt_status' => true,
                'tt_remarks' => 'Rangpur export TT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tt_information');
    }
};
