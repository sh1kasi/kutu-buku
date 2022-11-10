<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $this->call('CreateUserSeeder');
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
