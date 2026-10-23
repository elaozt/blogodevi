<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OwnerAccountSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => env('BLOG_USER', env('BLOG_OWNER_USERNAME', 'sahibi'))],
            ['password' => Hash::make(env('BLOG_PASSWORD', env('BLOG_OWNER_PASSWORD', 'blog1234'))), 'role' => 'OWNER'],
        );
    }
}
