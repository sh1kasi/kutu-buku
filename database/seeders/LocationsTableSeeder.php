<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Indoregion\Regency;
use Illuminate\Support\Facades\DB;
use App\Models\Indoregion\Province;
use AzisHapidin\IndoRegion\RawDataGetter;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        // // Get Data
        // $districts = RawDataGetter::getDistricts();

        // // Insert Data to Database
        // DB::table('districts')->insert($districts);

        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinceRow) {
            Province::create([
                'id' => $provinceRow['province_id'],
                'name' => $provinceRow['province']
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
            foreach ($daftarKota as $cityRow) {
                Regency::create([
                    'id' => $cityRow['city_id'],
                    'province_id' => $cityRow['province_id'],
                    'name' => $cityRow['city_name']
                ]);
            }
        }
    }
}
