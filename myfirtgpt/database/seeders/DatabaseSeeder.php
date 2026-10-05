<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $email = trim((string) env('CMS_ADMIN_EMAIL'));
        $password = (string) env('CMS_ADMIN_PASSWORD');

        if ($email === '' || $password === '') {
            throw new RuntimeException('Set CMS_ADMIN_EMAIL and CMS_ADMIN_PASSWORD in your private .env before seeding.');
        }

        if (strlen($password) < 12) {
            throw new RuntimeException('CMS_ADMIN_PASSWORD must be at least 12 characters.');
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => trim((string) env('CMS_ADMIN_NAME', 'Administrator')),
                'password' => Hash::make($password),
                'is_admin' => true,
            ],
        );
    }
}
