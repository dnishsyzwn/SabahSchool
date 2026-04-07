<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommitteeMember;

class CommitteeMemberSeeder extends Seeder
{
    public function run()
    {
        $members = [
            // AHLI TERTINGGI
            [
                'name' => 'TUAN SHAHRIL LIWANGSA',
                'position' => 'PRESIDEN',
                'type' => 'TOP',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'TUAN ADENAN EMPI',
                'position' => 'TIMBALAN PRESIDEN',
                'type' => 'TOP',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'TUAN YUSDY ROSLE',
                'position' => 'SETIAUSAHA AGUNG',
                'type' => 'TOP',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PUAN DG. JUANITA',
                'position' => 'BENDAHARI AGUNG',
                'type' => 'TOP',
                'sort_order' => 4,
                'is_active' => true,
            ],
            // EXCO (Example)
            [
                'name' => 'TUAN JUMAIN BIN SUDIN',
                'position' => 'EXCO BAHAGIAN',
                'division' => 'Bahagian Pantai Barat',
                'type' => 'EXCO',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'TUAN MOHD AZLI',
                'position' => 'EXCO BAHAGIAN',
                'division' => 'Bahagian Sandakan',
                'type' => 'EXCO',
                'sort_order' => 11,
                'is_active' => true,
            ],
        ];

        foreach ($members as $member) {
            CommitteeMember::create($member);
        }
    }
}
