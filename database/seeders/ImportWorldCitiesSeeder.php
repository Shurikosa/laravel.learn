<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class ImportWorldCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(storage_path('app/worldcities.csv'), 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();

        foreach ($records as $record) {
            $country = Country::firstOrCreate(
                ['iso2' => $record['iso2'], 'iso3' => $record['iso3']],
            ['name' => $record['country']]
            );

            City::create([
                'name' => $record['city'],
                'ascii_name' => $record['city_ascii'],
                'population' => $record['population'] ? (int)$record['population'] : null,
                'admin_name' => $record['admin_name'],
                'capital' => $record['capital'] ? strtolower($record['capital']) : null,
                'lng' => $record['lng'],
                'lat' => $record['lat'],
                'country_id' => $country->id,
            ]);
        }
    }
}
