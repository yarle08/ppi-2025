<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organigrama;

class OrganigramaSeeder extends Seeder
{
    public function run()
    {
        $cargos = [
            [
                'cargo' => 'presidente',
                'titulo' => 'Presidente',
                'descripcion' => 'El presidente lidera la estrategia general de la empresa y supervisa todas las operaciones clave.',
                'imagen' => null
            ],
            [
                'cargo' => 'vicepresidente',
                'titulo' => 'Vicepresidente',
                'descripcion' => 'El vicepresidente apoya al presidente y se encarga de áreas clave como desarrollo y operaciones.',
                'imagen' => null
            ],
            [
                'cargo' => 'contador',
                'titulo' => 'Contador',
                'descripcion' => 'El contador gestiona las finanzas de la empresa, asegurando la transparencia y la eficiencia.',
                'imagen' => null
            ],
            [
                'cargo' => 'empleados',
                'titulo' => 'Empleados',
                'descripcion' => 'Los empleados son el motor de la empresa, trabajando en diversas áreas para alcanzar los objetivos.',
                'imagen' => null
            ]
        ];

        foreach ($cargos as $cargo) {
            Organigrama::updateOrCreate(
                ['cargo' => $cargo['cargo']],
                $cargo
            );
        }
    }
}
