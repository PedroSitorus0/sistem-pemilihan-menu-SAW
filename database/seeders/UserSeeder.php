<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $users = [
        ['nama' => 'Pedro Armando Sitorus', 'email' => 'pedrositorus0@gmail.com',],
        ['nama'=> 'Alvi Nurhaqim Purnama', 'email' => 'alvinurhakim1997@gmail.com',],
        ['nama'=> 'Giestiani Putri', 'email' => 'gistiii06@gmail.com',],
        ['nama' => 'Tazqia Cantika Ananda Deka', 'email' => 'tazqiacantikaa.d@gmail.com',],
        ['nama' => 'Tania Citra Wandini', 'email' => 'taniacitrawandini@gmail.com',],
        ['nama' => 'Zianka Nurazizah', 'email' => 'ziankanurazizah@gmail.com'],
       ];

        
       $defaultPassword = Hash::make('admin123'); //ini password komdigi;
       foreach ($users as $user) {
        User::create([
            'nama' => $user['nama'],
            'email' =>$user['email'],
            'password' => $defaultPassword,
            'role' => 'dev',
            'nomor_induk' => null,
        ]);
       }
    }
}
