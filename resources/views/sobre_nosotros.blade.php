<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - ESPOMALIA C.LTDA</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/sobrre-nosotros.css') }}" rel="stylesheet">
</head>

<body>
    <header class="py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <img src="{{ asset('static/img/icons/logo_espomalia.png') }}" alt="Logo Portuaria" class="img-fluid">
            </div>
            <nav class="d-none d-md-flex">
                <a href="{{ url('/') }}" class="text-white text-decoration-none mx-3">Inicio</a>
                <a href="{{ url('/nuestros-servicios') }}" class="text-white text-decoration-none mx-3">Nuestros
                    Servicios</a>
                <a href="{{ url('/sobre-nosotros') }}" class="text-white text-decoration-none mx-3">Sobre Nosotros</a>
                <a href="{{ url('/organigrama') }}" class="text-white text-decoration-none mx-3">Organigrama</a>
                <a href="{{ url('/contactenos') }}" class="text-white text-decoration-none mx-3">Contáctanos</a>
                <button class="btn btn-warning btn-sm ms-3">Entrar a la app</button>
            </nav>
            @if (Auth::check())
                <button class="btn btn-danger d-none d-md-block" data-bs-toggle="modal"
                    data-bs-target="#logoutModal">Salir</button>
            @else
                <button class="btn btn-primary d-none d-md-block" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Iniciar Sesión</button>
            @endif
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#mobileMenu">
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
                @if (Auth::check())
                    <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                        data-bs-target="#logoutModal">Salir</button>
                @else
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar
                        Sesión</button>
                @endif
            </nav>
        </div>
    </header>

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

    <!-- Historia -->
    <section class="history-section py-5">
        <div class="container">
            <h1 class="section-title text-center mb-5"
                @if (Auth::check()) contenteditable="true"
                    style="border:1px dashed #ffc107; outline:none;"
                    id="historia_titulo" @endif>
                {{ $historia_titulo ?? 'Nuestra Historia' }}</h1>
            <p class="lead"
                @if (Auth::check()) contenteditable="true"
                    style="border:1px dashed #ffc107; outline:none;"
                    id="historia_parrafo_1" @endif>
                {{ $historia_parrafo_1 ?? 'ESPOMALIA C.LTDA nació con el propósito de optimizar la gestión portuaria y brindar soluciones logísticas innovadoras. Fundada en 2000, comenzamos como una pequeña empresa familiar enfocada en servicios aduaneros. Con el tiempo, hemos crecido hasta convertirnos en líderes en el sector portuario.' }}
            </p>
            <p class="lead"
                @if (Auth::check()) contenteditable="true"
                    style="border:1px dashed #ffc107; outline:none;"
                    id="historia_parrafo_2" @endif>
                {{ $historia_parrafo_2 ?? 'Nuestra evolución ha estado marcada por el compromiso constante con la calidad, la innovación y la sostenibilidad. A lo largo de los años, hemos implementado mejoras significativas en nuestros procesos y servicios para satisfacer las necesidades cambiantes de nuestros clientes.' }}
            </p>
            @if(Auth::check())
            <div class="text-center mt-3">
                <button class="btn btn-warning" onclick="guardarTextoHistoria()">Guardar Cambios</button>
            </div>
            @endif
        </div>
    </section>

    <!-- Hitos -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Hitos Importantes</h2>
            @if (Auth::check())
                <div class="text-end mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearHitoModal">Crear
                        Hito</button>
                </div>
            @endif
            <div class="row">
                @foreach ($hitos as $hito)
                    <div class="col-md-4 mb-4" id="hito-{{ $hito->id }}">
                        <div class="milestone text-center border p-3">
                            @if ($hito->imagen)
                                <img src="{{ asset('storage/' . $hito->imagen) }}" alt="{{ $hito->titulo }}"
                                    class="milestone-img mb-3">
                            @endif
                            <h5>{{ $hito->titulo }}</h5>
                            <p>{{ $hito->descripcion }}</p>
                            @if (Auth::check())
                                <!-- Botón Editar -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editarHitoModal{{ $hito->id }}">Editar</button>
                                <!-- Botón Eliminar -->
                                <form action="{{ route('hitos.destroy', $hito->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este hito?')">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Modal Editar Hito -->
                    <div class="modal fade" id="editarHitoModal{{ $hito->id }}" tabindex="-1"
                        aria-labelledby="editarHitoModalLabel{{ $hito->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="modal-content" id="formEditarHito{{ $hito->id }}"
                                enctype="multipart/form-data" method="POST" action="{{ route('hitos.update', $hito->id) }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarHitoModalLabel{{ $hito->id }}">Editar Hito
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="mb-3">
                                        <label class="form-label">Año y Título</label>
                                        <input type="text" class="form-control" name="titulo"
                                            value="{{ $hito->titulo }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Descripción</label>
                                        <textarea class="form-control" name="descripcion" required>{{ $hito->descripcion }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Imagen (opcional)</label>
                                        <input type="file" class="form-control" name="imagen" accept="image/*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal Crear Hito -->
    <div class="modal fade" id="crearHitoModal" tabindex="-1" aria-labelledby="crearHitoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="formCrearHito" method="POST" action="{{ route('hitos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearHitoModalLabel">Crear Nuevo Hito</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Año y Título</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagen (opcional)</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Crear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Galería -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="section-title mb-5">Galería de Imágenes</h2>
            @if (Auth::check())
                <div class="text-end mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#crearGaleriaModal">Agregar Imagen</button>
                </div>
            @endif
            <div class="row" id="galeria-lista">
                @foreach ($galeria as $img)
                    <div class="col-md-4 mb-4" id="galeria-{{ $img->id }}">
                        <div class="img-wrapper position-relative">
                            <img src="{{ asset('storage/' . $img->imagen) }}" alt="Imagen Galería"
                                class="img-fluid rounded">

                            @if (Auth::check())
                                <div class="position-absolute top-0 end-0 m-2">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editarGaleriaModal{{ $img->id }}">Editar</button>
                                    <form action="{{ route('galeria.destroy', $img->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar esta imagen?')">Eliminar</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Modal Editar Imagen Galería -->
                    <div class="modal fade" id="editarGaleriaModal{{ $img->id }}" tabindex="-1"
                        aria-labelledby="editarGaleriaModalLabel{{ $img->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="modal-content" id="formEditarGaleria{{ $img->id }}"
                                enctype="multipart/form-data" method="POST" action="{{ route('galeria.update', $img->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarGaleriaModalLabel{{ $img->id }}">Editar Imagen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Imagen</label>
                                        <input type="file" class="form-control" name="imagen" accept="image/*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal Crear Imagen Galería -->
    <div class="modal fade" id="crearGaleriaModal" tabindex="-1" aria-labelledby="crearGaleriaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="formCrearGaleria" method="POST" action="{{ url('/galeria') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearGaleriaModalLabel">Agregar Imagen a Galería</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Imagen</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="text-white py-3 bg-dark">
        <div class="container text-center">
            &copy; 2024 ESPOMALIA C.LTDA - Todos los derechos reservados
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    @if (Auth::check())
        <script>
            function guardarTextoHistoria() {
                const titulo = document.getElementById('historia_titulo')?.innerText.trim();
                const parrafo1 = document.getElementById('historia_parrafo_1')?.innerText.trim();
                const parrafo2 = document.getElementById('historia_parrafo_2')?.innerText.trim();

                Promise.all([
                    fetch("{{ url('/texto') }}/historia_titulo", {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            clave: 'historia_titulo',
                            contenido: titulo
                        })
                    }),
                    fetch("{{ url('/texto') }}/historia_parrafo_1", {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            clave: 'historia_parrafo_1',
                            contenido: parrafo1
                        })
                    }),
                    fetch("{{ url('/texto') }}/historia_parrafo_2", {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            clave: 'historia_parrafo_2',
                            contenido: parrafo2
                        })
                    })
                ]).then(() => {
                    ['historia_titulo', 'historia_parrafo_1', 'historia_parrafo_2'].forEach(id => {
                        const el = document.getElementById(id);
                        if (el) {
                            el.style.backgroundColor = "#d4edda";
                            setTimeout(() => el.style.backgroundColor = "", 800);
                        }
                    });
                }).catch(() => {
                    alert('Error al guardar los cambios');
                });
            }
        </script>
    @endif
</body>

</html>
