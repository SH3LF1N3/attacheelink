<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('oppodbs', function (Blueprint $table) {
            $table->text('descr')->change();
        });
    }

    public function down(): void
    {
        Schema::table('oppodbs', function (Blueprint $table) {
            $table->string('descr')->change();
        });
    }
};