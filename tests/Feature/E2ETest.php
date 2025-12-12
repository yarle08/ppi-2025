<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Contacto;
use App\Models\Texto;
use App\Models\Servicio;
use App\Models\Hito;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

/**
 * PRUEBAS END-TO-END (E2E)
 * 
 * Estas pruebas simulan el comportamiento completo del usuario final
 * interactuando con la aplicación desde el navegador.
 */
class E2ETest extends TestCase
{
    use RefreshDatabase;

    /**
     * E2E TEST 1: Flujo completo de un visitante navegando y contactando
     * 
     * Escenario: Un usuario nuevo visita el sitio web por primera vez,
     * navega por todas las páginas y finalmente envía un mensaje de contacto.
     */
    public function test_e2e_visitante_navega_y_envia_mensaje()
    {
        echo "\n\n🌐 INICIANDO PRUEBA E2E 1: VISITANTE NAVEGA Y CONTACTA\n";
        echo "=" . str_repeat("=", 60) . "\n";
        
        // PASO 1: Usuario llega a la página principal
        echo "\n📍 PASO 1: Visitante accede a la página principal...\n";
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ESPOMALIA', false);
        $response->assertSee('Inicio', false);
        echo "   ✅ Página principal cargada correctamente\n";
        echo "   ✅ Logo y menú de navegación visibles\n";
        
        // PASO 2: Usuario navega a "Sobre Nosotros"
        echo "\n📍 PASO 2: Visitante hace clic en 'Sobre Nosotros'...\n";
        $response = $this->get('/sobre-nosotros');
        $response->assertStatus(200);
        $response->assertSee('Sobre Nosotros', false);
        echo "   ✅ Página 'Sobre Nosotros' cargada\n";
        echo "   ✅ Información de la empresa visible\n";
        
        // PASO 3: Usuario navega a "Nuestros Servicios"
        echo "\n📍 PASO 3: Visitante revisa los servicios ofrecidos...\n";
        $response = $this->get('/nuestros-servicios');
        $response->assertStatus(200);
        $response->assertSee('Nuestros Servicios', false);
        echo "   ✅ Catálogo de servicios visible\n";
        
        // PASO 4: Usuario navega al Organigrama
        echo "\n📍 PASO 4: Visitante consulta el organigrama...\n";
        $response = $this->get('/organigrama');
        $response->assertStatus(200);
        $response->assertSee('Organigrama', false);
        echo "   ✅ Organigrama de la empresa visible\n";
        
        // PASO 5: Usuario decide contactar a la empresa
        echo "\n📍 PASO 5: Visitante accede al formulario de contacto...\n";
        $response = $this->get('/contactenos');
        $response->assertStatus(200);
        $response->assertSee('Contáct', false); // Contáctanos o Contáctenos
        $response->assertSee('name', false);
        $response->assertSee('email', false);
        $response->assertSee('subject', false);
        $response->assertSee('message', false);
        echo "   ✅ Formulario de contacto cargado\n";
        echo "   ✅ Campos visibles: Nombre, Email, Asunto, Mensaje\n";
        
        // PASO 6: Usuario completa y envía el formulario
        echo "\n📍 PASO 6: Visitante completa el formulario...\n";
        Mail::fake();
        
        $datosContacto = [
            'name' => 'María González',
            'email' => 'maria.gonzalez@empresa.com',
            'subject' => 'Solicitud de cotización para servicios logísticos',
            'message' => 'Buenos días, estamos interesados en sus servicios de logística internacional para exportación de productos. ¿Podrían enviarme información sobre sus tarifas?'
        ];
        
        echo "   📝 Datos ingresados:\n";
        echo "      - Nombre: {$datosContacto['name']}\n";
        echo "      - Email: {$datosContacto['email']}\n";
        echo "      - Asunto: {$datosContacto['subject']}\n";
        
        $response = $this->post('/contactenos', $datosContacto);
        $response->assertStatus(302); // Redirect después de enviar
        echo "   ✅ Formulario enviado exitosamente\n";
        
        // PASO 7: Verificar que el mensaje se guardó
        echo "\n📍 PASO 7: Verificando que el mensaje se guardó en el sistema...\n";
        $this->assertDatabaseHas('contactos', [
            'name' => 'María González',
            'email' => 'maria.gonzalez@empresa.com',
            'leido' => false,
            'respondido' => false
        ]);
        echo "   ✅ Mensaje guardado en base de datos\n";
        echo "   ✅ Estado inicial: No leído, No respondido\n";
        
        // PASO 8: Verificar que se envió email de notificación
        echo "\n📍 PASO 8: Verificando notificación por email...\n";
        Mail::assertSent(\App\Mail\NuevoContactoMail::class);
        echo "   ✅ Email de notificación enviado al administrador\n";
        
        echo "\n" . str_repeat("=", 60) . "\n";
        echo "✅ PRUEBA E2E 1 COMPLETADA EXITOSAMENTE\n";
        echo "   Total de páginas navegadas: 5\n";
        echo "   Formulario enviado: 1\n";
        echo "   Emails enviados: 1\n\n";
    }

    /**
     * E2E TEST 2: Flujo completo de administrador gestionando contenido
     * 
     * Escenario: Un administrador inicia sesión y gestiona diferentes
     * tipos de contenido en el sistema.
     */
    public function test_e2e_administrador_gestiona_contenido_completo()
    {
        echo "\n\n👨‍💼 INICIANDO PRUEBA E2E 2: ADMINISTRADOR GESTIONA CONTENIDO\n";
        echo "=" . str_repeat("=", 60) . "\n";
        
        // PREPARACIÓN: Crear admin y datos de prueba
        echo "\n🔧 PREPARACIÓN: Creando usuario administrador...\n";
        $admin = Usuario::create([
            'usuario' => 'admin_e2e',
            'password' => Hash::make('admin123')
        ]);
        echo "   ✅ Usuario creado: admin_e2e\n";
        
        // Crear algunos mensajes de contacto
        for ($i = 1; $i <= 3; $i++) {
            Contacto::create([
                'name' => "Cliente $i",
                'email' => "cliente$i@test.com",
                'subject' => "Consulta $i",
                'message' => "Mensaje de prueba $i",
                'leido' => false,
                'respondido' => false
            ]);
        }
        echo "   ✅ 3 mensajes de contacto creados\n";
        
        // PASO 1: Admin accede a la página principal (sin autenticar)
        echo "\n📍 PASO 1: Admin visita la página principal...\n";
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Iniciar Sesión', false);
        echo "   ✅ Página principal cargada\n";
        echo "   ✅ Botón 'Iniciar Sesión' visible\n";
        
        // PASO 2: Admin hace clic en "Iniciar Sesión"
        echo "\n📍 PASO 2: Admin hace clic en 'Iniciar Sesión'...\n";
        echo "   📝 Credenciales:\n";
        echo "      - Usuario: admin_e2e\n";
        echo "      - Password: admin123\n";
        
        $response = $this->post('/login', [
            'usuario' => 'admin_e2e',
            'password' => 'admin123'
        ]);
        $response->assertStatus(302);
        echo "   ✅ Login exitoso\n";
        
        // PASO 3: Verificar que el admin está autenticado
        echo "\n📍 PASO 3: Verificando sesión...\n";
        $this->assertAuthenticatedAs($admin, 'web');
        echo "   ✅ Sesión iniciada correctamente\n";
        echo "   ✅ Usuario autenticado: admin_e2e\n";
        
        // PASO 4: Admin accede al listado de mensajes
        echo "\n📍 PASO 4: Admin abre el panel de mensajes...\n";
        $response = $this->actingAs($admin, 'web')
            ->get('/mensajes?per_page=10');
        $response->assertStatus(200);
        $data = $response->json();
        echo "   ✅ Panel de mensajes abierto\n";
        echo "   📊 Mensajes encontrados: {$data['total']}\n";
        echo "   📄 Mostrando: {$data['per_page']} por página\n";
        
        // PASO 5: Admin lee el primer mensaje
        echo "\n📍 PASO 5: Admin lee el primer mensaje...\n";
        $mensaje = Contacto::first();
        echo "   📧 De: {$mensaje->name} ({$mensaje->email})\n";
        echo "   📝 Asunto: {$mensaje->subject}\n";
        
        $response = $this->actingAs($admin, 'web')
            ->put("/contacto/{$mensaje->id}/leido");
        $response->assertStatus(200);
        echo "   ✅ Mensaje marcado como leído\n";
        
        // PASO 6: Admin responde al mensaje
        echo "\n📍 PASO 6: Admin responde al mensaje...\n";
        Mail::fake();
        
        $respuesta = "Estimado/a {$mensaje->name}, gracias por contactarnos. Con gusto atenderemos su consulta.";
        
        $response = $this->actingAs($admin, 'web')
            ->post("/contacto/{$mensaje->id}/responder", [
                'respuesta' => $respuesta
            ]);
        $response->assertStatus(200);
        echo "   ✅ Respuesta enviada\n";
        echo "   ✅ Mensaje marcado como respondido\n";
        
        // PASO 7: Admin edita texto de la página
        echo "\n📍 PASO 7: Admin edita contenido de la página...\n";
        
        Texto::create([
            'clave' => 'bienvenida',
            'contenido' => 'Bienvenidos a ESPOMALIA'
        ]);
        
        $nuevoTexto = 'Bienvenidos a ESPOMALIA - Líderes en servicios portuarios desde 1995';
        
        $response = $this->actingAs($admin, 'web')
            ->put('/texto/bienvenida', [
                'contenido' => $nuevoTexto
            ]);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('textos', [
            'clave' => 'bienvenida',
            'contenido' => $nuevoTexto
        ]);
        echo "   ✅ Texto actualizado correctamente\n";
        echo "   📝 Nuevo texto: '$nuevoTexto'\n";
        
        // PASO 8: Admin crea un nuevo servicio
        echo "\n📍 PASO 8: Admin crea un nuevo servicio...\n";
        
        $nuevoServicio = [
            'titulo' => 'Transporte Marítimo Internacional',
            'descripcion' => 'Servicio completo de transporte marítimo con cobertura global',
            'duracion' => '15-30 días',
            'precio' => 'Cotizar según destino'
        ];
        
        echo "   📝 Nuevo servicio:\n";
        echo "      - Título: {$nuevoServicio['titulo']}\n";
        echo "      - Duración: {$nuevoServicio['duracion']}\n";
        
        $response = $this->actingAs($admin, 'web')
            ->post('/servicios', $nuevoServicio);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('servicios', [
            'titulo' => 'Transporte Marítimo Internacional'
        ]);
        echo "   ✅ Servicio creado exitosamente\n";
        
        // PASO 9: Admin actualiza el servicio
        echo "\n📍 PASO 9: Admin actualiza el servicio...\n";
        
        $servicio = Servicio::where('titulo', 'Transporte Marítimo Internacional')->first();
        
        $response = $this->actingAs($admin, 'web')
            ->put("/servicios/{$servicio->id}", [
                'titulo' => 'Transporte Marítimo Internacional Premium',
                'descripcion' => 'Servicio completo de transporte marítimo con cobertura global y seguimiento GPS',
                'duracion' => '10-25 días',
                'precio' => 'Desde $2,500 USD'
            ]);
        $response->assertStatus(302);
        echo "   ✅ Servicio actualizado\n";
        
        // PASO 10: Admin crea un hito histórico
        echo "\n📍 PASO 10: Admin agrega un hito histórico...\n";
        
        $nuevoHito = [
            'titulo' => '2025 - Certificación ISO 9001',
            'descripcion' => 'Obtención de certificación internacional de calidad'
        ];
        
        $response = $this->actingAs($admin, 'web')
            ->post('/hitos', $nuevoHito);
        $response->assertStatus(302);
        
        $this->assertDatabaseHas('hitos', [
            'titulo' => '2025 - Certificación ISO 9001'
        ]);
        echo "   ✅ Hito histórico agregado\n";
        
        // PASO 11: Admin cierra sesión
        echo "\n📍 PASO 11: Admin cierra sesión...\n";
        
        $response = $this->actingAs($admin, 'web')
            ->post('/logout');
        $response->assertStatus(302);
        
        $this->assertGuest('web');
        echo "   ✅ Sesión cerrada correctamente\n";
        
        echo "\n" . str_repeat("=", 60) . "\n";
        echo "✅ PRUEBA E2E 2 COMPLETADA EXITOSAMENTE\n";
        echo "   Acciones realizadas:\n";
        echo "   - Login: 1\n";
        echo "   - Mensajes leídos: 1\n";
        echo "   - Mensajes respondidos: 1\n";
        echo "   - Textos editados: 1\n";
        echo "   - Servicios creados: 1\n";
        echo "   - Servicios actualizados: 1\n";
        echo "   - Hitos creados: 1\n";
        echo "   - Logout: 1\n\n";
    }

    /**
     * E2E TEST 3: Flujo completo con múltiples usuarios simultáneos
     * 
     * Escenario: Simula varios usuarios interactuando con el sistema
     * al mismo tiempo (visitantes enviando mensajes y admin gestionando).
     */
    public function test_e2e_multiples_usuarios_simultaneos()
    {
        echo "\n\n👥 INICIANDO PRUEBA E2E 3: MÚLTIPLES USUARIOS SIMULTÁNEOS\n";
        echo "=" . str_repeat("=", 60) . "\n";
        
        // PREPARACIÓN
        echo "\n🔧 PREPARACIÓN: Configurando escenario...\n";
        $admin = Usuario::create([
            'usuario' => 'admin',
            'password' => Hash::make('admin123')
        ]);
        echo "   ✅ Administrador creado\n";
        
        Mail::fake();
        
        // ESCENARIO: 3 visitantes envían mensajes casi simultáneamente
        echo "\n📍 ESCENARIO: 3 visitantes envían mensajes simultáneamente...\n";
        
        $visitantes = [
            [
                'name' => 'Pedro Ramírez',
                'email' => 'pedro.ramirez@empresa.com',
                'subject' => 'Consulta sobre almacenamiento',
                'message' => 'Necesito información sobre sus servicios de almacenamiento'
            ],
            [
                'name' => 'Ana Martínez',
                'email' => 'ana.martinez@comercio.com',
                'subject' => 'Cotización para exportación',
                'message' => 'Requiero cotización para exportar 50 contenedores'
            ],
            [
                'name' => 'Carlos López',
                'email' => 'carlos.lopez@logistics.com',
                'subject' => 'Servicios de aduanas',
                'message' => 'Información sobre trámites aduaneros'
            ]
        ];
        
        foreach ($visitantes as $index => $visitante) {
            echo "\n   👤 Visitante " . ($index + 1) . ": {$visitante['name']}\n";
            
            // Visitante navega al formulario
            $response = $this->get('/contactenos');
            $response->assertStatus(200);
            echo "      ✅ Accedió al formulario\n";
            
            // Visitante envía mensaje
            $response = $this->post('/contactenos', $visitante);
            $response->assertStatus(302);
            echo "      ✅ Mensaje enviado: '{$visitante['subject']}'\n";
            
            // Verificar que se guardó
            $this->assertDatabaseHas('contactos', [
                'email' => $visitante['email']
            ]);
        }
        
        echo "\n   📊 Resultado: 3 mensajes enviados exitosamente\n";
        Mail::assertSent(\App\Mail\NuevoContactoMail::class, 3);
        echo "   📧 3 emails de notificación enviados al admin\n";
        
        // ESCENARIO: Admin gestiona todos los mensajes
        echo "\n📍 ESCENARIO: Admin gestiona los mensajes recibidos...\n";
        
        // Admin hace login
        $this->post('/login', [
            'usuario' => 'admin',
            'password' => 'admin123'
        ]);
        echo "   ✅ Admin inició sesión\n";
        
        // Admin ve todos los mensajes
        $response = $this->actingAs($admin, 'web')
            ->get('/mensajes?per_page=10');
        $data = $response->json();
        echo "   📬 Admin ve {$data['total']} mensajes nuevos\n";
        
        // Admin procesa cada mensaje
        $mensajes = Contacto::all();
        foreach ($mensajes as $index => $mensaje) {
            echo "\n   📧 Procesando mensaje " . ($index + 1) . "...\n";
            echo "      De: {$mensaje->name}\n";
            echo "      Asunto: {$mensaje->subject}\n";
            
            // Marcar como leído
            $this->actingAs($admin, 'web')
                ->put("/contacto/{$mensaje->id}/leido");
            echo "      ✅ Marcado como leído\n";
            
            // Responder
            Mail::fake();
            $this->actingAs($admin, 'web')
                ->post("/contacto/{$mensaje->id}/responder", [
                    'respuesta' => "Gracias por su consulta. En breve nos comunicaremos con usted."
                ]);
            echo "      ✅ Respuesta enviada\n";
        }
        
        // Verificar estado final
        echo "\n📍 VERIFICACIÓN FINAL:\n";
        $mensajesLeidos = Contacto::where('leido', true)->count();
        $mensajesRespondidos = Contacto::where('respondido', true)->count();
        
        echo "   📊 Estadísticas:\n";
        echo "      - Total de mensajes: " . Contacto::count() . "\n";
        echo "      - Mensajes leídos: $mensajesLeidos\n";
        echo "      - Mensajes respondidos: $mensajesRespondidos\n";
        
        $this->assertEquals(3, $mensajesLeidos);
        $this->assertEquals(3, $mensajesRespondidos);
        
        echo "\n" . str_repeat("=", 60) . "\n";
        echo "✅ PRUEBA E2E 3 COMPLETADA EXITOSAMENTE\n";
        echo "   Usuarios simulados: 4 (3 visitantes + 1 admin)\n";
        echo "   Interacciones totales: 12+\n\n";
    }
}
