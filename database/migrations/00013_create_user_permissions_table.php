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
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // Insert initial user permissions data
        // DB::table('user_permissions')->insert([
        //     ['id' => 1, 'user_id' => 1, 'permission_id' => 2, 'status' => 1, 'created_at' => null, 'updated_at' => null],
        //     ['id' => 2, 'user_id' => 1, 'permission_id' => 3, 'status' => 1, 'created_at' => null, 'updated_at' => null],
        //     ['id' => 3, 'user_id' => 1, 'permission_id' => 15, 'status' => 1, 'created_at' => '2024-12-16 10:13:37.000000', 'updated_at' => '2024-12-16 10:13:37.000000'],
        //     ['id' => 4, 'user_id' => 1, 'permission_id' => 16, 'status' => 1, 'created_at' => '2024-12-16 10:13:40.000000', 'updated_at' => '2024-12-16 10:13:40.000000'],
        //     ['id' => 5, 'user_id' => 1, 'permission_id' => 9, 'status' => 1, 'created_at' => '2024-12-16 10:13:40.000000', 'updated_at' => '2024-12-16 10:13:40.000000'],
        //     ['id' => 6, 'user_id' => 1, 'permission_id' => 7, 'status' => 1, 'created_at' => '2024-12-16 10:13:44.000000', 'updated_at' => '2024-12-16 10:13:44.000000'],
        //     ['id' => 7, 'user_id' => 1, 'permission_id' => 12, 'status' => 1, 'created_at' => '2024-12-16 10:13:44.000000', 'updated_at' => '2024-12-16 10:13:44.000000'],
        //     ['id' => 8, 'user_id' => 1, 'permission_id' => 6, 'status' => 1, 'created_at' => '2024-12-16 10:13:45.000000', 'updated_at' => '2024-12-16 10:13:45.000000'],
        //     ['id' => 9, 'user_id' => 1, 'permission_id' => 17, 'status' => 1, 'created_at' => '2024-12-16 10:13:48.000000', 'updated_at' => '2024-12-16 10:13:48.000000'],
        //     ['id' => 10, 'user_id' => 1, 'permission_id' => 14, 'status' => 1, 'created_at' => '2024-12-16 10:13:49.000000', 'updated_at' => '2024-12-16 10:13:49.000000'],
        //     ['id' => 11, 'user_id' => 1, 'permission_id' => 13, 'status' => 1, 'created_at' => '2024-12-16 10:13:51.000000', 'updated_at' => '2024-12-16 10:13:51.000000'],
        //     ['id' => 12, 'user_id' => 1, 'permission_id' => 10, 'status' => 1, 'created_at' => '2024-12-16 10:13:52.000000', 'updated_at' => '2024-12-16 10:13:52.000000'],
        //     ['id' => 13, 'user_id' => 1, 'permission_id' => 11, 'status' => 1, 'created_at' => '2024-12-16 10:13:52.000000', 'updated_at' => '2024-12-16 10:13:52.000000'],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};
