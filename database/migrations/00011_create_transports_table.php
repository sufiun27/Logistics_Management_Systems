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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address');
            $table->string('port');
            $table->timestamps();
        });

        $now = now();

        DB::table('transports')->insert([
            [
                'name'       => 'Bengal Logistics',
                'address'    => '123 Port Road, Chittagong',
                'port'       => 'Chittagong Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Dhaka Freight Co',
                'address'    => '45 Trade Lane, Dhaka',
                'port'       => 'Dhaka Inland Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Khulna Trans Ltd',
                'address'    => '78 Harbor Street, Khulna',
                'port'       => 'Mongla Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Sylhet Cargo Movers',
                'address'    => '19 Border Avenue, Sylhet',
                'port'       => 'Tamabil Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Barisal Shipping',
                'address'    => '56 River Road, Barisal',
                'port'       => 'Barisal Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Rajshahi Transport',
                'address'    => '33 Trade Hub, Rajshahi',
                'port'       => 'Harian Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Narayanganj Haulage',
                'address'    => '88 Portside Drive, Narayanganj',
                'port'       => 'Narayanganj Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Mymensingh Logistics',
                'address'    => '22 Commerce Street, Mymensingh',
                'port'       => 'Mymensingh Trade Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Jessore Freightways',
                'address'    => '47 Border Road, Jessore',
                'port'       => 'Benapole Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Rangpur Carriers',
                'address'    => '15 Frontier Lane, Rangpur',
                'port'       => 'Burimari Port',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
