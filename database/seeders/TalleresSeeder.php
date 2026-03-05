<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Taller;

class TalleresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $talleres = [
            ['nombre' => 'Cocina', 'aula' => 'Aula 1'],
            ['nombre' => 'Jardinería', 'aula' => 'Aula 2'],
            ['nombre' => 'Manualidades', 'aula' => 'Aula 3'],
            ['nombre' => 'Carpintería', 'aula' => 'Aula 4'],
            ['nombre' => 'Mantenimiento', 'aula' => 'Aula 5'],
            ['nombre' => 'informatica', 'aula' => 'Aula 6'],
        ];

        foreach ($talleres as $taller) {
            Taller::create($taller);
        }
    }
}