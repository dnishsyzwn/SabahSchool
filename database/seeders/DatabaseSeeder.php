<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create superadmin account
        User::firstOrCreate(
            ['email' => 'superadmin@stu.my'],
            [
                'name'     => 'Super Admin',
                'password' => bcrypt('Admin@1234'),
                'role'     => 'superadmin',
                'is_active' => true,
            ]
        );

        // Create a regular admin account
        User::firstOrCreate(
            ['email' => 'admin@stu.my'],
            [
                'name'     => 'Admin STU',
                'password' => bcrypt('Admin@1234'),
                'role'     => 'admin',
                'is_active' => true,
            ]
        );

        $this->call([
            ActivitySeeder::class,
            CommitteeMemberSeeder::class,
        ]);

        $this->command->info('✅ Superadmin and Admin accounts created.');
        $this->command->info('   superadmin@stu.my / Admin@1234');
        $this->command->info('   admin@stu.my / Admin@1234');
    }
}
