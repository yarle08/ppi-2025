<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('panel_textos', function (Blueprint $table) {
            $table->id();
            $table->string('panel'); // organigrama, servicios, contacto
            $table->string('clave'); // ejemplo: titulo, descripcion, etc
            $table->text('valor');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('panel_textos');
    }
};
