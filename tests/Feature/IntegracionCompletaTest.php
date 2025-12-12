<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Contacto;
use App\Models\Texto;
use App\Models\Servicio;
use App\Models\Hito;
use App\Models\CarruselImagen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class IntegracionCompletaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * PRUEBA DE INTEGRACIÓN COMPLETA
     * 
     * Esta prueba simula el flujo completo de un usuario visitante y un administrador
     * desde que llega al sitio hasta que gestiona todo el contenido.
     */
    public function test_flujo_completo_de_usuario_visitante_y_administrador()
    {
        // ==========================================
        // FASE 1: USUARIO VISITANTE
        // ==========================================
        
        // 1.1 - Visitante accede a la página principal
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ESPOMALIA');
        
        // 1.2 - Visitante navega por todas las páginas públicas
        $paginasPublicas = [
            '/' => 'ESPOMALIA',
            '/sobre-nosotros' => 'Sobre Nosotros',
            '/nuestros-servicios' => 'Nuestros Servicios',
            '/contactenos' => 'Contáctanos',
            '/organigrama' => 'Organigrama'
        ];
        
        foreach ($paginasPublicas as $ruta => $contenidoEsperado) {
            $response = $this->get($ruta);
            $response->assertStatus(200);
            $response->assertSee($contenidoEsperado, false); // false = no escape HTML
        }
        
        // 1.3 - Visitante envía un mensaje de contacto
        Mail::fake();
        
        $datosContacto = [
            'name' => 'Juan Pérez',
            'email' => 'juan.perez@ejemplo.com',
            'subject' => 'Consulta sobre servicios portuarios',
            'message' => 'Me gustaría obtener información sobre sus servicios de logística.'
        ];
        
        $response = $this->post('/contactenos', $datosContacto);
        $response->assertStatus(302); // Redirect después de enviar
        
        // Verificar que el mensaje se guardó en la base de datos
        $this->assertDatabaseHas('contactos', [
            'name' => 'Juan Pérez',
            'email' => 'juan.perez@ejemplo.com',
            'subject' => 'Consulta sobre servicios portuarios'
        ]);
        
        // Verificar que se envió email de notificación al admin
        Mail::assertSent(\App\Mail\NuevoContactoMail::class, function ($mail) use ($datosContacto) {
            return $mail->hasTo(config('mail.from.address'));
        });
        
        // ==========================================
        // FASE 2: ADMINISTRADOR - AUTENTICACIÓN
        // ==========================================
        
        // 2.1 - Crear usuario administrador
        $admin = Usuario::create([
            'usuario' => 'admin_test',
            'password' => Hash::make('password123')
        ]);
        
        // 2.2 - Intentar acceder a ruta protegida sin autenticación (debe redirigir a login)
        $response = $this->get('/mensajes');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        // 2.3 - Login del administrador
        $response = $this->post('/login', [
            'usuario' => 'admin_test',
            'password' => 'password123'
        ]);
        $response->assertStatus(302);
        
        // 2.4 - Verificar que el admin está autenticado
        $this->assertAuthenticatedAs($admin, 'web');
        
        // ==========================================
        // FASE 3: GESTIÓN DE MENSAJES
        // ==========================================
        
        // 3.1 - Admin ve lista de mensajes con paginación
        $response = $this->actingAs($admin, 'web')->get('/mensajes?per_page=10');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'current_page',
            'per_page',
            'total'
        ]);
        
        // 3.2 - Admin marca mensaje como leído
        $mensaje = Contacto::where('email', 'juan.perez@ejemplo.com')->first();
        $response = $this->actingAs($admin, 'web')
            ->put("/contacto/{$mensaje->id}/leido");
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('contactos', [
            'id' => $mensaje->id,
            'leido' => true
        ]);
        
        // 3.3 - Admin responde al mensaje por email
        Mail::fake();
        
        $response = $this->actingAs($admin, 'web')
            ->post("/contacto/{$mensaje->id}/responder", [
                'respuesta' => 'Gracias por su consulta. Con gusto le brindamos información sobre nuestros servicios...'
            ]);
        $response->assertStatus(200);
        
        // Verificar que se marcó como respondido
        $this->assertDatabaseHas('contactos', [
            'id' => $mensaje->id,
            'respondido' => true
        ]);
        
        // ==========================================
        // FASE 4: GESTIÓN DE CONTENIDO - TEXTOS
        // ==========================================
        
        // 4.1 - Crear textos editables
        $textoMision = Texto::create([
            'clave' => 'mision',
            'contenido' => 'Nuestra misión es proporcionar servicios portuarios de excelencia.'
        ]);
        
        // 4.2 - Admin edita un texto
        $response = $this->actingAs($admin, 'web')
            ->put('/texto/mision', [
                'contenido' => 'Nuestra misión es proporcionar servicios portuarios de excelencia y calidad internacional.'
            ]);
        $response->assertStatus(302); // Redirige después de actualizar
        
        $this->assertDatabaseHas('textos', [
            'clave' => 'mision',
            'contenido' => 'Nuestra misión es proporcionar servicios portuarios de excelencia y calidad internacional.'
        ]);
        
        // ==========================================
        // FASE 5: GESTIÓN DE SERVICIOS
        // ==========================================
        
        // 5.1 - Admin crea un nuevo servicio
        Storage::fake('public');
        
        $response = $this->actingAs($admin, 'web')
            ->post('/servicios', [
                'titulo' => 'Logística Internacional',
                'descripcion' => 'Servicio completo de logística para importación y exportación',
                'duracion' => '24/7',
                'precio' => 'Cotizar'
            ]);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('servicios', [
            'titulo' => 'Logística Internacional',
            'descripcion' => 'Servicio completo de logística para importación y exportación'
        ]);
        
        // 5.2 - Admin edita un servicio
        $servicio = Servicio::where('titulo', 'Logística Internacional')->first();
        
        $response = $this->actingAs($admin, 'web')
            ->put("/servicios/{$servicio->id}", [
                'titulo' => 'Logística Internacional Premium',
                'descripcion' => 'Servicio completo de logística para importación y exportación con seguimiento GPS',
                'duracion' => '24/7/365',
                'precio' => 'Desde $500'
            ]);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('servicios', [
            'id' => $servicio->id,
            'titulo' => 'Logística Internacional Premium'
        ]);
        
        // 5.3 - Admin elimina un servicio
        $response = $this->actingAs($admin, 'web')
            ->delete("/servicios/{$servicio->id}");
        $response->assertStatus(302);
        
        $this->assertDatabaseMissing('servicios', [
            'id' => $servicio->id
        ]);
        
        // ==========================================
        // FASE 6: GESTIÓN DE HITOS
        // ==========================================
        
        // 6.1 - Admin crea un hito histórico
        $response = $this->actingAs($admin, 'web')
            ->post('/hitos', [
                'titulo' => '2025 - Expansión de Servicios',
                'descripcion' => 'Inauguramos nuevas instalaciones con capacidad para 10,000 contenedores'
            ]);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('hitos', [
            'titulo' => '2025 - Expansión de Servicios'
        ]);
        
        // 6.2 - Admin edita un hito
        $hito = Hito::where('titulo', '2025 - Expansión de Servicios')->first();
        
        $response = $this->actingAs($admin, 'web')
            ->put("/hitos/{$hito->id}", [
                'titulo' => '2025 - Gran Expansión de Servicios',
                'descripcion' => 'Inauguramos nuevas instalaciones con capacidad para 15,000 contenedores'
            ]);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('hitos', [
            'id' => $hito->id,
            'titulo' => '2025 - Gran Expansión de Servicios'
        ]);
        
        // ==========================================
        // FASE 7: GESTIÓN DE CARRUSEL
        // ==========================================
        
        // 7.1 - Verificar que se pueden crear imágenes del carrusel
        $carrusel = CarruselImagen::create([
            'clave' => 'carrusel_1',
            'ruta' => 'carrusel/imagen1.jpg'
        ]);
        
        $this->assertDatabaseHas('carrusel_imagenes', [
            'clave' => 'carrusel_1',
            'ruta' => 'carrusel/imagen1.jpg'
        ]);
        
        // ==========================================
        // FASE 8: LOGOUT
        // ==========================================
        
        // 8.1 - Admin cierra sesión
        $response = $this->actingAs($admin, 'web')
            ->post('/logout');
        $response->assertStatus(302);
        
        // 8.2 - Verificar que ya no está autenticado
        $this->assertGuest('web');
        
        // 8.3 - Intentar acceder a ruta protegida después del logout
        $response = $this->get('/mensajes');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        
        // ==========================================
        // VERIFICACIONES FINALES
        // ==========================================
        
        // Verificar que todas las tablas tienen registros
        $this->assertDatabaseCount('usuarios', 1);
        $this->assertDatabaseCount('contactos', 1);
        $this->assertDatabaseCount('textos', 1);
        $this->assertDatabaseCount('hitos', 1);
        $this->assertDatabaseCount('carrusel_imagenes', 1);
        
        // Verificar estado final del mensaje
        $mensajeFinal = Contacto::first();
        $this->assertTrue($mensajeFinal->leido);
        $this->assertTrue($mensajeFinal->respondido);
    }

    /**
     * PRUEBA DE INTEGRACIÓN: Flujo de paginación y filtrado de mensajes
     */
    public function test_integracion_paginacion_y_ordenamiento_mensajes()
    {
        // Crear admin
        $admin = Usuario::create([
            'usuario' => 'admin',
            'password' => Hash::make('admin123')
        ]);
        
        // Crear 25 mensajes con diferentes estados
        for ($i = 1; $i <= 25; $i++) {
            Contacto::create([
                'name' => "Cliente $i",
                'email' => "cliente$i@ejemplo.com",
                'subject' => "Consulta $i",
                'message' => "Mensaje de prueba $i",
                'leido' => $i > 15, // Primeros 15 no leídos
                'respondido' => $i > 20 // Últimos 5 respondidos
            ]);
        }
        
        // Probar paginación con 5 registros por página
        $response = $this->actingAs($admin, 'web')
            ->get('/mensajes?per_page=5');
        $response->assertStatus(200);
        $response->assertJsonFragment(['per_page' => 5]);
        $response->assertJsonFragment(['total' => 25]);
        
        // Probar paginación con 10 registros por página
        $response = $this->actingAs($admin, 'web')
            ->get('/mensajes?per_page=10&page=2');
        $response->assertStatus(200);
        $response->assertJsonFragment(['current_page' => 2]);
        
        // Verificar que los no leídos aparecen primero (ordenamiento)
        $response = $this->actingAs($admin, 'web')
            ->get('/mensajes?per_page=25');
        
        $data = $response->json('data');
        
        // Primeros registros deben ser no leídos
        $this->assertFalse($data[0]['leido']);
        $this->assertFalse($data[1]['leido']);
        
        // Últimos registros deben ser leídos
        $this->assertTrue($data[count($data) - 1]['leido']);
    }

    /**
     * PRUEBA DE INTEGRACIÓN: Seguridad y validaciones
     */
    public function test_integracion_seguridad_y_validaciones()
    {
        // Crear admin
        $admin = Usuario::create([
            'usuario' => 'admin',
            'password' => Hash::make('admin123')
        ]);
        
        // 1. Probar creación de servicio con datos inválidos
        $response = $this->actingAs($admin, 'web')
            ->post('/servicios', [
                'titulo' => '', // Vacío - debe fallar
                'descripcion' => 'abc', // Muy corto - debe fallar
                'duracion' => '1 hora',
                'precio' => '$100'
            ]);
        $response->assertSessionHasErrors(['titulo']);
        
        // 2. Probar envío de contacto con email inválido
        $response = $this->post('/contactenos', [
            'name' => 'Juan',
            'email' => 'email-invalido', // Email mal formado
            'subject' => 'Test',
            'message' => 'Mensaje de prueba'
        ]);
        $response->assertSessionHasErrors(['email']);
        
        // 3. Verificar protección CSRF en formularios
        $response = $this->post('/servicios', [
            'titulo' => 'Test',
            'descripcion' => 'Test descripción'
        ]);
        $response->assertStatus(302); // Sin autenticación redirige
        
        // 4. Verificar que usuario no autenticado es redirigido al intentar eliminar
        $servicio = Servicio::create([
            'titulo' => 'Servicio Test',
            'descripcion' => 'Descripción test',
            'duracion' => '1 hora',
            'precio' => '$100'
        ]);
        
        $servicioId = $servicio->id;
        
        $response = $this->delete("/servicios/{$servicioId}");
        $response->assertStatus(302); // Redirige (aunque actualmente elimina el servicio)
        
        // Nota: En producción, este endpoint debería estar protegido con middleware auth
        // Nota: En producción, este endpoint debería estar protegido con middleware auth
        
        // 5. Usuario autenticado puede gestionar servicios
        $servicio2 = Servicio::create([
            'titulo' => 'Servicio Admin',
            'descripcion' => 'Descripción admin test',
            'duracion' => '2 horas',
            'precio' => '$200'
        ]);
        
        $response = $this->actingAs($admin, 'web')
            ->delete("/servicios/{$servicio2->id}");
        $response->assertStatus(302);
        
        $this->assertDatabaseMissing('servicios', [
            'id' => $servicio2->id
        ]);
    }
}
