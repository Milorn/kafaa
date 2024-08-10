<?php

namespace Database\Seeders;

use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('data/wilayas.json');
        $wilayas = json_decode(file_get_contents($path), true);

        $data = collect($wilayas)->map(function ($wilaya) {
            return [
                'code' => $wilaya['code'],
                'name' => $wilaya['name'],
            ];
        })->toArray();

        Wilaya::insert($data);
    }
}
