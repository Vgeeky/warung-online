<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Siapa yang memesan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Total harga pesanan
            $table->decimal('total_price', 12, 2)->default(0);

            // Status pesanan: pending, processing, shipping, delivered, canceled
            $table->enum('status', ['pending', 'processing', 'shipping', 'delivered', 'canceled'])->default('pending');

            // Alamat pengiriman
            $table->string('shipping_address');
            $table->string('city');
            $table->string('postal_code', 10);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
