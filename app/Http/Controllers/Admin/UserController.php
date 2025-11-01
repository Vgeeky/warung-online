<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class UserController extends Controller
{
    /**
     * Menampilkan halaman keranjang.
     */
    public function cart()
    {
        $cart = session('cart', []);
        return view('user.cart', compact('cart'));
    }

    /**
     * Menambahkan produk ke keranjang.
     */
    public function addToCart(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->input('quantity', 1),
                'image' => $product->image_url ?? $product->image ?? null,
            ];
        }

        session(['cart' => $cart]);
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Proses checkout — membuat pesanan baru dari isi keranjang.
     */
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // Hitung total harga
        $total = collect($cart)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 0));

        // Simpan ke tabel orders
        $order = Order::create([
    'user_id' => auth()->id(),
    'total_price' => $total, // ✅ ganti dari 'total' jadi 'total_price'
    'status' => 'pending',
    'shipping_address' => $request->input('shipping_address', 'Alamat belum diisi'),
    'city' => $request->input('city', 'Kota belum diisi'),
    'postal_code' => $request->input('postal_code', '00000'),
]);


        // Simpan detail item ke order_items (jika tabel dan model tersedia)
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'] ?? null,
                'quantity' => $item['quantity'] ?? 1,
                'price' => $item['price'] ?? 0,
            ]);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        return redirect()->route('user.orders')->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Menampilkan daftar pesanan pengguna.
     */
    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('user.orders', compact('orders'));
    }
}
