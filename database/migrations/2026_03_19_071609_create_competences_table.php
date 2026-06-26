<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
{
    Schema::create('competences', function (Blueprint $table) {
        $table->id();
        $table->string('nom'); // Ex: PHP
        $table->integer('niveau'); // Ex: 85 (pour 85%)
        $table->string('icone')->nullable(); // Ex: fab fa-php
        $table->timestamps();
    });
}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences');
    }
};
