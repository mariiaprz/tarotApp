<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carta', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->enum('arcano', ['mayor', 'menor']);
            $table->string('palo', 50)->nullable();
            $table->text('significado_derecho');
            $table->text('significado_invertido');
            $table->string('imagen', 100)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carta');
    }
};
