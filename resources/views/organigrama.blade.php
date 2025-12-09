<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organigrama - Portuaria</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
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
                <button class="btn btn-warning btn-sm ms-3">Entrar a la app</button>
            </nav>
            @if(Auth::check())
                <button class="btn btn-danger d-none d-md-block" data-bs-toggle="modal" data-bs-target="#logoutModal">Salir</button>
            @else
                <button class="btn btn-primary d-none d-md-block" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
            @endif
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
                <button class="btn btn-warning btn-sm mt-3">Entrar a la app</button>
                @if(Auth::check())
                    <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#logoutModal">Salir</button>
                @else
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
                @endif
            </nav>
        </div>
    </header>

    <section class="organigram container text-center mt-5">
        <h2>Organigrama de la Empresa</h2>
        <div class="role-container">
            @php
                $cargos = ['presidente', 'vicepresidente', 'contador', 'empleados'];
            @endphp
            
            @foreach($cargos as $cargo)
                @php
                    $organigrama = $organigramas->get($cargo);
                    $titulo = $organigrama ? $organigrama->titulo : ucfirst($cargo);
                @endphp
                <div class="role-box" data-bs-toggle="modal" data-bs-target="#{{ $cargo }}Modal">
                    <div class="role-title">{{ $titulo }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Modales de cargos -->
    @foreach (['presidente', 'vicepresidente', 'contador', 'empleados'] as $cargo)
        @php
            $organigrama = $organigramas[$cargo] ?? null;
        @endphp
        <div class="modal fade" id="{{ $cargo }}Modal" tabindex="-1" aria-labelledby="{{ $cargo }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{ $cargo }}ModalLabel">
                            {{ $organigrama ? $organigrama->titulo : ucfirst($cargo) }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        @if($organigrama && $organigrama->imagen)
                            <img src="{{ asset('storage/' . $organigrama->imagen) }}" alt="{{ $organigrama->titulo }}" class="img-fluid mb-3" style="max-height: 200px;">
                        @else
                            @php
                                $defaultImages = [
                                    'presidente' => 'presidente.jpg',
                                    'vicepresidente' => 'vicepresidente.jpg', 
                                    'contador' => 'contador.jpg',
                                    'empleados' => 'empleados.webp'
                                ];
                            @endphp
                            <img src="{{ asset('static/img/' . $defaultImages[$cargo]) }}" alt="{{ ucfirst($cargo) }}" class="img-fluid mb-3" style="max-height: 200px;">
                        @endif
                        
                        <p>{{ $organigrama ? $organigrama->descripcion : 'Descripción por defecto para ' . $cargo }}</p>
                        
                        @if(Auth::check() && $organigrama)
                            <hr>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarOrganigramaModal{{ $organigrama->id }}">
                                Editar
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Organigrama -->
        @if(Auth::check() && $organigrama)
            <div class="modal fade" id="editarOrganigramaModal{{ $organigrama->id }}" tabindex="-1" aria-labelledby="editarOrganigramaModalLabel{{ $organigrama->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="{{ route('organigrama.update', $organigrama->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarOrganigramaModalLabel{{ $organigrama->id }}">Editar {{ $organigrama->titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Título del Cargo</label>
                                <input type="text" class="form-control" name="titulo" value="{{ $organigrama->titulo }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="descripcion" rows="4" required>{{ $organigrama->descripcion }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Imagen (opcional)</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                                @if($organigrama->imagen)
                                    <small class="text-muted">Imagen actual: {{ basename($organigrama->imagen) }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Modal de Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Cerrar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro que deseas cerrar sesión?</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
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
