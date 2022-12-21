<?php

namespace Database\Seeders;

use App\Models\Courier\Courier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['code' => 'jne', 'name' => 'JNE'],
            ['code' => 'pos', 'name' => 'POS'],
            ['code' => 'tiki', 'name' => 'TIKI']
        ];
        Courier::insert($data);
        
    }
}
