<?php

namespace Database\Seeders;

use App\Models\ActivityArea;
use Illuminate\Database\Seeder;

class ActivityAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Agroalimentaire'],
            ['name' => 'Electrique, Electronique'],
            ['name' => 'Matériaux de construction'],
            ['name' => 'Energies'],
            ['name' => 'Dispositifs Médicaux'],
            ['name' => 'Textile'],
            ['name' => 'Industrie divers'],
            ['name' => 'Caoutchouc, Plastique'],
            ['name' => 'Mécanique'],
            ['name' => 'Bois, Papier, Emballage'],
            ['name' => 'Métallurgie'],
            ['name' => 'Recyclage'],
            ['name' => 'Chimie, Pharmacie'],
            ['name' => 'Transformation du verre'],
        ];

        ActivityArea::insert($data);
    }
}
