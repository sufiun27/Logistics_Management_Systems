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


        Schema::create('factories', function (Blueprint $table) {
    $table->id();
    $table->string('factory_name')->unique()->comment('Factory Name');
    $table->string('location')->comment('Factory Location');
    $table->string('remarks')->nullable();
    $table->timestamps();
});

DB::table('factories')->insert([
    [
        'factory_name' => 'Diva',
        'location' => 'Hop Yick (Bangladesh) Limited, Unit-1',
        'remarks' => '9,562 SQM | Established 2000 | Headcount: 2,894 | Capacity: 21.4M pcs/year',
    ],
    [
        'factory_name' => 'Legend',
        'location' => 'Hop Yick (Bangladesh) Limited, Unit-2',
        'remarks' => '12,600 SQM | Established 2000 | Headcount: 1,918 | Capacity: 13.2M pcs/year',
    ],
    [
        'factory_name' => 'Heritage',
        'location' => 'Hop Yick (Bangladesh) Limited, Unit 3-6 & 8',
        'remarks' => '31,100 SQM | Established 2000 | Headcount: 3,505 | Capacity: 27M pcs/year',
    ],
    [
        'factory_name' => 'Fashion',
        'location' => 'Hop Lun Apparel Limited',
        'remarks' => '50,810 SQM | Established 2005 | Headcount: 5,687 | Capacity: 35M pcs/year',
    ],
    [
        'factory_name' => 'Brands',
        'location' => 'Hop Lun Apparel Limited, Unit-2',
        'remarks' => '18,234 SQM | Established 2012 | Headcount: 1,868 | Capacity: 9.7M pcs/year',
    ],
    [
        'factory_name' => 'Intimate',
        'location' => 'Hop Lun Intimate (Bangladesh) Limited',
        'remarks' => '16,682 SQM | Established 2020 | Headcount: 3,008 | Capacity: 16M pcs/year',
    ],
    [
        'factory_name' => 'Cumilla',
        'location' => 'P.Y. Garments Manufacturing (Bangladesh) Company Limited',
        'remarks' => '12,778 SQM | Established 2018 | Headcount: 1,828 | Capacity: 9.6M pcs/year',
    ],
]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factories');
    }
};
