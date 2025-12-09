<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organigramas', function (Blueprint $table) {
            if (!Schema::hasColumn('organigramas', 'cargo')) {
                $table->string('cargo')->after('id');
            }
            if (!Schema::hasColumn('organigramas', 'titulo')) {
                $table->string('titulo')->after('cargo');
            }
            if (!Schema::hasColumn('organigramas', 'descripcion')) {
                $table->text('descripcion')->after('titulo');
            }
            if (!Schema::hasColumn('organigramas', 'imagen')) {
                $table->string('imagen')->nullable()->after('descripcion');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organigramas', function (Blueprint $table) {
            $table->dropColumn(['cargo', 'titulo', 'descripcion', 'imagen']);
        });
    }
};
