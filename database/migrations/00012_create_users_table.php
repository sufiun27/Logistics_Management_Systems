<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('emp_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('designation');
            $table->string('department');
            $table->string('site');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('status')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });


        DB::table('users')->insert([
            'emp_id' => 'HM011290',
            'name' => 'Abu Sufiun',
            'email' => 'abu.sufiun@hoplun.com',
            'password' => bcrypt('12345678'),
            'designation' => 'Officer',
            'department' => 'IT',
            'site' => 'HLFS',
            'phone' => '01324724642',
            'address' => 'Dhaka',
            'remarks' => 'Developer',
            'status' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
