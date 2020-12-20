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
        // \App\Models\User::factory(10)->create();

        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'kasir',
        ]);
        Role::create([
            'name' => 'pegawai',
        ]);
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@dummy.com',
            'password' => Hash::make(123456),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@dummy.com',
            'password' => Hash::make(123456),
            'role_id' => 2,
        ]);

        $user = User::first();
        $faker = Faker::create();
    	foreach (range(1,200) as $index) {
            Pegawai::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber,
                'photo' => 'test',
                'user_id' => $user->id,
            ]);
        }

        foreach (range(1,50) as $index) {
            Supplier::create([
                'name' => $faker->name,
                'phone' => $faker->e164PhoneNumber,
                'descriptions' => $faker->text($maxNbChars = 50),
            ]);
        }
        
    }
}
