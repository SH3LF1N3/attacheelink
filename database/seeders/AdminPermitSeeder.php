<?php

namespace Database\Seeders;

use App\Models\Permitdb;
use Illuminate\Database\Seeder;

class AdminPermitSeeder extends Seeder
{
    public function run(): void
    {
        // Admin — full access 
        Permitdb::updateOrCreate(
            ['rname' => 'admin'],
            [
                // Opportunity management
                'oppo'  => true,  'app'   => true,
                // Student-facing (not needed for admin but set for completeness)
                'soppo' => false, 'sappo' => false,
                // AI tools
                'ait'   => true,  'air'   => true,  'aia' => true,
                // Sections
                'stud'  => true,  'org'   => true,
                'not'   => true,  'rep'   => true,
                'prof'  => true,  'set'   => true,
                // CRUD
                'astud' => true,  'estud' => true,
                'aorg'  => true,  'eorg'  => true,
                'aoppo' => true,  'eoppo' => true,
            ]
        );

        // Student — personal access only 
        // soppo = browse/view opportunities, sappo = manage own applications
        Permitdb::updateOrCreate(
            ['rname' => 'student'],
            [
                'oppo'  => false, 'app'   => false,   // cannot manage others' content
                'soppo' => true,  'sappo' => true,     // can browse & apply
                'ait'   => false, 'air'   => true,     // can use resume checker
                'aia'   => false,
                'stud'  => false, 'org'   => false,
                'not'   => true,  'rep'   => false,
                'prof'  => true,  'set'   => false,
                'astud' => false, 'estud' => false,
                'aorg'  => false, 'eorg'  => false,
                'aoppo' => false, 'eoppo' => false,
            ]
        );

        // Company — employer access 
        // oppo = manage own listings, app = manage applications to their listings
        Permitdb::updateOrCreate(
            ['rname' => 'company'],
            [
                'oppo'  => true,  'app'   => true,
                'soppo' => false, 'sappo' => false,
                'ait'   => false, 'air'   => false, 'aia' => false,
                'stud'  => false, 'org'   => true,   // can view org profile
                'not'   => true,  'rep'   => false,
                'prof'  => true,  'set'   => false,
                'astud' => false, 'estud' => false,
                'aorg'  => true,  'eorg'  => true,   // can edit own org
                'aoppo' => true,  'eoppo' => true,   // can create/edit own opportunities
            ]
        );
    }
}