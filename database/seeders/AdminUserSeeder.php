<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'phonetic' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin12345'), // 任意の初期パスワード
            'user_type_id' => 1, // 1 は管理者のIDと仮定
        ]);
    }
}
