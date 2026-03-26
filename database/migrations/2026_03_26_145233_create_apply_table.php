<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('oppodb_id')->constrained('oppodbs')->cascadeOnDelete();
            $table->string('cv_path');
            $table->text('cover_letter')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('status')->default('pending');
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
            $table->timestamps();

            $table->unique(['user_id', 'oppodb_id']); // prevent duplicate applications
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};