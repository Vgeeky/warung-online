<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Menghubungkan ke pesanan mana item ini berada
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            // Produk apa yang dibeli
            $table->foreignId('product_id')->constrained('products')->onDelete('restrict');

            // Detail produk saat dibeli (jika harga produk berubah di masa depan, detail ini tetap)
            $table->integer('quantity');
            $table->decimal('price_per_item', 10, 2); // Harga saat produk itu dibeli
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
