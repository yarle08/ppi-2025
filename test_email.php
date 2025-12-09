<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('Este es un email de prueba desde Laravel ESPOMALIA', function ($message) {
        $message->to('jarayarleni8@gmail.com')
                ->subject('🧪 Prueba de Email - ESPOMALIA');
    });
    
    echo "✅ Email enviado exitosamente a jarayarleni8@gmail.com\n";
    echo "Revisa tu bandeja de entrada (o spam)\n";
} catch (Exception $e) {
    echo "❌ Error al enviar email:\n";
    echo $e->getMessage() . "\n";
}
