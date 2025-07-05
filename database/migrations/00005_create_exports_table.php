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
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->string('ExpoterNo')->unique()->autoIncrement();;
            $table->string('ExpoterName')->unique(); //old exporter_no
            $table->string('ExpoterAddress');
            $table->string('RegDetails');
            $table->string('EPBReg');
            $table->timestamps();
        });

        DB::table('exports')->insert([
            [
                'ExpoterNo'      => 'XFTR',
                'ExpoterName'    => 'Dhaka',
                'ExpoterAddress' => 'Dhaka Port',
                'RegDetails'     => 'Dhaka Port Registration',
                'EPBReg'         => '002DH',
            ],
            [
                'ExpoterNo'      => 'KLMP',
                'ExpoterName'    => 'Khulna',
                'ExpoterAddress' => 'Mongla Port',
                'RegDetails'     => 'Mongla Port Registration',
                'EPBReg'         => '003KH',
            ],
            [
                'ExpoterNo'      => 'RJSV',
                'ExpoterName'    => 'Rajshahi',
                'ExpoterAddress' => 'Harian Port',
                'RegDetails'     => 'Harian Port Registration',
                'EPBReg'         => '004RJ',
            ],
            [
                'ExpoterNo'      => 'SYLT',
                'ExpoterName'    => 'Sylhet',
                'ExpoterAddress' => 'Tamabil Border',
                'RegDetails'     => 'Tamabil Border Registration',
                'EPBReg'         => '005SY',
            ],
            [
                'ExpoterNo'      => 'BRSP',
                'ExpoterName'    => 'Barisal',
                'ExpoterAddress' => 'Barisal Port',
                'RegDetails'     => 'Barisal Port Registration',
                'EPBReg'         => '006BR',
            ],
            [
                'ExpoterNo'      => 'CMPL',
                'ExpoterName'    => 'Cumilla',
                'ExpoterAddress' => 'Cumilla Trade Center',
                'RegDetails'     => 'Cumilla Trade Registration',
                'EPBReg'         => '007CM',
            ],
            [
                'ExpoterNo'      => 'NGPR',
                'ExpoterName'    => 'Narayanganj',
                'ExpoterAddress' => 'Narayanganj Port',
                'RegDetails'     => 'Narayanganj Port Registration',
                'EPBReg'         => '008NG',
            ],
            [
                'ExpoterNo'      => 'MNSR',
                'ExpoterName'    => 'Mymensingh',
                'ExpoterAddress' => 'Mymensingh Trade Hub',
                'RegDetails'     => 'Mymensingh Trade Registration',
                'EPBReg'         => '009MY',
            ],
            [
                'ExpoterNo'      => 'JSRP',
                'ExpoterName'    => 'Jessore',
                'ExpoterAddress' => 'Benapole Border',
                'RegDetails'     => 'Benapole Border Registration',
                'EPBReg'         => '010JS',
            ],
            [
                'ExpoterNo'      => 'RNPR',
                'ExpoterName'    => 'Rangpur',
                'ExpoterAddress' => 'Burimari Border',
                'RegDetails'     => 'Burimari Border Registration',
                'EPBReg'         => '011RN',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};
