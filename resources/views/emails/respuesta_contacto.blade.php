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
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            font-size: 12px;
            color: #666;
        }
        .original-message {
            background-color: #e9ecef;
            padding: 15px;
            margin-top: 20px;
            border-left: 4px solid #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ESPOMALIA C.LTDA</h1>
            <p>Respuesta a tu mensaje</p>
        </div>
        
        <div class="content">
            <p>Hola <strong>{{ $nombreCliente }}</strong>,</p>
            
            <p>Gracias por contactarnos. A continuación encontrarás nuestra respuesta a tu consulta:</p>
            
            <div style="background-color: white; padding: 15px; margin: 20px 0; border-radius: 5px;">
                {{ $respuesta }}
            </div>
            
            <div class="original-message">
                <h3 style="margin-top: 0;">Tu mensaje original:</h3>
                <p><strong>Asunto:</strong> {{ $asuntoOriginal }}</p>
                <p><strong>Mensaje:</strong></p>
                <p>{{ $mensajeOriginal }}</p>
            </div>
            
            <p style="margin-top: 20px;">Si tienes más preguntas, no dudes en contactarnos nuevamente.</p>
            
            <p>Saludos cordiales,<br>
            <strong>Equipo ESPOMALIA C.LTDA</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 ESPOMALIA C.LTDA - Todos los derechos reservados</p>
            <p>Este es un correo automático, por favor no respondas a esta dirección.</p>
        </div>
    </div>
</body>
</html>
