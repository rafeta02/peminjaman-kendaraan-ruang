<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'id_simpeg'      => '',
                'nip'            => '',
                'no_identitas'   => '',
                'nama'           => '',
                'username'       => '',
                'no_hp'          => '',
                'jwt_token'      => '',
                'foto_url'       => '',
            ],
        ];

        User::insert($users);
    }
}
