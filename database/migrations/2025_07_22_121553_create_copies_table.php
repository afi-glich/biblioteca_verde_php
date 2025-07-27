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
        Schema::create('copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->string('barcode')->unique(); // codice a barre univoco
            $table->enum('condition', ['ottimo', 'buono', 'discreto'])->default('buono');
            $table->enum('status', ['disponibile', 'prenotato', 'non disponibile'])->default('disponibile');
            $table->string('location'); // the shelf where the book can be found
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copies');
    }
};
