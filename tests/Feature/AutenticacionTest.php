<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AutenticacionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba 1: Sistema de Autenticación y Usuarios
     * 
     * Esta prueba verifica:
     * - Creación de usuarios
     * - Login correcto
     * - Login incorrecto
     * - Acceso a rutas protegidas
     * - Logout
     */
    public function test_sistema_de_autenticacion_completo()
    {
        // 1. Crear un usuario de prueba
        $usuario = Usuario::create([
            'usuario' => 'admin_test',
            'password' => Hash::make('password123'),
        ]);

        $this->assertDatabaseHas('usuarios', [
            'usuario' => 'admin_test',
        ]);

        // 2. Intentar acceder a ruta protegida sin autenticación
        $response = $this->get('/mensajes');
        $response->assertRedirect('/login'); // Debe redirigir a login si no está autenticado

        // 3. Login correcto
        $response = $this->post('/login', [
            'usuario' => 'admin_test',
            'password' => 'password123'
        ]);

        $response->assertRedirect(); // Debe redirigir después del login
        $this->assertAuthenticatedAs($usuario, 'web');

        // 4. Acceder a ruta protegida después de autenticación
        $response = $this->actingAs($usuario, 'web')->get('/mensajes');
        $response->assertStatus(200); // Ahora debe permitir el acceso

        // 5. Intentar login con credenciales incorrectas
        $this->post('/logout'); // Primero cerrar sesión
        
        $response = $this->post('/login', [
            'usuario' => 'admin_test',
            'password' => 'contraseña_incorrecta'
        ]);

        $this->assertGuest(); // No debe estar autenticado

        // 6. Logout
        $this->actingAs($usuario, 'web');
        $response = $this->post('/logout');
        $this->assertGuest(); // Debe cerrar sesión correctamente

        echo "\n✅ PRUEBA 1 COMPLETADA: Sistema de Autenticación\n";
        echo "   - Usuario creado correctamente\n";
        echo "   - Login/Logout funcionando\n";
        echo "   - Protección de rutas verificada\n";
    }

    /**
     * Prueba adicional: Verificar que las vistas principales se cargan
     */
    public function test_vistas_publicas_accesibles()
    {
        // Verificar que las páginas públicas se cargan correctamente
        $this->get('/')->assertStatus(200);
        $this->get('/contactenos')->assertStatus(200);
        $this->get('/nuestros-servicios')->assertStatus(200);
        $this->get('/sobre-nosotros')->assertStatus(200);
        $this->get('/organigrama')->assertStatus(200);

        echo "\n✅ Todas las vistas públicas son accesibles\n";
    }

    /**
     * Prueba adicional: Verificar que usuario puede editar textos
     */
    public function test_usuario_autenticado_puede_editar_contenido()
    {
        $usuario = Usuario::create([
            'usuario' => 'editor',
            'password' => Hash::make('password'),
        ]);

        // Intentar editar texto sin autenticación
        $response = $this->put('/texto/contacto_titulo', [
            'clave' => 'contacto_titulo',
            'contenido' => 'Nuevo Título'
        ]);
        $response->assertStatus(302); // Debe redirigir

        // Editar texto autenticado
        $response = $this->actingAs($usuario, 'web')
            ->put('/texto/contacto_titulo', [
                'clave' => 'contacto_titulo',
                'contenido' => 'Nuevo Título Editado'
            ]);

        $this->assertDatabaseHas('textos', [
            'clave' => 'contacto_titulo',
            'contenido' => 'Nuevo Título Editado'
        ]);

        echo "\n✅ Sistema de edición de textos funcionando\n";
    }
}
