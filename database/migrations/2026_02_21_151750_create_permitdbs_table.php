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
        Schema::create('permitdbs', function (Blueprint $table) {
            $table->id();
            $table->string('rname')->nullable(); 
            $table->string('oppo')->default('0'); 
            $table->string('app')->default('0'); 
            $table->string('soppo')->default('0'); 
            $table->string('sappo')->default('0'); 
            $table->string('ait')->default('0'); 
            $table->string('air')->default('0'); 
            $table->string('aia')->default('0'); 
            $table->string('stud')->default('0'); 
            $table->string('org')->default('0'); 
            $table->string('not')->default('0'); 
            $table->string('rep')->default('0'); 
            $table->string('prof')->default('1'); 
            $table->string('set')->default('0'); 
            $table->string('astud')->default('0'); 
            $table->string('estud')->default('0'); 
            $table->string('aorg')->default('0'); 
            $table->string('eorg')->default('0'); 
            $table->string('aoppo')->default('0'); 
            $table->string('eoppo')->default('0');
            $table->string('da1')->default('0');
            $table->string('da2')->default('0');
            $table->string('da3')->default('0');
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permitdbs');
    }
};
