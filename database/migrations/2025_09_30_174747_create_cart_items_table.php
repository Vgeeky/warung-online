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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            // 1. Menghubungkan ke Pengguna (Siapa pemilik keranjang)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); // Jika user dihapus, keranjangnya juga dihapus

            // 2. Menghubungkan ke Produk (Produk apa yang ada di keranjang)
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade'); // Jika produk dihapus, item keranjang dihapus

            // 3. Jumlah Produk
            $table->integer('quantity')->default(1);

            // 4. Kunci unik gabungan (agar satu produk tidak duplikat dalam satu keranjang user)
            $table->unique(['user_id', 'product_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
