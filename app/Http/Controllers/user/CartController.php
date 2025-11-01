<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // 🛒 Menampilkan isi keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.cart', compact('cart'));
    }

    // ➕ Tambah produk ke keranjang
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += (int)$request->input('quantity', 1);
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => (int)$request->input('quantity', 1),
                'image' => $product->image ?? null,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // ❌ Hapus produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return back()->with('success', 'Produk dihapus dari keranjang.');
        }
        return back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    // 💳 Checkout sederhana
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        // Tambahkan logika penyimpanan transaksi di sini (opsional)
        session()->forget('cart');
        return redirect()->route('user.dashboard')->with('success', 'Checkout berhasil!');
    }
}
