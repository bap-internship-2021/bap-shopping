<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Do Thanh Quang',
            'email' => 'quangdt1603@gmail.com',
            'password' => Hash::make('quang1603'),
            'gender' => 1,
            'age' => '20',
            'phone' => '0935234129',
            'address' => 'Da Nang',
            'role_id' => 1,
            'profile_photo_path' => 'default.jpg',
            'email_verified_at' => now()
        ]);
    }
}
