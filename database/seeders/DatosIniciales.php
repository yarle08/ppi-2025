<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hito;
use App\Models\Texto;
use App\Models\Servicio;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class DatosIniciales extends Seeder
{
    public function run()
    {
        // Crear usuario admin
        Usuario::firstOrCreate(
            ['usuario' => 'admin'],
            ['password' => Hash::make('admin123')]
        );

        // Crear textos
        $textos = [
            ['clave' => 'historia_titulo', 'contenido' => 'Nuestra Historia'],
            ['clave' => 'historia_parrafo_1', 'contenido' => 'ESPOMALIA C.LTDA nació con el propósito de optimizar la gestión portuaria y brindar soluciones logísticas innovadoras. Fundada en 2000, comenzamos como una pequeña empresa familiar enfocada en servicios aduaneros.'],
            ['clave' => 'historia_parrafo_2', 'contenido' => 'Nuestra evolución ha estado marcada por el compromiso constante con la calidad, la innovación y la sostenibilidad. A lo largo de los años, hemos implementado mejoras significativas en nuestros procesos y servicios para satisfacer las necesidades cambiantes de nuestros clientes.'],
            ['clave' => 'mision', 'contenido' => 'Proporcionar servicios portuarios de excelencia, garantizando eficiencia y calidad en cada operación.'],
            ['clave' => 'vision', 'contenido' => 'Ser líderes en el sector portuario, reconocidos por nuestra innovación y compromiso con la sostenibilidad.'],
        ];

        foreach ($textos as $texto) {
            Texto::firstOrCreate(
                ['clave' => $texto['clave']],
                ['contenido' => $texto['contenido']]
            );
        }

        // Crear hitos
        $hitos = [
            [
                'titulo' => '2000 - Fundada la Empresa',
                'descripcion' => 'Comenzamos nuestras operaciones con un pequeño equipo de profesionales dedicados.',
                'imagen' => 'https://picsum.photos/seed/empresa2000/400/300'
            ],
            [
                'titulo' => '2010 - Expansión',
                'descripcion' => 'Expandimos nuestras instalaciones y duplicamos nuestra capacidad operativa.',
                'imagen' => 'https://picsum.photos/seed/expansion2010/400/300'
            ],
            [
                'titulo' => '2020 - Enfoque en Sostenibilidad',
                'descripcion' => 'Adoptamos prácticas sostenibles en todas nuestras operaciones.',
                'imagen' => 'https://picsum.photos/seed/sostenibilidad2020/400/300'
            ],
        ];

        foreach ($hitos as $hito) {
            Hito::firstOrCreate(
                ['titulo' => $hito['titulo']],
                $hito
            );
        }

        // Crear servicios
        $servicios = [
            [
                'titulo' => 'Logística Internacional',
                'descripcion' => 'Gestión completa de importación y exportación con seguimiento en tiempo real.',
                'duracion' => '24/7',
                'precio' => 'Cotizar',
                'imagen' => 'https://picsum.photos/seed/logistica/400/300'
            ],
            [
                'titulo' => 'Almacenamiento Portuario',
                'descripcion' => 'Instalaciones modernas y seguras para el almacenamiento de mercancías.',
                'duracion' => 'Flexible',
                'precio' => 'Desde $500/mes',
                'imagen' => 'https://picsum.photos/seed/almacenamiento/400/300'
            ],
            [
                'titulo' => 'Gestión Aduanera',
                'descripcion' => 'Asesoría y trámites aduaneros completos para agilizar sus operaciones.',
                'duracion' => '1-3 días',
                'precio' => 'Desde $200',
                'imagen' => 'https://picsum.photos/seed/aduanera/400/300'
            ],
        ];

        foreach ($servicios as $servicio) {
            Servicio::firstOrCreate(
                ['titulo' => $servicio['titulo']],
                $servicio
            );
        }

        echo "✅ Datos iniciales creados exitosamente!\n";
        echo "👤 Usuario: admin | Contraseña: admin123\n";
        echo "📊 Hitos: " . Hito::count() . "\n";
        echo "📝 Textos: " . Texto::count() . "\n";
        echo "🛠️ Servicios: " . Servicio::count() . "\n";
    }
}
