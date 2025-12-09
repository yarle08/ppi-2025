<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - ESPOMALIA C.LTDA</title>
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

    <!-- Modal de Login -->
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

    <!-- Historia -->
    <section class="history-section py-5">
        <div class="container">
            <h1 class="section-title text-center mb-5">Nuestra Historia</h1>
            <p class="lead">ESPOMALIA C.LTDA nació con el propósito de optimizar la gestión portuaria y brindar soluciones logísticas innovadoras. Fundada en 2000, comenzamos como una pequeña empresa familiar enfocada en servicios aduaneros. Con el tiempo, hemos crecido hasta convertirnos en líderes en el sector portuario.</p>
            <p class="lead">Nuestra evolución ha estado marcada por el compromiso constante con la calidad, la innovación y la sostenibilidad. A lo largo de los años, hemos implementado mejoras significativas en nuestros procesos y servicios para satisfacer las necesidades cambiantes de nuestros clientes.</p>
        </div>
    </section>

    <!-- Hitos -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Hitos Importantes</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="milestone text-center">
                        <img src="{{ asset('static/img/empresa.jpg') }}" alt="Inicio" class="milestone-img mb-3">
                        <h5>2000 - Fundada la Empresa</h5>
                        <p>Comenzamos nuestras operaciones con un pequeño equipo de profesionales dedicados.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="milestone text-center">
                        <img src="{{ asset('static/img/expansiondeservicios.jpg') }}" alt="Expansión" class="milestone-img mb-3">
                        <h5>2010 - Expansión de Servicios</h5>
                        <p>Ampliamos nuestras operaciones para incluir soluciones logísticas internacionales.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="milestone text-center">
                        <img src="{{ asset('static/img/sostenibilidad.jpg') }}" alt="Sostenibilidad" class="milestone-img mb-3">
                        <h5>2020 - Enfoque en Sostenibilidad</h5>
                        <p>Adoptamos prácticas sostenibles en todas nuestras operaciones.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="section-title mb-5">Galería de Imágenes</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="img-wrapper">
                        <img src="{{ asset('static/img/galeria1.jpg') }}" alt="Imagen 1" class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="img-wrapper">
                        <img src="{{ asset('static/img/galeria2.jpg') }}" alt="Imagen 2" class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="img-wrapper">
                        <img src="{{ asset('static/img/galeria3.jpg') }}" alt="Imagen 3" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-white py-3 bg-dark">
        <div class="container text-center">
            &copy; 2024 ESPOMALIA C.LTDA - Todos los derechos reservados
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
