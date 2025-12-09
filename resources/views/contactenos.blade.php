<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portuaria - Gestión y Servicios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/contactos.css') }}" rel="stylesheet">
</head>
<body>
    <header class="py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <img src="{{ asset('static/img/icons/logo_espomalia.png') }}" alt="Logo Portuaria" class="img-fluid">
            </div>
            
            <!-- Menú principal para pantallas grandes -->
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
    
            <!-- Botón de menú hamburguesa -->
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <!-- Menú desplegable para móviles -->
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

    <section class="contact-section py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title text-center w-100 @if(Auth::check()) texto-editable @endif" 
                    @if(Auth::check()) contenteditable="true" style="border:1px dashed #ffc107; outline:none;" id="contacto_titulo" @endif>
                    {{ App\Models\Texto::obtenerTexto('contacto_titulo', 'Contáctanos') }}
                </h2>
                @if(Auth::check())
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#mensajesModal">
                        <i class="fas fa-envelope"></i> 
                        <span class="@if(Auth::check()) texto-editable @endif" 
                              @if(Auth::check()) contenteditable="true" data-clave="contacto_btn_ver_mensajes" @endif>
                            {{ App\Models\Texto::obtenerTexto('contacto_btn_ver_mensajes', 'Ver Mensajes') }}
                        </span>
                    </button>
                @endif
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <p class="text-center mb-4 @if(Auth::check()) texto-editable @endif" 
               @if(Auth::check()) contenteditable="true" style="border:1px dashed #ffc107; outline:none;" id="contacto_descripcion" @endif>
                {{ App\Models\Texto::obtenerTexto('contacto_descripcion', 'Si tienes preguntas o necesitas más información, completa el siguiente formulario y nos pondremos en contacto contigo lo antes posible.') }}
            </p>
            @if(Auth::check())
            <div class="text-center mb-3">
                <button class="btn btn-warning btn-sm" onclick="guardarTextoContacto()">Guardar Cambios</button>
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form id="contactForm" method="POST" action="{{ route('contacto.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label @if(Auth::check()) texto-editable @endif" 
                                   @if(Auth::check()) contenteditable="true" data-clave="contacto_label_nombre" @endif>
                                {{ App\Models\Texto::obtenerTexto('contacto_label_nombre', 'Nombre:') }}
                            </label><span class="required">*</span>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label @if(Auth::check()) texto-editable @endif" 
                                   @if(Auth::check()) contenteditable="true" data-clave="contacto_label_email" @endif>
                                {{ App\Models\Texto::obtenerTexto('contacto_label_email', 'Correo Electrónico:') }}
                            </label><span class="required">*</span>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label @if(Auth::check()) texto-editable @endif" 
                                   @if(Auth::check()) contenteditable="true" data-clave="contacto_label_asunto" @endif>
                                {{ App\Models\Texto::obtenerTexto('contacto_label_asunto', 'Asunto:') }}
                            </label><span class="required">*</span>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label @if(Auth::check()) texto-editable @endif" 
                                   @if(Auth::check()) contenteditable="true" data-clave="contacto_label_mensaje" @endif>
                                {{ App\Models\Texto::obtenerTexto('contacto_label_mensaje', 'Mensaje:') }}
                            </label><span class="required">*</span>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary @if(Auth::check()) texto-editable @endif" 
                                    @if(Auth::check()) contenteditable="true" data-clave="contacto_btn_enviar" @endif>
                                {{ App\Models\Texto::obtenerTexto('contacto_btn_enviar', 'Enviar Mensaje') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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

    <!-- Modal de Mensajes (solo para usuarios autenticados) -->
    @if(Auth::check())
        <div class="modal fade" id="mensajesModal" tabindex="-1" aria-labelledby="mensajesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mensajesModalLabel">Mensajes de Contacto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Selector de registros por página -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="perPageSelect" class="form-label">Registros por página:</label>
                                <select id="perPageSelect" class="form-select" onchange="cambiarRegistrosPorPagina()">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tabla de mensajes -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Asunto</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="mensajesTableBody">
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Cargando...</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <nav aria-label="Paginación de mensajes">
                            <ul class="pagination justify-content-center" id="paginationContainer">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para responder mensaje -->
        <div class="modal fade" id="responderModal" tabindex="-1" aria-labelledby="responderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="responderModalLabel">Responder Mensaje</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <strong>De:</strong> <span id="responderNombre"></span> (<span id="responderEmail"></span>)
                        </div>
                        <div class="mb-3">
                            <strong>Asunto:</strong> <span id="responderAsunto"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Mensaje original:</strong>
                            <div class="border p-3 bg-light" id="responderMensajeOriginal"></div>
                        </div>
                        <div class="mb-3">
                            <label for="respuestaTexto" class="form-label"><strong>Tu respuesta:</strong></label>
                            <textarea class="form-control" id="respuestaTexto" rows="6" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="enviarRespuesta()">Enviar Respuesta</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para ver mensaje completo -->
        <div class="modal fade" id="verMensajeModal" tabindex="-1" aria-labelledby="verMensajeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verMensajeModalLabel">Detalle del Mensaje</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <strong>De:</strong> <span id="verNombre"></span> (<span id="verEmail"></span>)
                        </div>
                        <div class="mb-3">
                            <strong>Asunto:</strong> <span id="verAsunto"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Fecha:</strong> <span id="verFecha"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Mensaje:</strong>
                            <div class="border p-3 bg-light" id="verMensaje"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <footer class="text-white py-3">
        <div class="container text-center">
            &copy; 2024 PORTUARIA - Todos los derechos reservados
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    @if(Auth::check())
    <script>
        // Agregar estilos CSS para textos editables
        const style = document.createElement('style');
        style.textContent = `
            .texto-editable {
                border: 1px dashed #ffc107 !important;
                outline: none !important;
                padding: 2px 4px !important;
                border-radius: 3px !important;
                transition: background-color 0.3s ease !important;
            }
            .texto-editable:hover {
                background-color: #fff3cd !important;
            }
            .texto-editable:focus {
                background-color: #fff3cd !important;
                border-color: #ff6b35 !important;
            }
        `;
        document.head.appendChild(style);

        // Configurar textos editables
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.texto-editable').forEach(element => {
                element.addEventListener('blur', function() {
                    guardarTexto(this);
                });
            });
        });

        // Función para guardar textos editables
        function guardarTexto(element) {
            const clave = element.getAttribute('data-clave');
            let contenido = element.innerText.trim();
            
            if (!contenido || !clave) return;

            fetch("{{ url('/texto') }}/" + clave, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        contenido: contenido
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Error al guardar');
                    element.style.backgroundColor = "#d4edda";
                    setTimeout(() => element.style.backgroundColor = "", 800);
                })
                .catch(() => {
                    element.style.backgroundColor = "#f8d7da";
                    setTimeout(() => element.style.backgroundColor = "", 800);
                });
        }

        // Cargar mensajes cuando se abre el modal
        let paginaActual = 1;
        let registrosPorPagina = 10;
        let mensajeIdParaResponder = null;

        document.getElementById('mensajesModal').addEventListener('show.bs.modal', function () {
            cargarMensajes(1);
        });

        function cambiarRegistrosPorPagina() {
            registrosPorPagina = parseInt(document.getElementById('perPageSelect').value);
            cargarMensajes(1);
        }

        function cargarMensajes(pagina = 1) {
            paginaActual = pagina;
            const tbody = document.getElementById('mensajesTableBody');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Cargando...</span></div></td></tr>';

            fetch(`{{ route("contacto.mensajes") }}?page=${pagina}&per_page=${registrosPorPagina}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No hay mensajes de contacto.</td></tr>';
                        document.getElementById('paginationContainer').innerHTML = '';
                        return;
                    }

                    // Generar filas de la tabla
                    let html = '';
                    data.data.forEach(mensaje => {
                        const fecha = new Date(mensaje.created_at).toLocaleDateString('es-ES', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        
                        let estadoBadge = '';
                        if (mensaje.respondido) {
                            estadoBadge = '<span class="badge bg-info">Respondido</span>';
                        } else if (mensaje.leido) {
                            estadoBadge = '<span class="badge bg-success">Leído</span>';
                        } else {
                            estadoBadge = '<span class="badge bg-warning text-dark">Nuevo</span>';
                        }

                        const rowClass = !mensaje.leido ? 'table-warning' : (mensaje.respondido ? 'table-info' : '');

                        html += `
                            <tr class="${rowClass}">
                                <td>${fecha}</td>
                                <td class="${!mensaje.leido ? 'fw-bold' : ''}">${mensaje.name}</td>
                                <td>${mensaje.email}</td>
                                <td>
                                    <a href="#" onclick="verMensajeCompleto(${mensaje.id}, event)" class="${!mensaje.leido ? 'fw-bold text-dark' : 'text-decoration-none'}">
                                        ${mensaje.subject}
                                    </a>
                                </td>
                                <td>${estadoBadge}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        ${!mensaje.respondido ? `<button class="btn btn-primary" onclick="abrirModalResponder(${mensaje.id})" title="Responder">
                                            <i class="fas fa-reply"></i>
                                        </button>` : ''}
                                        ${!mensaje.leido ? `<button class="btn btn-success" onclick="marcarLeido(${mensaje.id})" title="Marcar como leído">
                                            <i class="fas fa-check"></i>
                                        </button>` : ''}
                                        <button class="btn btn-danger" onclick="eliminarMensaje(${mensaje.id})" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                    
                    tbody.innerHTML = html;
                    
                    // Generar paginación
                    generarPaginacion(data);
                })
                .catch(error => {
                    console.error('Error completo:', error);
                    tbody.innerHTML = `<tr><td colspan="6" class="text-center"><div class="alert alert-danger mb-0">Error al cargar mensajes: ${error.message}</div></td></tr>`;
                });
        }

        function generarPaginacion(data) {
            const container = document.getElementById('paginationContainer');
            if (!data.last_page || data.last_page <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '';
            
            // Botón anterior
            html += `
                <li class="page-item ${data.current_page === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="cargarMensajes(${data.current_page - 1}); return false;">Anterior</a>
                </li>
            `;

            // Páginas
            for (let i = 1; i <= data.last_page; i++) {
                if (
                    i === 1 || 
                    i === data.last_page || 
                    (i >= data.current_page - 2 && i <= data.current_page + 2)
                ) {
                    html += `
                        <li class="page-item ${i === data.current_page ? 'active' : ''}">
                            <a class="page-link" href="#" onclick="cargarMensajes(${i}); return false;">${i}</a>
                        </li>
                    `;
                } else if (i === data.current_page - 3 || i === data.current_page + 3) {
                    html += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
            }

            // Botón siguiente
            html += `
                <li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="cargarMensajes(${data.current_page + 1}); return false;">Siguiente</a>
                </li>
            `;

            container.innerHTML = html;
        }

        function verMensajeCompleto(id, event) {
            event.preventDefault();
            
            fetch(`{{ route("contacto.mensajes") }}?per_page=999`)
                .then(response => response.json())
                .then(data => {
                    const mensaje = data.data.find(m => m.id === id);
                    if (mensaje) {
                        document.getElementById('verNombre').textContent = mensaje.name;
                        document.getElementById('verEmail').textContent = mensaje.email;
                        document.getElementById('verAsunto').textContent = mensaje.subject;
                        document.getElementById('verFecha').textContent = new Date(mensaje.created_at).toLocaleString('es-ES');
                        document.getElementById('verMensaje').textContent = mensaje.message;
                        
                        const modal = new bootstrap.Modal(document.getElementById('verMensajeModal'));
                        modal.show();
                    }
                });
        }

        function abrirModalResponder(id) {
            mensajeIdParaResponder = id;
            
            fetch(`{{ route("contacto.mensajes") }}?per_page=999`)
                .then(response => response.json())
                .then(data => {
                    const mensaje = data.data.find(m => m.id === id);
                    if (mensaje) {
                        document.getElementById('responderNombre').textContent = mensaje.name;
                        document.getElementById('responderEmail').textContent = mensaje.email;
                        document.getElementById('responderAsunto').textContent = mensaje.subject;
                        document.getElementById('responderMensajeOriginal').textContent = mensaje.message;
                        document.getElementById('respuestaTexto').value = '';
                        
                        const modal = new bootstrap.Modal(document.getElementById('responderModal'));
                        modal.show();
                    }
                });
        }

        function enviarRespuesta() {
            const respuesta = document.getElementById('respuestaTexto').value.trim();
            
            if (!respuesta) {
                alert('Por favor escribe una respuesta');
                return;
            }

            if (!mensajeIdParaResponder) {
                alert('Error: No se ha seleccionado ningún mensaje');
                return;
            }

            const btn = event.target;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Enviando...';

            fetch(`/contacto/${mensajeIdParaResponder}/responder`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ respuesta: respuesta })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Respuesta enviada correctamente por email');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('responderModal'));
                    modal.hide();
                    cargarMensajes(paginaActual);
                } else {
                    alert('Error: ' + (data.message || 'No se pudo enviar la respuesta'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al enviar la respuesta: ' + error.message);
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = 'Enviar Respuesta';
            });
        }

        function marcarLeido(id) {
            fetch(`/contacto/${id}/leido`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cargarMensajes(); // Recargar mensajes
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function eliminarMensaje(id) {
            if (confirm('¿Estás seguro de eliminar este mensaje?')) {
                fetch(`/contacto/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        cargarMensajes(); // Recargar mensajes
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function guardarTextoContacto() {
            const titulo = document.getElementById('contacto_titulo')?.innerText.trim();
            const descripcion = document.getElementById('contacto_descripcion')?.innerText.trim();

            Promise.all([
                fetch("{{ url('/texto') }}/contacto_titulo", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        clave: 'contacto_titulo',
                        contenido: titulo
                    })
                }),
                fetch("{{ url('/texto') }}/contacto_descripcion", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        clave: 'contacto_descripcion',
                        contenido: descripcion
                    })
                })
            ]).then(() => {
                ['contacto_titulo', 'contacto_descripcion'].forEach(id => {
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
