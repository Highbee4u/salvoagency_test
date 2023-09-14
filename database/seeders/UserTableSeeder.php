<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Admin',
                'email' => 'admin@salvo.com',
                'password' => bcrypt('password'),
                'role' => 'superadmin'
            ],
            [
                'name' => 'Developer',
                'email' => 'developer@salvo.com',
                'password' => bcrypt('password'),
                'role' => 'developer'
            ],
            [
                'name' => 'Support',
                'email' => 'support@salvo.com',
                'password' => bcrypt('password'),
                'role' => 'support'
            ]
        ];

        foreach($datas as $data){
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role']
            ]);
        }
    }
}
