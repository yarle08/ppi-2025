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

    <main class="py-5">
        <div class="container">
            <h1 class="text-center mb-5">Nuestros Servicios</h1>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card service-card">
                        <img src="{{ asset('static/img/servicio1.jpg') }}" class="card-img-top" alt="Servicio 1">
                        <div class="card-body">
                            <h5 class="card-title service-title">Limpieza</h5>
                            <p class="card-text">La limpieza de buques es esencial para mantener su rendimiento, prevenir la corrosión </p>
                            <button class="btn btn-primary service-button" data-service="Limpieza" data-duration="2 horas" data-price="$1,200" data-description="La limpieza de buques es esencial para mantener su rendimiento y prevenir la corrosión.">Seleccionar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card service-card">
                        <img src="{{ asset('static/img/servicio2.jpg') }}" class="card-img-top" alt="Servicio 2">
                        <div class="card-body">
                            <h5 class="card-title service-title">Pintura</h5>
                            <p class="card-text">Este servicio especializado de pintura para buques garantiza protección contra la corrosión.</p>
                            <button class="btn btn-primary service-button" data-service="Pintura" data-duration="3 horas" data-price="$1,800" data-description="Este servicio de pintura garantiza una protección duradera contra la corrosión.">Seleccionar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card service-card">
                        <img src="{{ asset('static/img/servicio3.jpg') }}" class="card-img-top" alt="Servicio 3">
                        <div class="card-body">
                            <h5 class="card-title service-title">Mantenimiento</h5>
                            <p class="card-text">Brindamos servicios integrales de mantenimiento de buques.</p>
                            <button class="btn btn-primary service-button" data-service="Mantenimiento" data-duration="4 horas" data-price="$900" data-description="Servicio integral de mantenimiento para buques.">Seleccionar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-3">
        <div>&copy; 2024 PORTUARIA - Todos los derechos reservados</div>
    </footer>

    <!-- Modal Servicio -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Detalles del Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="serviceDescription"></p>
                    <p id="serviceDuration"></p>
                    <p id="serviceCost"></p>
                    <div id="successMessage" class="d-none text-center mt-3">
                        <h4>¡Servicio adquirido!</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.service-button').forEach(button => {
            button.addEventListener('click', function () {
                const serviceName = this.getAttribute('data-service');
                const serviceDuration = this.getAttribute('data-duration');
                const servicePrice = this.getAttribute('data-price');
                const serviceDescription = this.getAttribute('data-description');
                
                document.getElementById('serviceDescription').textContent = serviceDescription;
                document.getElementById('serviceDuration').textContent = `Duración: ${serviceDuration}`;
                document.getElementById('serviceCost').textContent = `Costo: ${servicePrice}`;

                const modal = new bootstrap.Modal(document.getElementById('serviceModal'));
                modal.show();
            });
        });
    </script>
</body>
</html>
