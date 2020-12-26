<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Role;
use App\Models\Suplayer;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        // \App\Models\User::factory(10)->create();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'kasir']);
        Role::create(['name' => 'pegawai']);
        
        // Admin
        User::create([
            'email' => 'admin@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(1));
        Pegawai::create([
            'name' => 'Admin Dummy',
            'address' => $faker->streetAddress,
            'phone' => $faker->e164PhoneNumber,
            'photo' => 'default.png',
        ])->users()->attach(User::find(1));

        // Kasir
        User::create([
            'email' => 'kasir@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(2));
        Pegawai::create([
            'name' => 'Kasir Dummy',
            'address' => $faker->streetAddress,
            'phone' => $faker->e164PhoneNumber,
            'photo' => 'default.png',
        ])->users()->attach(User::find(2));

        // Pegawai
        User::create([
            'email' => 'pegawai@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(3));
        Pegawai::create([
            'name' => 'Pegawai Dummy',
            'address' => $faker->streetAddress,
            'phone' => $faker->e164PhoneNumber,
            'photo' => 'default.png',
        ])->users()->attach(User::find(3));

        foreach (range(1,50) as $index) {
            Supplier::create([
                'name' => $faker->name,
                'phone' => $faker->e164PhoneNumber,
                'descriptions' => $faker->text($maxNbChars = 50),
            ]);
        };
        
    }
}
