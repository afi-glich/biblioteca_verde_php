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
        Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('isbn')->unique();
        $table->text('description');
        $table->string('publisher');
        $table->string('author');
        $table->string('publication_year');
        $table->string('cover')->nullable();
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
