<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the default 'name' column Laravel ships with
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }

            // Add custom columns only if they don't already exist
            if (! Schema::hasColumn('users', 'uname')) {
                $table->string('uname')->nullable()->after('id');
            }
            if (! Schema::hasColumn('users', 'fname')) {
                $table->string('fname')->nullable()->after('uname');
            }
            if (! Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->after('email');
            }
            if (! Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 10)->nullable()->after('phone');
            }
            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('student')->after('gender');
            }
            if (! Schema::hasColumn('users', 'cv')) {
                $table->string('cv')->nullable()->after('role');
            }
            if (! Schema::hasColumn('users', 'sid')) {
                $table->string('sid')->nullable()->after('cv');
            }

            // Spare columns
            foreach (range(1, 10) as $i) {
                $col = 'foth' . $i;
                if (! Schema::hasColumn('users', $col)) {
                    $table->string($col)->nullable()->after('sid');
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'uname', 'fname', 'phone', 'gender',
                'role', 'cv', 'sid',
                'foth1','foth2','foth3','foth4','foth5',
                'foth6','foth7','foth8','foth9','foth10',
            ]);

            // Restore default name column
            $table->string('name')->after('id');
        });
    }
};