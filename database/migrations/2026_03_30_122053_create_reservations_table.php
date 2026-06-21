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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('code_order')->unique();
            $table->foreignId('status_id')->nullable()->constrained('status_reservations')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->boolean('booking')->defautl(false);
            $table->timestamp('expiry_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
