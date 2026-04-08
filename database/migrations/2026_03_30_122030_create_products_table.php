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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('oem')->unique()->nullable();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('status_id')->constrained('status_products')->onDelete('cascade')->nullable();
            $table->text('compatibility_notes')->nullable();
            $table->text('technical_specs')->nullable();
            $table->decimal('price_buy', 10, 2);
            $table->decimal('price_sell', 10, 2);
            $table->integer('stock');
            $table->integer('min_stock')->default(5);
            $table->string('image_main')->nullable();
            //$table->enum('status', ['disponible', 'agotado', 'descontinuado'])->default('disponible');
            $table->softDeletes(); // Para eliminación lógica
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
