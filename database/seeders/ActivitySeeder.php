<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        if (!$admin) return;

        // Featured Activity
        Activity::create([
            'title'       => "Manfaat Perlindungan\n<span class=\"text-transparent bg-clip-text bg-gradient-to-r from-green to-[#016b61]\">Penyakit Kritikal</span>",
            'slug'        => Str::slug('Manfaat Perlindungan Penyakit Kritikal') . '-' . time(),
            'category'    => 'FEATURED',
            'description' => 'Penyerahan tuntutan manfaat penyakit kritikal kepada Encik Nur Arif Shah bin Ramli di SK Pekan Telupid. Bantuan ini bertujuan untuk menyokong kos rawatan dan keperluan perubatan beliau bagi mengharungi fasa pemulihan.',
            'event_date'  => '2025-01-01',
            'location'    => 'Telupid',
            'amount'      => 'RM 80k',
            'status'      => 'published',
            'is_featured' => true,
            'published_at' => now(),
            'created_by'  => $admin->id,
        ]);

        // Regular Activities
        $data = [
            [
                'title'    => "Penyerahan Pampasan\nKematian Ahli KGS",
                'category' => 'KEBAJIKAN',
                'description' => 'Penyerahan pampasan kepada Che Farhani binti Che Jaffar, waris kepada Allahyarham Zulkifli Ahmad bin Jusoh sebagai tanda keprihatinan dan bantuan kebajikan ahli Kesatuan Guru-Guru Sabah (KGS).',
                'event_date'  => '2023-11-28',
                'location'    => 'SK Karamunting, Sandakan',
                'amount'      => 'RM 10,000.00'
            ],
            [
                'title'    => "Penyerahan Pampasan\nKematian Anak Ahli",
                'category' => 'KEBAJIKAN',
                'description' => 'Penyerahan pampasan kepada Norfazila binti Md Lajin atas pemergian anakanda tercinta, Abdul Fattah bin Khairol. Sumbangan ini diharap dapat meringankan beban keluarga dalam menghadapi dugaan ini.',
                'event_date'  => '2025-09-27',
                'location'    => 'SMK Kelana Putra Lenggeng',
                'amount'      => 'RM 40,000.00'
            ],
            [
                'title'    => "Penyerahan Tuntutan\nPenyakit Kritikal",
                'category' => 'KESIHATAN',
                'description' => 'Tuntutan manfaat penyakit kritikal yang berjaya diproses dan diserahkan kepada Puan Rohayu binti Kandar. Program perlindungan ini merupakan komitmen kesatuan dalam menjaga kebajikan kesihatan setiap ahli.',
                'event_date'  => '2024-06-12',
                'location'    => 'SK Kolapis, Beluran',
                'amount'      => 'RM 60,000.00'
            ]
        ];

        foreach ($data as $item) {
            Activity::create(array_merge($item, [
                'slug'         => Str::slug(str_replace("\n", ' ', $item['title'])) . '-' . rand(100, 999),
                'status'       => 'published',
                'published_at' => now(),
                'created_by'   => $admin->id,
            ]));
        }
    }
}
