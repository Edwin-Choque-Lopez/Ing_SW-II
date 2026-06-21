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
            $table->string('oem')->nullable()->unique();
            $table->string('name')->nullable()->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('cascade');
            $table->foreignId('status_id')->nullable()->constrained('status_products')->onDelete('cascade');
            $table->text('technical_notes')->nullable();
            $table->decimal('price_buy', 10, 2);
            $table->decimal('price_sell', 10, 2);
            $table->integer('stock');
            $table->integer('min_stock')->default(5);
            $table->string('image_main')->nullable();
            $table->softDeletes(); 
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
