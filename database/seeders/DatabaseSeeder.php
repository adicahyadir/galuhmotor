<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Dummy',
            'email' => 'dummy@dummy.com',
            'password' => '12345678',
        ]);

        Pegawai::create([
            'name' => 'Dummy',
            'address' => 'Jl. Dummy',
            'phone' => '081111111111',
            'users' => 1,
        ]);
    }
}
