<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #007bff;
            border-radius: 3px;
        }
        .label {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            min-width: 100px;
        }
        .message-box {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #dee2e6;
            border-radius: 3px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #dee2e6;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📩 Nuevo Mensaje de Contacto</h1>
            <p>ESPOMALIA C.LTDA</p>
        </div>
        
        <div class="content">
            <p>Has recibido un nuevo mensaje desde el formulario de contacto de tu sitio web.</p>
            
            <div class="info-box">
                <p><span class="label">Nombre:</span> {{ $contacto->name }}</p>
                <p><span class="label">Email:</span> <a href="mailto:{{ $contacto->email }}">{{ $contacto->email }}</a></p>
                <p><span class="label">Asunto:</span> {{ $contacto->subject }}</p>
            </div>
            
            <h3>Mensaje:</h3>
            <div class="message-box">
                {{ $contacto->message }}
            </div>
            
            <p style="text-align: center;">
                <a href="http://127.0.0.1:8000/contactenos" class="button">Ver en el Panel de Admin</a>
            </p>
            
            <p style="margin-top: 20px; font-size: 14px; color: #666;">
                <strong>Tip:</strong> Puedes responder directamente a este email o acceder al panel de administración para gestionar todos tus mensajes.
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 ESPOMALIA C.LTDA - Sistema de Gestión de Mensajes</p>
            <p>Este correo fue generado automáticamente.</p>
        </div>
    </div>
</body>
</html>
