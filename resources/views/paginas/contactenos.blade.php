<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portuaria - Gestión y Servicios</title>
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
            
            <!-- Menú principal para pantallas grandes -->
            <nav class="d-none d-md-flex">
                <a href="../../index.html" class="text-white text-decoration-none mx-3">Inicio</a>
                <a href="../../paginas/nuestros_servicios/nuestro_servicios.html" class="text-white text-decoration-none mx-3">Nuestros Servicios</a>
                <a href="../../paginas/sobre_nosotros/sobre_nosotros.html" class="text-white text-decoration-none mx-3">Sobre Nosotros</a>
                <a href="../../paginas/organigrama/organigrama.html" class="text-white text-decoration-none mx-3">Organigrama</a>
                <a href="../../paginas/contactenos/contactenos.html" class="text-white text-decoration-none mx-3">Contáctanos</a>
            </nav>
            
            <button class="btn btn-primary d-none d-md-block" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    
            <!-- Botón de menú hamburguesa -->
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <!-- Menú desplegable para móviles -->
        <div class="collapse navbar-collapse d-md-none" id="mobileMenu">
            <nav class="navbar-nav text-center">
                <a href="../../index.html" class="nav-link">Inicio</a>
                <a href="../../paginas/nuestros_servicios/nuestro_servicios.html" class="nav-link">Nuestros Servicios</a>
                <a href="../../paginas/sobre_nosotros/sobre_nosotros.html" class="nav-link">Sobre Nosotros</a>
                <a href="../../paginas/organigrama/organigrama.html" class="nav-link">Organigrama</a>
                <a href="../../paginas/contactenos/contactenos.html" class="nav-link">Contáctanos</a>
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </nav>
        </div>
    </header>

    <section class="contact-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-4">Contáctanos</h2>
            <p class="text-center mb-4">Si tienes preguntas o necesitas más información, completa el siguiente formulario 
                y nos pondremos en contacto contigo lo antes posible.</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form id="contactForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:<span class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:<span class="required">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Asunto:<span class="required">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje:<span class="required">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                        </div>
                        
                        
                    </form>
                    <div id="successMessage" class="alert alert-success mt-3 d-none" role="alert">
                        Mensaje Enviado
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <a href="../../adminpaginas/inicioadmin/indexadmin.html" class="btn btn-primary">Iniciar Sesión</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-white py-3">
        <div class="container text-center">
            &copy; 2024 PORTUARIA - Todos los derechos reservados
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function (event) {
            event.preventDefault(); 
            document.getElementById('successMessage').classList.remove('d-none'); 
            this.reset(); 
        });
    </script>
</body>
</html>
