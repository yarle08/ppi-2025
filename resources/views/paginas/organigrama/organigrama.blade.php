<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organigrama - Portuaria</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/organigrama.css') }}" rel="stylesheet">
</head>
<body>
    <header class="py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <img src="{{ asset('static/img/icons/logo_espomalia.png') }}" alt="Logo Portuaria" class="img-fluid">
            </div>
            <nav class="d-none d-md-flex">
                <a href="{{ url('/') }}" class="text-white text-decoration-none mx-3">Inicio</a>
                <a href="{{ url('/nuestros-servicios') }}" class="text-white text-decoration-none mx-3">Nuestros Servicios</a>
                <a href="{{ url('/sobre-nosotros') }}" class="text-white text-decoration-none mx-3">Sobre Nosotros</a>
                <a href="{{ url('/organigrama') }}" class="text-white text-decoration-none mx-3">Organigrama</a>
                <a href="{{ url('/contactenos') }}" class="text-white text-decoration-none mx-3">Contáctanos</a>
            </nav>
            <button class="btn btn-primary d-none d-md-block" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse d-md-none" id="mobileMenu">
            <nav class="navbar-nav text-center">
                <a href="{{ url('/') }}" class="nav-link">Inicio</a>
                <a href="{{ url('/nuestros-servicios') }}" class="nav-link">Nuestros Servicios</a>
                <a href="{{ url('/sobre-nosotros') }}" class="nav-link">Sobre Nosotros</a>
                <a href="{{ url('/organigrama') }}" class="nav-link">Organigrama</a>
                <a href="{{ url('/contactenos') }}" class="nav-link">Contáctanos</a>
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </nav>
        </div>
    </header>

    <section class="organigram container text-center mt-5">
        <h2>Organigrama de la Empresa</h2>
        <div class="role-container d-flex justify-content-center flex-wrap gap-3 mt-4">
            <div class="role-box" data-bs-toggle="modal" data-bs-target="#presidenteModal">
                <div class="role-title">Presidente</div>
            </div>
            <div class="role-box" data-bs-toggle="modal" data-bs-target="#vicepresidenteModal">
                <div class="role-title">Vicepresidente</div>
            </div>
            <div class="role-box" data-bs-toggle="modal" data-bs-target="#contadorModal">
                <div class="role-title">Contador</div>
            </div>
            <div class="role-box" data-bs-toggle="modal" data-bs-target="#empleadosModal">
                <div class="role-title">Empleados</div>
            </div>
        </div>
    </section>

    <!-- Modales de cargos -->
    @php
        $modals = [
            'presidente' => ['img' => 'presidente.jpg', 'desc' => 'El presidente lidera la estrategia general de la empresa y supervisa todas las operaciones clave.'],
            'vicepresidente' => ['img' => 'vicepresidente.jpg', 'desc' => 'El vicepresidente apoya al presidente y se encarga de áreas clave como desarrollo y operaciones.'],
            'contador' => ['img' => 'contador.jpg', 'desc' => 'El contador gestiona las finanzas de la empresa, asegurando la transparencia y la eficiencia.'],
            'empleados' => ['img' => 'empleados.webp', 'desc' => 'Los empleados son el motor de la empresa, trabajando en diversas áreas para alcanzar los objetivos.']
        ];
    @endphp

    @foreach ($modals as $id => $info)
    <div class="modal fade" id="{{ $id }}Modal" tabindex="-1" aria-labelledby="{{ $id }}ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $id }}ModalLabel">{{ ucfirst($id) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('static/img/' . $info['img']) }}" alt="{{ ucfirst($id) }}" class="img-fluid mb-3" style="max-height: 200px;">
                    <p>{{ $info['desc'] }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" onsubmit="return handleLogin(event)">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <a href="{{ asset('adminpaginas/inicioadmin/indexadmin.html') }}" class="btn btn-primary">Iniciar Sesión</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-3 mt-5 bg-dark">
        <div class="container text-center">
            &copy; 2024 PORTUARIA - Todos los derechos reservados
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
