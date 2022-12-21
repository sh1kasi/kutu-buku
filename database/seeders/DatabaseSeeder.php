<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $this->call(CouriersTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        // \App\Models\User::factory(10)->create();


        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin00@gmail.com',
            'is_admin' => '1',
            'password' => bcrypt('123456'),
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user00@gmail.com',
            'is_admin' => '0',
            'password' => bcrypt('123456'),
        ]);

    }
}
