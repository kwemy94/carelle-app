<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            array(
                'name' => "admin",
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin-shell'),
            )
        );

        foreach ($users as $user) {
            $exitUser = User::where('email', $user['email'])->first();

            if (!$exitUser) {
                User::create($user);
            }
        }
    }
}
