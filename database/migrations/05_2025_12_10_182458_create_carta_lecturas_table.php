<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carta_lectura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idlectura');
            $table->foreignId('idcarta');
            $table->tinyInteger('orden');
            $table->string('nombre_posicion', 50);
            $table->boolean('invertida')->default(false);
            $table->timestamps();

            $table->foreign('idlectura')->references('id')->on('lectura')->onDelete('cascade');
            $table->foreign('idcarta')->references('id')->on('carta');
            $table->unique(['idlectura', 'orden']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carta_lectura');
    }
};
