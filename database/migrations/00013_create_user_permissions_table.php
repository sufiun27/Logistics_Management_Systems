<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
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
        DB::table('user_permissions')->insert([
        ['user_id' => 1, 'permission_id' => 1, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 2, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 3, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 4, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 5, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 6, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 7, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 8, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 9, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 10, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 11, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 12, 'status' => 1],
        ['user_id' => 1, 'permission_id' => 13, 'status' => 1],
    ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};
