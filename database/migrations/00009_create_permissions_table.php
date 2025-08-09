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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        // Insert initial permissions data
        DB::table('permissions')->insert([
    ['module' => 'Employee', 'name' => 'emp_manage', 'description' => 'Active, Deactive, Update, Delete', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Employee', 'name' => 'emp_permissions', 'description' => 'add permissions', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'exporter', 'name' => 'exporter_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Destination Country', 'name' => 'dest_country_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'consignee Details', 'name' => 'consignee_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Transport', 'name' => 'transport_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'TT Information', 'name' => 'tt_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Export Form', 'name' => 'export_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Shipping', 'name' => 'shipping_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Sales', 'name' => 'sales_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Audit', 'name' => 'audit_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Billing', 'name' => 'billing_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    ['module' => 'Logistics', 'name' => 'logistics_manage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],
    //CM Percentage
    ['module' => 'CM Percentage', 'name' => 'cm_percentage', 'description' => 'CRUD', 'created_at' => now(), 'updated_at' => now()],

]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
