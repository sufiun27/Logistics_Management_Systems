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
            $table->string('ExpoterName')->unique()->comment('site Or Bond'); //old exporter_no
            $table->string('ExpoterAddress');
            $table->string('RegDetails');
            $table->string('EPBReg');
            $table->timestamps();
        });

        DB::table('exports')->insert([
            [
                'ExpoterNo'      => 'Outside',
                'ExpoterName'    => 'APPAREL',
                'ExpoterAddress' => 'HOP LUN APPAREL LTD. S T TOWER, 3 NO. DHAKA- MYMENSHINGH ROAD EAST GAZIPURA, TONGI, GAZIPUR, BANGLADESH.',
                'RegDetails'     => 'REG NO : RA 78849 BIN: 18051009200 (E-BIN:000391855)',
                'EPBReg'         => 'BDO4808',
            ],
            [
                'ExpoterNo'      => 'In-Side',
                'ExpoterName'    => 'HOPYICK',
                'ExpoterAddress' => 'HOP YICK (BANGLADESH) LTD., PLOT # 61-65, DEPZ, SAVAR, DHAKA.',
                'RegDetails'     => 'BEPZA: 03.0314.014.02.00.321.2010/959 DATE: JULY 19, 2011 BIN:17141016950 (E-BIN:000391431)',
                'EPBReg'         => 'BD00000',
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
