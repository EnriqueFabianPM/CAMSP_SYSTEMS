<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fotoqr')->nullable();
            $table->string('foto')->nullable();
            $table->string('identificador')->unique();
            $table->string('nombre');
            $table->string('apellidos')->nullable();
            $table->enum('rol', ['admin', 'docente', 'estudiante', 'padre', 'visitante'])->default('visitante');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('curp', 18)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('condicion')->nullable(); // discapacidad, TEA, motriz, etc.
            $table->string('taller_asignado')->nullable(); // panadería, carpintería, etc.
            $table->unsignedBigInteger('responsable_id')->nullable(); // referencia a otro usuario (padre/docente)
            $table->text('observaciones')->nullable();
            $table->string('estatus')->default('Activo');
            $table->timestamp('ultimo_acceso')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Clave foránea a sí misma (usuarios que son responsables de otros)
            $table->foreign('responsable_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};