<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portuaria - Gestión y Servicios</title>

    <!-- Fuentes y Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- hoja de estilos personalizada -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<header class="py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="{{ asset('static/img/icons/logo_espomalia.png') }}" alt="Logo Portuaria" class="img-fluid">
        </div>

        <!-- Menú grande -->
        <nav class="d-none d-md-flex">
            <a href="{{ route('inicio') }}" class="text-white text-decoration-none mx-3">Inicio</a>
            <a href="{{ route('servicios') }}" class="text-white text-decoration-none mx-3">Nuestros Servicios</a>
            <a href="{{ route('nosotros') }}" class="text-white text-decoration-none mx-3">Sobre Nosotros</a>
            <a href="{{ route('organigrama') }}" class="text-white text-decoration-none mx-3">Organigrama</a>
            <a href="{{ route('contacto') }}" class="text-white text-decoration-none mx-3">Contáctanos</a>
            <button class="btn btn-warning btn-sm ms-3">Entrar a la app</button>
        </nav>

        <!-- Botón de Login/Logout -->
        @if(Auth::check())
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">Salir</button>
        @else
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
        @endif

        <!-- Menú móvil -->
        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <!-- Menú móvil desplegable -->
    <div class="collapse navbar-collapse d-md-none" id="mobileMenu">
        <nav class="navbar-nav text-center">
            <a href="{{ route('inicio') }}" class="nav-link">Inicio</a>
            <a href="{{ route('servicios') }}" class="nav-link">Nuestros Servicios</a>
            <a href="{{ route('nosotros') }}" class="nav-link">Sobre Nosotros</a>
            <a href="{{ route('organigrama') }}" class="nav-link">Organigrama</a>
            <a href="{{ route('contacto') }}" class="nav-link">Contáctanos</a>
            <button class="btn btn-warning btn-sm mt-3">Entrar a la app</button>
            @if(Auth::check())
                <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#logoutModal">Salir</button>
            @else
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            @endif
        </nav>
    </div>
</header>

<!-- Carrusel -->
<section class="hero">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ isset($imagenes['carrusel_img_1']) ? asset('storage/' . $imagenes['carrusel_img_1']) : asset('static/img/fondo1-scroll.jpg') }}" class="d-block w-100" alt="Imagen 1">
                @if(Auth::check())
                    <form method="POST" action="{{ route('carrusel-imagen.update', 'carrusel_img_1') }}" enctype="multipart/form-data" class="mt-2 text-center form-carrusel-img" data-clave="carrusel_img_1">
                        @csrf
                        <input type="file" name="imagen" accept="image/*" style="display:inline-block;">
                    </form>
                @endif
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3">
                    <h1
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="carrusel_titulo_1"
                        @endif
                    >{{ $carrusel_titulo_1 ?? 'Optimización Portuaria' }}</h1>
                    <h2
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="carrusel_texto_1"
                        @endif
                    >{{ $carrusel_texto_1 ?? 'Mejorando los procesos logísticos para un futuro más eficiente.' }}</h2>
                    @if(Auth::check())
                    <button class="btn btn-warning btn-sm mt-2" onclick="guardarTextos('carrusel_titulo_1', 'carrusel_texto_1')">Guardar Cambios</button>
                    @endif
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ isset($imagenes['carrusel_img_2']) ? asset('storage/' . $imagenes['carrusel_img_2']) : asset('static/img/fondo2-scroll.webp') }}" class="d-block w-100" alt="Imagen 2">
                @if(Auth::check())
                    <form method="POST" action="{{ route('carrusel-imagen.update', 'carrusel_img_2') }}" enctype="multipart/form-data" class="mt-2 text-center form-carrusel-img" data-clave="carrusel_img_2">
                        @csrf
                        <input type="file" name="imagen" accept="image/*" style="display:inline-block;">
                    </form>
                @endif
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3">
                    <h1
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="carrusel_titulo_2"
                        @endif
                    >{{ $carrusel_titulo_2 ?? 'Logística Global' }}</h1>
                    <h2
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="carrusel_texto_2"
                        @endif
                    >{{ $carrusel_texto_2 ?? 'Conectando puertos, mercados y oportunidades a nivel mundial.' }}</h2>
                    @if(Auth::check())
                    <button class="btn btn-warning btn-sm mt-2" onclick="guardarTextos('carrusel_titulo_2', 'carrusel_texto_2')">Guardar Cambios</button>
                    @endif
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ isset($imagenes['carrusel_img_3']) ? asset('storage/' . $imagenes['carrusel_img_3']) : asset('static/img/fondos3-scroll.jpg') }}" class="d-block w-100" alt="Imagen 3">
                @if(Auth::check())
                    <form method="POST" action="{{ route('carrusel-imagen.update', 'carrusel_img_3') }}" enctype="multipart/form-data" class="mt-2 text-center form-carrusel-img" data-clave="carrusel_img_3">
                        @csrf
                        <input type="file" name="imagen" accept="image/*" style="display:inline-block;">
                    </form>
                @endif
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3">
                    <h1
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="carrusel_titulo_3"
                        @endif
                    >{{ $carrusel_titulo_3 ?? 'Innovación Continua' }}</h1>
                    <h2
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="carrusel_texto_3"
                        @endif
                    >{{ $carrusel_texto_3 ?? 'Adaptándonos a los retos del comercio internacional.' }}</h2>
                    @if(Auth::check())
                    <button class="btn btn-warning btn-sm mt-2" onclick="guardarTextos('carrusel_titulo_3', 'carrusel_texto_3')">Guardar Cambios</button>
                    @endif
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="company-section py-5">
        <div class="container text-center">
            <h2 class="section-title mb-4"
                @if(Auth::check())
                    contenteditable="true"
                    style="border:1px dashed #ffc107; outline:none;"
                    id="empresa_titulo"
                @endif
            >{{ $empresa_titulo ?? 'Nuestra Empresa' }}</h2>
            <p class="lead"
                @if(Auth::check())
                    contenteditable="true"
                    style="border:1px dashed #ffc107; outline:none;"
                    id="empresa_parrafo_1"
                @endif
            >{{ $empresa_parrafo_1 ?? 'En ESPOMALIA C.LTDA, nos dedicamos a ofrecer soluciones logísticas de alta calidad, con un enfoque en la sostenibilidad y la eficiencia. A lo largo de los años, hemos establecido alianzas estratégicas que nos permiten conectar mercados y optimizar los procesos en el comercio internacional.' }}</p>
            <p class="lead"
                @if(Auth::check())
                    contenteditable="true"
                    style="border:1px dashed #ffc107; outline:none;"
                    id="empresa_parrafo_2"
                @endif
            >{{ $empresa_parrafo_2 ?? 'Nuestra misión es ser líderes en el sector portuario, brindando servicios confiables y a medida para nuestros clientes, mientras nos mantenemos comprometidos with la innovación y la protección del medio ambiente.' }}</p>
            @if(Auth::check())
            <button class="btn btn-warning mt-3" onclick="guardarTextoEmpresa()">Guardar Cambios</button>
            @endif
        </div>
    </section>

    <section class="team-section py-5">
        <div class="container text-center">
            <h2 class="mb-4">Nuestro Equipo</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card" data-bs-toggle="modal" data-bs-target="#missionModal">
                        <img src="{{ isset($imagenes['equipo_mision']) ? asset('storage/' . $imagenes['equipo_mision']) : asset('static/img/mision.png') }}" alt="Misión" class="card-img-top">
                        @if(Auth::check())
                            <form method="POST" action="{{ route('carrusel-imagen.update', 'equipo_mision') }}" enctype="multipart/form-data" class="mt-2 text-center form-carrusel-img" data-clave="equipo_mision">
                                @csrf
                                <input type="file" name="imagen" accept="image/*" style="display:inline-block;">
                            </form>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">Misión</h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card" data-bs-toggle="modal" data-bs-target="#visionModal">
                        <img src="{{ isset($imagenes['equipo_vision']) ? asset('storage/' . $imagenes['equipo_vision']) : asset('static/img/vision.jpg') }}" alt="Visión" class="card-img-top">
                        @if(Auth::check())
                            <form method="POST" action="{{ route('carrusel-imagen.update', 'equipo_vision') }}" enctype="multipart/form-data" class="mt-2 text-center form-carrusel-img" data-clave="equipo_vision">
                                @csrf
                                <input type="file" name="imagen" accept="image/*" style="display:inline-block;">
                            </form>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">Visión</h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card" data-bs-toggle="modal" data-bs-target="#servicesModal">
                        <img src="{{ isset($imagenes['equipo_servicios']) ? asset('storage/' . $imagenes['equipo_servicios']) : asset('static/img/servicios.jpg') }}" alt="Servicios" class="card-img-top">
                        @if(Auth::check())
                            <form method="POST" action="{{ route('carrusel-imagen.update', 'equipo_servicios') }}" enctype="multipart/form-data" class="mt-2 text-center form-carrusel-img" data-clave="equipo_servicios">
                                @csrf
                                <input type="file" name="imagen" accept="image/*" style="display:inline-block;">
                            </form>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">Servicios</h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Modal Misión -->
    <div class="modal fade" id="missionModal" tabindex="-1" aria-labelledby="missionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="missionModalLabel"
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="modal_mision_titulo"
                        @endif
                    >{{ $modal_mision_titulo ?? 'Nuestra Misión' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="modal_mision_texto"
                        @endif
                    >{{ $modal_mision_texto ?? 'Proveer servicios integrales en logística portuaria y comercio internacional con un enfoque en calidad y sostenibilidad.' }}</p>
                    @if(Auth::check())
                    <button class="btn btn-warning mt-3" onclick="guardarModalTexto('modal_mision_titulo', 'modal_mision_texto', 'missionModal')">Guardar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Visión -->
    <div class="modal fade" id="visionModal" tabindex="-1" aria-labelledby="visionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="modal_vision_titulo"
                        @endif
                    >{{ $modal_vision_titulo ?? 'Nuestra Visión' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="modal_vision_texto"
                        @endif
                    >{{ $modal_vision_texto ?? 'Ser reconocidos como líderes en el sector portuario y de comercio internacional a nivel global.' }}</p>
                    @if(Auth::check())
                    <button class="btn btn-warning mt-3" onclick="guardarModalTexto('modal_vision_titulo', 'modal_vision_texto', 'visionModal')">Guardar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Servicios -->
    <div class="modal fade" id="servicesModal" tabindex="-1" aria-labelledby="servicesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="modal_servicios_titulo"
                        @endif
                    >{{ $modal_servicios_titulo ?? 'Nuestros Servicios' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p
                        @if(Auth::check())
                            contenteditable="true"
                            style="border:1px dashed #ffc107; outline:none;"
                            id="modal_servicios_texto"
                        @endif
                    >{{ $modal_servicios_texto ?? 'Ofrecemos una amplia gama de servicios para optimizar tus operaciones logísticas, incluyendo gestión portuaria, soluciones en comercio internacional, transporte de carga, asesoría en aduanas y más.' }}</p>
                    @if(Auth::check())
                    <button class="btn btn-warning mt-3" onclick="guardarModalTexto('modal_servicios_titulo', 'modal_servicios_texto', 'servicesModal')">Guardar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="hero-content text-center text-white py-5">
        <h1>ESPOMALIA C.LTDA</h1>
        <h2>Gestión y Servicios</h2>
        <button onclick="window.location.href='{{ route('contacto') }}'" class="btn btn-light mt-3">Contáctanos</button>
    </div>
</section>

<!-- Modal de Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}" id="loginForm">
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


<!-- Footer -->
<footer class="text-white py-3 mt-5">
    <div class="container text-center">
        &copy; 2024 ESPOMALIA C.LTDA - Todos los derechos reservados
    </div>
</footer>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS personalizado -->
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>

@if(Auth::check())
<form id="form-carrusel-texto" method="POST" action="{{ route('texto.update', 'dummy') }}" style="display:none;">
    @csrf
    @method('PUT')
    <input type="hidden" name="clave" id="clave-carrusel">
    <input type="hidden" name="contenido" id="contenido-carrusel">
</form>
<script>
function guardarTextos(idTitulo, idTexto) {
    const titulo = document.getElementById(idTitulo)?.innerText.trim();
    const texto = document.getElementById(idTexto)?.innerText.trim();

    Promise.all([
        fetch("{{ url('/texto') }}/" + idTitulo, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                clave: idTitulo,
                contenido: titulo
            })
        }),
        fetch("{{ url('/texto') }}/" + idTexto, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                clave: idTexto,
                contenido: texto
            })
        })
    ]).then(() => {
        const tituloEl = document.getElementById(idTitulo);
        const textoEl = document.getElementById(idTexto);
        if (tituloEl) {
            tituloEl.style.backgroundColor = "#d4edda";
            setTimeout(() => tituloEl.style.backgroundColor = "", 800);
        }
        if (textoEl) {
            textoEl.style.backgroundColor = "#d4edda";
            setTimeout(() => textoEl.style.backgroundColor = "", 800);
        }
    }).catch(() => {
        alert('Error al guardar los cambios');
    });
}

function guardarTextoEmpresa() {
    const titulo = document.getElementById('empresa_titulo')?.innerText.trim();
    const parrafo1 = document.getElementById('empresa_parrafo_1')?.innerText.trim();
    const parrafo2 = document.getElementById('empresa_parrafo_2')?.innerText.trim();

    Promise.all([
        fetch("{{ url('/texto') }}/empresa_titulo", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                clave: 'empresa_titulo',
                contenido: titulo
            })
        }),
        fetch("{{ url('/texto') }}/empresa_parrafo_1", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                clave: 'empresa_parrafo_1',
                contenido: parrafo1
            })
        }),
        fetch("{{ url('/texto') }}/empresa_parrafo_2", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                clave: 'empresa_parrafo_2',
                contenido: parrafo2
            })
        })
    ]).then(() => {
        ['empresa_titulo', 'empresa_parrafo_1', 'empresa_parrafo_2'].forEach(id => {
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
<script>
function guardarModalTexto(idTitulo, idTexto, modalId) {
    const titulo = document.getElementById(idTitulo)?.innerText.trim();
    const texto = document.getElementById(idTexto)?.innerText.trim();

    // Guardar título y texto en paralelo
    Promise.all([
        fetch("{{ url('/texto') }}/" + idTitulo, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                clave: idTitulo,
                contenido: titulo
            })
        }),
        fetch("{{ url('/texto') }}/" + idTexto, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                clave: idTexto,
                contenido: texto
            })
        })
    ]).then(() => {
        // Feedback visual
        const tituloEl = document.getElementById(idTitulo);
        const textoEl = document.getElementById(idTexto);

        if (tituloEl) {
            tituloEl.style.backgroundColor = "#d4edda";
            setTimeout(() => tituloEl.style.backgroundColor = "", 800);
        }
        if (textoEl) {
            textoEl.style.backgroundColor = "#d4edda";
            setTimeout(() => textoEl.style.backgroundColor = "", 800);
        }

        // Cerrar el modal automáticamente
        const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
        if (modal) modal.hide();

        // Opcional: mostrar mensaje de éxito
        // alert('¡Información guardada exitosamente!');
    }).catch(() => {
        alert('Error al guardar los cambios');
    });
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Para cada modal, actualiza el contenido al abrirlo
    const modales = [
        {modal: '#missionModal', titulo: 'modal_mision_titulo', texto: 'modal_mision_texto'},
        {modal: '#visionModal', titulo: 'modal_vision_titulo', texto: 'modal_vision_texto'},
        {modal: '#servicesModal', titulo: 'modal_servicios_titulo', texto: 'modal_servicios_texto'},
    ];

    modales.forEach(({modal, titulo, texto}) => {
        const modalEl = document.querySelector(modal);
        if (!modalEl) return;
        modalEl.addEventListener('show.bs.modal', function () {
            // Busca los elementos editables por clave y actualiza su contenido
            const h5 = modalEl.querySelector(`[onblur*="${titulo}"]`);
            const p = modalEl.querySelector(`[onblur*="${texto}"]`);
            if (h5) h5.innerText = h5.innerText; // fuerza el valor actual
            if (p) p.innerText = p.innerText;
        });
    });
});
</script>
<script>
$('#loginForm').on('submit', function(e) {
    e.preventDefault();
    // ... AJAX ...
});
</script>
<script>
document.querySelectorAll('.form-carrusel-img input[type="file"]').forEach(function(input) {
    input.addEventListener('change', function(e) {
        e.preventDefault();
        var form = this.closest('form');
        var formData = new FormData(form);
        var action = form.getAttribute('action');
        fetch(action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Actualiza la imagen en el carrusel sin recargar
            var clave = form.getAttribute('data-clave');
            var img = form.parentElement.querySelector('img');
            if (img && data.ruta) {
                img.src = '/storage/' + data.ruta + '?t=' + new Date().getTime(); // cache busting
            }
            // Muestra el modal de éxito
            var modal = new bootstrap.Modal(document.getElementById('modalExitoImagen'));
            modal.show();
        })
        .catch(() => {
            alert('Error al subir la imagen');
        });
    });
});
</script>

<!-- Modal de éxito para actualización de imagen -->
<div class="modal fade" id="modalExitoImagen" tabindex="-1" aria-labelledby="modalExitoImagenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalExitoImagenLabel">¡Imagen actualizada!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                La imagen del carrusel se actualizó correctamente.
            </div>
        </div>
    </div>
</div>
@endif