<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('uname');
            $table->string('fname')->nullable(); 
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('role');
            $table->longText('cv')->nullable();
            $table->longText('sid')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foth1')->nullable();
            $table->string('foth2')->nullable();
            $table->string('foth3')->nullable();
            $table->string('foth4')->nullable();
            $table->string('foth5')->nullable();
            $table->string('foth6')->nullable();
            $table->string('foth7')->nullable();
            $table->string('foth8')->nullable();
            $table->string('foth9')->nullable();
            $table->string('foth10')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
