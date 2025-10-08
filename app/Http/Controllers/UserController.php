<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function dashboard()
    {
        $products = Product::latest()->get();
        return view('user.dashboard', compact('products'));
    }

    // ================= CART =================
    public function cart()
    {
        $cart = Session::get('cart', []);
        return view('user.cart', compact('cart'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1); // default 1

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => $quantity
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('user.cart')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->route('user.cart')->with('success', 'Produk dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('user.cart')->with('error', 'Keranjang masih kosong!');
        }

        // Simpan pesanan ke session (dummy)
        $orders = Session::get('orders', []);
        $orders[] = [
            'id' => uniqid(),
            'items' => $cart,
            'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'date' => now()->format('d-m-Y H:i')
        ];
        Session::put('orders', $orders);

        // Kosongkan keranjang
        Session::forget('cart');

        return redirect()->route('user.orders')->with('success', 'Pesanan berhasil dibuat!');
    }

    // ================= WISHLIST =================
    public function wishlist()
    {
        $wishlist = Session::get('wishlist', []);
        return view('user.wishlist', compact('wishlist'));
    }

    public function addToWishlist($id)
    {
        $product = Product::findOrFail($id);
        $wishlist = Session::get('wishlist', []);
        $wishlist[$id] = [
            "id" => $product->id,
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image,
        ];

        Session::put('wishlist', $wishlist);
        return redirect()->route('user.wishlist')->with('success', 'Produk ditambahkan ke wishlist!');
    }

    public function removeFromWishlist($id)
    {
        $wishlist = Session::get('wishlist', []);
        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            Session::put('wishlist', $wishlist);
        }
        return redirect()->route('user.wishlist')->with('success', 'Produk dihapus dari wishlist!');
    }

    // ================= ORDERS =================
    public function orders()
    {
        $orders = Session::get('orders', []);
        return view('user.orders', compact('orders'));
    }
}
