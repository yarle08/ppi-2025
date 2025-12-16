<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portuaria - Nuestros Servicios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
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

            <!-- Botón de Login/Logout -->
            @if(Auth::check())
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">Salir</button>
            @else
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
            @endif
        </div>
    </header>

    <!-- Modal de Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <main class="py-5">
        <div class="container">
            <h1 class="text-center mb-5 text-white">Nuestros Servicios</h1>
            @if(Auth::check())
                <!-- Botón para agregar nuevo servicio -->
                <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalAgregarServicio">Agregar Servicio</button>
            @endif
            <div class="row">
                @foreach($servicios as $servicio)
                    <div class="col-md-4 mb-4">
                        <div class="card service-card">
                            <img src="{{ $servicio->imagen ? (str_starts_with($servicio->imagen, 'http') ? $servicio->imagen : asset('storage/' . $servicio->imagen)) : asset('static/img/servicio1.jpg') }}" class="card-img-top" alt="{{ $servicio->titulo }}">
                            <div class="card-body">
                                <h5 class="card-title service-title">{{ $servicio->titulo }}</h5>
                                <p class="card-text">{{ $servicio->descripcion }}</p>
                                <p class="mb-1"><strong>Duración:</strong> {{ $servicio->duracion }}</p>
                                <p class="mb-1"><strong>Precio:</strong> {{ $servicio->precio }}</p>
                                <button class="btn btn-primary service-button" data-bs-toggle="modal" data-bs-target="#serviceModal{{ $servicio->id }}">Ver Detalles</button>
                                @if(Auth::check())
                                    <!-- Botón editar -->
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditarServicio{{ $servicio->id }}">Editar</button>
                                    <!-- Botón eliminar -->
                                    <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar este servicio?')">Eliminar</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detalles -->
                    <div class="modal fade" id="serviceModal{{ $servicio->id }}" tabindex="-1" aria-labelledby="serviceModalLabel{{ $servicio->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="serviceModalLabel{{ $servicio->id }}">{{ $servicio->titulo }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $servicio->descripcion }}</p>
                                    @if($servicio->duracion)
                                        <p><strong>Duración:</strong> {{ $servicio->duracion }}</p>
                                    @endif
                                    @if($servicio->precio)
                                        <p><strong>Precio:</strong> {{ $servicio->precio }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar -->
                    @if(Auth::check())
                    <div class="modal fade" id="modalEditarServicio{{ $servicio->id }}" tabindex="-1" aria-labelledby="modalEditarServicioLabel{{ $servicio->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="modal-content" method="POST" action="{{ route('servicios.update', $servicio) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditarServicioLabel{{ $servicio->id }}">Editar Servicio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Título</label>
                                        <input type="text" name="titulo" class="form-control" value="{{ $servicio->titulo }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Descripción</label>
                                        <textarea name="descripcion" class="form-control" required>{{ $servicio->descripcion }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Duración</label>
                                        <input type="text" name="duracion" class="form-control" value="{{ $servicio->duracion }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Precio</label>
                                        <input type="text" name="precio" class="form-control" value="{{ $servicio->precio }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Imagen</label>
                                        <input type="file" name="imagen" class="form-control">
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
            </div>
        </div>

        <!-- Modal Agregar Servicio -->
        @if(Auth::check())
        <div class="modal fade" id="modalAgregarServicio" tabindex="-1" aria-labelledby="modalAgregarServicioLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('servicios.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarServicioLabel">Agregar Servicio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Título</label>
                            <input type="text" name="titulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Duración</label>
                            <input type="text" name="duracion" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Precio</label>
                            <input type="text" name="precio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Imagen</label>
                            <input type="file" name="imagen" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </main>

    <footer class="text-center py-3">
        <div>&copy; 2024 PORTUARIA - Todos los derechos reservados</div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
