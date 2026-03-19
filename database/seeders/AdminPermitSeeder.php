<?php

namespace Database\Seeders;

use App\Models\Permitdb;
use Illuminate\Database\Seeder;

class AdminPermitSeeder extends Seeder
{
    public function run(): void
    {
        // Admin role — all permissions ON
        Permitdb::updateOrCreate(
            ['rname' => 'admin'],
            [
                'oppo'  => true, 'app'   => true,
                'soppo' => true, 'sappo' => true,
                'ait'   => true, 'air'   => true, 'aia' => true,
                'stud'  => true, 'org'   => true,
                'not'   => true, 'rep'   => true,
                'prof'  => true, 'set'   => true,
                'astud' => true, 'estud' => true,
                'aorg'  => true, 'eorg'  => true,
                'aoppo' => true, 'eoppo' => true,
            ]
        );

        // Student role — student-facing permissions only
        Permitdb::updateOrCreate(
            ['rname' => 'student'],
            [
                'oppo'  => false, 'app'   => false,
                'soppo' => true,  'sappo' => true,
                'ait'   => false, 'air'   => false, 'aia' => false,
                'stud'  => true,  'org'   => false,
                'not'   => true,  'rep'   => false,
                'prof'  => true,  'set'   => false,
                'astud' => false, 'estud' => false,
                'aorg'  => false, 'eorg'  => false,
                'aoppo' => false, 'eoppo' => false,
            ]
        );

        // Company role — employer-facing permissions only
        Permitdb::updateOrCreate(
            ['rname' => 'company'],
            [
                'oppo'  => true,  'app'   => true,
                'soppo' => false, 'sappo' => false,
                'ait'   => false, 'air'   => false, 'aia' => false,
                'stud'  => false, 'org'   => true,
                'not'   => true,  'rep'   => false,
                'prof'  => true,  'set'   => false,
                'astud' => false, 'estud' => false,
                'aorg'  => true,  'eorg'  => true,
                'aoppo' => true,  'eoppo' => true,
            ]
        );
    }
}