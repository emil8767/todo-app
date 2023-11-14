<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('role_id')->nullable();
        });
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
            'description' => 'admin',
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'emil8767_11@mail.ru',
            'password' => Hash::make('admin'),
            'role_id' => 1
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'user',
            'description' => 'user',
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
