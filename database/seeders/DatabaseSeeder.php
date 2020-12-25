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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'kasir']);
        Role::create(['name' => 'pegawai']);
        
        User::create([
            'email' => 'admin@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(1));

        User::create([
            'email' => 'kasir@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(2));
        
        User::create([
            'email' => 'pegawai@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(3));

        $faker = Faker::create();
    	foreach (range(1,200) as $index) {
            Pegawai::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber,
                'photo' => 'test',
                'user_id' => User::find(1)->id,
            ]);
        };

        foreach (range(1,50) as $index) {
            Supplier::create([
                'name' => $faker->name,
                'phone' => $faker->e164PhoneNumber,
                'descriptions' => $faker->text($maxNbChars = 50),
            ]);
        };
        
    }
}
