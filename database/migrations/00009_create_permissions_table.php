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
            ['id' => 2, 'module' => 'Employee', 'name' => 'emp_manage', 'description' => 'Active, Deactive, Update, Delete', 'created_at' => null, 'updated_at' => null],
            ['id' => 3, 'module' => 'Employee', 'name' => 'emp_permissions', 'description' => 'add permissions', 'created_at' => null, 'updated_at' => null],
            ['id' => 6, 'module' => 'exporter', 'name' => 'exporter_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 7, 'module' => 'Destination Country', 'name' => 'dest_country_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 9, 'module' => 'consignee Details', 'name' => 'consignee_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 10, 'module' => 'Transport', 'name' => 'transport_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 11, 'module' => 'TT Information', 'name' => 'tt_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 12, 'module' => 'Export Form', 'name' => 'export_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 13, 'module' => 'Shipping', 'name' => 'shipping_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 14, 'module' => 'Sales', 'name' => 'sales_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 15, 'module' => 'Audit', 'name' => 'audit_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 16, 'module' => 'Billing', 'name' => 'billing_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
            ['id' => 17, 'module' => 'Logistics', 'name' => 'logistics_manage', 'description' => 'CRUD', 'created_at' => null, 'updated_at' => null],
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
