<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;

class UserController extends Controller
{
    /**
     * Dashboard user — menampilkan produk singkat.
     */
    public function dashboard()
    {
        $products = class_exists(Product::class)
            ? Product::latest()->take(6)->get()
            : DB::table('products')->latest()->take(6)->get();

        return view('user.dashboard', compact('products'));
    }

    /**
     * Halaman semua produk (lihat semua produk dari admin)
     */
    public function products()
    {
        $products = class_exists(Product::class)
            ? Product::all()
            : DB::table('products')->get();

        return view('user.products', compact('products'));
    }

    /**
     * Halaman pesanan user
     */
    public function orders()
    {
        if (class_exists(Order::class)) {
            $orders = Order::where('user_id', auth()->id())->get();
        } else {
            $orders = DB::table('orders')->where('user_id', auth()->id())->get();
        }

        return view('user.orders', compact('orders'));
    }

    /**
     * Halaman wishlist user
     */
    public function wishlist()
    {
        $wishlist = session('wishlist', []);
        return view('user.wishlist', compact('wishlist'));
    }

    public function addToWishlist($id)
    {
        $wishlist = session('wishlist', []);
        if (!in_array($id, $wishlist)) {
            $wishlist[] = $id;
        }
        session(['wishlist' => $wishlist]);
        return back()->with('success', 'Produk ditambahkan ke wishlist.');
    }

    public function removeFromWishlist($id)
    {
        $wishlist = session('wishlist', []);
        $wishlist = array_diff($wishlist, [$id]);
        session(['wishlist' => $wishlist]);
        return back()->with('success', 'Produk dihapus dari wishlist.');
    }

    /**
     * Halaman keranjang user
     */
    public function cart()
    {
        $cart = session('cart', []);
        return view('user.cart', compact('cart'));
    }

    public function addToCart($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                'product_id' => $id,
                'quantity' => 1,
            ];
        }
        session(['cart' => $cart]);
        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function updateCartQuantity(Request $request, $id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }
        session(['cart' => $cart]);
        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // Contoh penyimpanan order ke database jika ada tabel orders
        if (class_exists(Order::class)) {
            Order::create([
                'user_id' => auth()->id(),
                'total' => 0, // hitung total harga di sini kalau mau
                'status' => 'pending',
            ]);
        }

        session()->forget('cart');
        return redirect()->route('user.orders')->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Halaman profil user
     */
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }
}
