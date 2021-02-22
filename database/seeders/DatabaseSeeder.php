<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Categories;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Merk;
use App\Models\Merks;
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
        $limit = 100;
        // \App\Models\User::factory(10)->create();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'kasir']);
        Role::create(['name' => 'pegawai']);

        // Admin
        User::create([
            'name' => 'Admin Dummy',
            'address' => $faker->streetAddress,
            'phone' => $faker->e164PhoneNumber,
            'photo' => 'default.png',
            'email' => 'admin@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(1));

        // Kasir
        User::create([
            'name' => 'Kasir Dummy',
            'address' => $faker->streetAddress,
            'phone' => $faker->e164PhoneNumber,
            'photo' => 'default.png',
            'email' => 'kasir@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(2));

        // Pegawai
        User::create([
            'name' => 'Pegawai Dummy 1',
            'address' => $faker->streetAddress,
            'phone' => $faker->e164PhoneNumber,
            'photo' => 'default.png',
            'email' => 'pegawai_1@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(3));

        User::create([
            'name' => 'Pegawai Dummy 2',
            'address' => $faker->streetAddress,
            'phone' => $faker->e164PhoneNumber,
            'photo' => 'default.png',
            'email' => 'pegawai_2@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find(3));

        foreach (range(1, $limit) as $index) {
            Supplier::create([
                'name' => $faker->name,
                'phone' => $faker->e164PhoneNumber,
                'descriptions' => $faker->text($maxNbChars = 50),
            ]);

            Categories::create([
                'name' => $faker->realText($maxNbChars = 20, $indexSize = 2),
            ]);

            Merk::create([
                'name' => $faker->realText($maxNbChars = 20, $indexSize = 2),
            ]);
        };

        foreach (range(1, $limit) as $index) {
            Item::create([
                'name' => $faker->realText($maxNbChars = 20, $indexSize = 2),
                'qty' => $faker->numberBetween($min = 1, $max = 9999),
                'price' => $faker->numberBetween($min = 10000, $max = 999999),
                'merk_id' => $faker->numberBetween($min = 1, $max = $limit),
                'categories_id' => $faker->numberBetween($min = 1, $max = $limit),
                'supplier_id' => $faker->numberBetween($min = 1, $max = $limit),
            ]);
        };
    }
}
