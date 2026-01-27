<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lectura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iduser');
            $table->foreignId('idtema');
            $table->foreignId('idtipo_tirada');
            $table->text('pregunta')->nullable();
            $table->longText('interpretacion')->nullable();
            $table->timestamps();

            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idtema')->references('id')->on('tema');
            $table->foreign('idtipo_tirada')->references('id')->on('tipo_tirada');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lectura');
    }
};
