# 🚢 ESPOMALIA C.LTDA - Sistema de Gestión Portuaria

<p align="center">
  <img src="public/static/img/icons/logo_espomalia.png" alt="ESPOMALIA Logo" width="200"/>
</p>

<p align="center">
  <strong>Sistema integral de gestión de contenido y mensajería para empresa portuaria</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-9.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/PostgreSQL-13-316192?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
</p>

---

## 👩‍💻 Desarrolladora

**Yarleni Jara**  
📧 Email: jarayarleni8@gmail.com  
📅 Año: 2025  
🎓 Proyecto desarrollado con Laravel Framework

---

## 📋 Descripción del Proyecto

ESPOMALIA es una aplicación web completa desarrollada con Laravel 9 que proporciona una plataforma integral para la gestión de contenido dinámico, sistema de contacto con mensajería avanzada, y administración de servicios portuarios. 

El sistema permite a los administradores gestionar fácilmente el contenido del sitio web mediante una interfaz intuitiva, responder mensajes de clientes directamente por email, y mantener actualizada toda la información de la empresa.

### ✨ Características Principales

- 🔐 **Sistema de Autenticación** - Login/Logout seguro con middleware de protección
- 📝 **Edición de Contenido en Vivo** - Textos editables directamente desde el frontend
- 📧 **Sistema de Mensajería Avanzado** - Gestión completa de mensajes con paginación y respuesta por email
- 🎨 **Carrusel Dinámico** - Imágenes y textos del carrusel configurables desde el panel
- 🛠️ **CRUD de Servicios** - Gestión completa de servicios portuarios
- 📊 **Gestión de Hitos** - Línea de tiempo de logros de la empresa
- 🖼️ **Galería de Imágenes** - Administración de galería fotográfica
- 📱 **Diseño Responsive** - Compatible con dispositivos móviles y tablets
- ✅ **Pruebas Unitarias** - 7 pruebas automatizadas con 100% de éxito

---

## 🏗️ Estructura del Proyecto

```
proyecto/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CarruselImagenController.php    # Gestión de imágenes del carrusel
│   │   │   ├── ContactoController.php          # Sistema de mensajería
│   │   │   ├── TextoController.php             # Textos editables
│   │   │   ├── ServicioController.php          # CRUD de servicios
│   │   │   ├── HitoController.php              # Gestión de hitos
│   │   │   ├── NosotrosController.php          # Página "Sobre Nosotros"
│   │   │   ├── OrganigramaController.php       # Organigrama de la empresa
│   │   │   └── UsuarioController.php           # Autenticación
│   │   └── Middleware/
│   │       └── Authenticate.php                # Protección de rutas
│   └── Models/
│       ├── Usuario.php                         # Modelo de usuarios
│       ├── Contacto.php                        # Mensajes de contacto
│       ├── Texto.php                           # Textos editables
│       ├── CarruselImagen.php                  # Imágenes del carrusel
│       ├── Servicio.php                        # Servicios portuarios
│       ├── Hito.php                            # Hitos históricos
│       └── GaleriaImagen.php                   # Galería de imágenes
│
├── database/
│   └── migrations/                             # 19 migraciones de base de datos
│
├── resources/
│   ├── views/
│   │   ├── index.blade.php                     # Página principal
│   │   ├── contactenos.blade.php               # Formulario y gestión de mensajes
│   │   ├── sobre_nosotros.blade.php            # Información de la empresa
│   │   ├── nuestros_servicios.blade.php        # Catálogo de servicios
│   │   ├── organigrama.blade.php               # Estructura organizacional
│   │   └── emails/
│   │       ├── nuevo_contacto.blade.php        # Email de notificación
│   │       └── respuesta_contacto.blade.php    # Email de respuesta
│   ├── css/
│   │   └── styles.css                          # Estilos personalizados
│   └── js/
│       └── main.js                             # JavaScript personalizado
│
├── routes/
│   └── web.php                                 # Rutas de la aplicación
│
├── tests/
│   └── Feature/
│       ├── AutenticacionTest.php               # Pruebas de autenticación
│       ├── ContactoMensajeriaTest.php          # Pruebas de mensajería
│       └── GestionContenidoTest.php            # Pruebas de contenido
│
├── public/
│   ├── static/
│   │   └── img/                                # Imágenes estáticas
│   └── storage/                                # Enlace simbólico a storage
│
├── storage/
│   ├── app/
│   │   └── public/                             # Archivos subidos
│   └── logs/                                   # Logs de la aplicación
│
├── .env                                        # Variables de entorno
├── composer.json                               # Dependencias PHP
├── package.json                                # Dependencias Node.js
└── README.md                                   # Este archivo
```

---

## 🚀 Instalación del Proyecto

### Requisitos Previos

- **PHP** >= 8.0
- **Composer** >= 2.0
- **PostgreSQL** >= 12
- **Node.js** >= 14 (opcional, para assets)
- **Git**

### 1️⃣ Clonar el Repositorio

```bash
git clone <URL_DEL_REPOSITORIO>
cd proyecto
```

### 2️⃣ Instalar Dependencias de PHP

```bash
composer install
```

### 3️⃣ Configurar Variables de Entorno

Copia el archivo de ejemplo y configura tu entorno:

```bash
cp .env.example .env
```

Edita el archivo `.env` y configura:

```env
APP_NAME=ESPOMALIA
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Base de Datos PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=TU_CONTRASEÑA_AQUI

# Configuración de Email (Gmail)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=tu_contraseña_de_aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="tu_email@gmail.com"
MAIL_FROM_NAME="ESPOMALIA C.LTDA"
```

### 4️⃣ Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 5️⃣ Crear Base de Datos

Crea la base de datos en PostgreSQL:

```sql
CREATE DATABASE laravel;
```

### 6️⃣ Ejecutar Migraciones

```bash
php artisan migrate
```

Esto creará todas las tablas necesarias:
- usuarios
- contactos
- textos
- carrusel_imagenes
- servicios
- hitos
- galeria_imagens
- organigramas
- Y más...

### 7️⃣ Crear Enlace Simbólico para Storage

```bash
php artisan storage:link
```

### 8️⃣ Crear Usuario Administrador

Ejecuta Tinker:

```bash
php artisan tinker
```

Luego ejecuta:

```php
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

Usuario::create([
    'usuario' => 'admin',
    'password' => Hash::make('admin123')
]);
```

Sal de Tinker con `exit`.

### 9️⃣ (Opcional) Instalar Dependencias Frontend

```bash
npm install
npm run dev
```

### 🔟 Iniciar Servidor de Desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en: **http://127.0.0.1:8000**

---

## 🎯 Uso del Sistema

### 👤 Acceso de Usuario Público

Los usuarios pueden:
- Ver toda la información de la empresa
- Navegar por los servicios ofrecidos
- Consultar la historia y hitos
- Enviar mensajes a través del formulario de contacto

### 🔑 Acceso de Administrador

**Credenciales por defecto:**
- Usuario: `admin`
- Contraseña: `admin123`

Los administradores pueden:
- ✏️ Editar textos haciendo clic directamente en ellos
- 📧 Ver y gestionar mensajes de contacto
- 💬 Responder mensajes directamente por email
- 🖼️ Cambiar imágenes del carrusel
- ➕ Crear, editar y eliminar servicios
- 📈 Gestionar hitos de la empresa
- 🏢 Actualizar información del organigrama

### 📨 Sistema de Mensajería

1. **Cliente envía mensaje** → Se guarda en BD + Email al admin
2. **Admin revisa mensajes** → Click en "Ver Mensajes"
3. **Tabla con paginación** → 5, 10, 20, 50 registros por página
4. **Ordenamiento inteligente**:
   - 🟡 Mensajes nuevos (no leídos) primero
   - 🟢 Mensajes leídos pero no respondidos
   - 🔵 Mensajes respondidos al final
5. **Acciones disponibles**:
   - ✅ Marcar como leído
   - 💬 Responder (envía email automático)
   - 🗑️ Eliminar

---

## 🧪 Pruebas Unitarias

El proyecto incluye 3 suites de pruebas completas:

```bash
# Ejecutar todas las pruebas
php artisan test

# Solo pruebas de Feature
php artisan test --testsuite=Feature

# Pruebas específicas
php artisan test --filter=AutenticacionTest
php artisan test --filter=ContactoMensajeriaTest
php artisan test --filter=GestionContenidoTest
```

### Cobertura de Pruebas

✅ **AutenticacionTest** (3 pruebas)
- Sistema de login/logout
- Protección de rutas
- Permisos de edición

✅ **ContactoMensajeriaTest** (2 pruebas)
- Envío de mensajes
- Paginación y ordenamiento
- Respuesta por email
- CRUD completo

✅ **GestionContenidoTest** (2 pruebas)
- Edición de textos
- Gestión de servicios
- Gestión de hitos
- Validaciones de seguridad

**Resultado: 7/7 pruebas pasadas (100%)**

---

## 🔧 Configuración de Email

### Para Gmail:

1. Activa la **verificación en 2 pasos** en tu cuenta de Google
2. Ve a: https://myaccount.google.com/apppasswords
3. Crea una **contraseña de aplicación** para "Correo"
4. Copia la contraseña de 16 caracteres
5. Pégala en `MAIL_PASSWORD` del archivo `.env`
6. Ejecuta: `php artisan config:clear`

### Para otros servicios:

- **SendGrid**: Hasta 100 emails/día gratis
- **Mailgun**: 5,000 emails/mes gratis (primeros 3 meses)
- **Amazon SES**: 62,000 emails/mes gratis

---

## 📂 Base de Datos

### Tablas Principales

| Tabla | Descripción | Campos Importantes |
|-------|-------------|-------------------|
| `usuarios` | Usuarios admin | usuario, password |
| `contactos` | Mensajes de contacto | name, email, subject, message, leido, respondido |
| `textos` | Textos editables | clave, contenido |
| `carrusel_imagenes` | Imágenes del carrusel | clave, ruta |
| `servicios` | Servicios portuarios | titulo, descripcion, duracion, precio, imagen |
| `hitos` | Hitos históricos | titulo, descripcion, imagen |
| `galeria_imagens` | Galería de fotos | ruta |
| `organigramas` | Estructura organizacional | cargo, titulo, descripcion, imagen |

---

## 🛣️ Rutas Principales

### Rutas Públicas

```
GET  /                      # Página de inicio
GET  /contactenos           # Formulario de contacto
POST /contactenos           # Enviar mensaje
GET  /nuestros-servicios    # Catálogo de servicios
GET  /sobre-nosotros        # Información de la empresa
GET  /organigrama           # Organigrama
```

### Rutas Protegidas (Requieren Autenticación)

```
GET    /mensajes                    # Listar mensajes (paginado)
PUT    /contacto/{id}/leido         # Marcar como leído
POST   /contacto/{id}/responder     # Responder mensaje
DELETE /contacto/{id}               # Eliminar mensaje

PUT    /texto/{clave}               # Actualizar texto editable

POST   /carrusel-imagen/{clave}     # Actualizar imagen carrusel

POST   /servicios                   # Crear servicio
PUT    /servicios/{id}              # Actualizar servicio
DELETE /servicios/{id}              # Eliminar servicio

POST   /hitos                       # Crear hito
PUT    /hitos/{id}                  # Actualizar hito
DELETE /hitos/{id}                  # Eliminar hito
```

---

## 🎨 Tecnologías Utilizadas

### Backend
- **Laravel 9.19** - Framework PHP
- **PHP 8.2** - Lenguaje de programación
- **PostgreSQL 13** - Base de datos relacional
- **Composer** - Gestor de dependencias PHP

### Frontend
- **Bootstrap 5.3** - Framework CSS
- **JavaScript Vanilla** - Interactividad
- **jQuery 3.6** - Manipulación del DOM
- **Font Awesome 6.0** - Iconos
- **Blade Templates** - Motor de plantillas

### Herramientas de Desarrollo
- **PHPUnit** - Testing
- **Git** - Control de versiones
- **Artisan** - CLI de Laravel

---

## 📝 Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ver rutas
php artisan route:list

# Ver estado de migraciones
php artisan migrate:status

# Crear nuevo controlador
php artisan make:controller NombreController

# Crear nuevo modelo con migración
php artisan make:model NombreModelo -m

# Abrir consola interactiva
php artisan tinker

# Ejecutar pruebas
php artisan test

# Ver logs en tiempo real (Windows PowerShell)
Get-Content storage/logs/laravel.log -Wait -Tail 50
```

---

## 🐛 Solución de Problemas Comunes

### Error: "Base table or view not found"
```bash
php artisan migrate:fresh
```

### Error: "The stream or file storage/logs/laravel.log could not be opened"
```bash
# Windows
mkdir storage\logs
echo. > storage\logs\laravel.log
```

### Imágenes no se muestran
```bash
php artisan storage:link
```

### Cambios en .env no se aplican
```bash
php artisan config:clear
php artisan cache:clear
```

### Error de permisos en storage (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

---

## 📄 Licencia

Este proyecto es privado y fue desarrollado como proyecto académico.

---

## 📞 Contacto

**Yarleni Jara**  
📧 Email: jarayarleni8@gmail.com  
💼 GitHub: [Tu perfil de GitHub]  

---

## 🙏 Agradecimientos

- **Laravel Community** - Por el excelente framework
- **Bootstrap Team** - Por el framework CSS
- **ESPOMALIA C.LTDA** - Por la inspiración del proyecto

---

<p align="center">
  Desarrollado con ❤️ por <strong>Yarleni Jara</strong> - 2025
</p>
