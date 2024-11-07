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
                'name' => "admin-shell",
                'email' => 'grantshell0@gmail.com',
                'password' => '$2y$12$Db/mbVUJO5ztblcK.fX39.Iki0snwHkotjRD26LTFQ/eAbJrY40LO',
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
