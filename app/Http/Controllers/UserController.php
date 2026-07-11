<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

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
     * Halaman semua produk
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
        if (!auth()->check()) {
            return redirect('/')->with('error', 'Silakan login untuk melihat pesanan.');
        }

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

    /**
     * Tambah produk ke cart
     */
    public function addToCart(Request $request, $id)
    {
        $cart = session('cart', []);

        $product = Product::find($id);

        if (!$product) {

            return back()->with('error', 'Produk tidak ditemukan.');

        }

        $quantity = $request->quantity ?? 1;

        // FIX PATH GAMBAR
        $imagePath = asset('storage/' . $product->image_url);

        if (isset($cart[$id])) {

            $cart[$id]['quantity'] += $quantity;

        } else {

            $cart[$id] = [

                'id' => $product->id,

                'name' => $product->name,

                'price' => $product->price,

                'image' => $imagePath,

                'quantity' => $quantity,

            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    /**
     * Hapus produk dari cart
     */
    public function removeFromCart($id)
    {
        $cart = session('cart', []);

        unset($cart[$id]);

        session(['cart' => $cart]);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    /**
     * Update quantity cart
     */
    public function updateCartQuantity(Request $request, $id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    /**
     * Checkout
     */
    public function checkout(Request $request)
    {
        // VALIDASI
        $request->validate([
            'customer_name' => 'required',
            'table_number' => 'required',
        ]);

        // AMBIL CART
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        // HITUNG TOTAL
        $total = 0;

        foreach ($cart as $item) {

            $total += $item['price'] * $item['quantity'];

        }

        // SIMPAN ORDER KE DATABASE
        $order = new Order();

        $order->user_id = auth()->check() ? auth()->id() : null;

        $order->customer_name = $request->customer_name;

        $order->table_number = $request->table_number;

        $order->total_price = $total;

        $order->status = 'pending';

        $order->shipping_address = 'Kantin';

        $order->city = 'Bandung';

        $order->postal_code = '00000';

        $order->save();

        // MIDTRANS CONFIG
        Config::$serverKey = config('midtrans.server_key');

        Config::$isProduction = config('midtrans.is_production');

        Config::$isSanitized = true;

        Config::$is3ds = true;

        // MIDTRANS PARAM
        $params = [

            'transaction_details' => [

                'order_id' => 'ORDER-' . $order->id,

                'gross_amount' => $total,

            ],

            'customer_details' => [

                'first_name' => $request->customer_name,

            ],

        ];

        // SNAP TOKEN
        $snapToken = Snap::getSnapToken($params);

        // HAPUS CART
        session()->forget('cart');

        // TAMPILKAN PAYMENT
        return view('user.payment', compact('snapToken', 'order'));
    }

    /**
     * Konfirmasi pembayaran
     */
    public function confirmPayment($id)
    {
        if (!auth()->check()) {
            return redirect('/');
        }

        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'waiting_confirmation'
        ]);

        return redirect()->route('user.orders')
            ->with('success', 'Pembayaran dikonfirmasi.');
    }

    /**
     * Halaman profil user
     */
    public function profile()
    {
        if (!auth()->check()) {
            return redirect('/');
        }

        $user = auth()->user();

        return view('user.profile', compact('user'));
    
    }
    public function history()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.history', compact('orders'));
    }

    public function orderAgain($id)
    {
        $products = \App\Models\Product::all();

        $cart = [];

        foreach ($products as $product) {

            $cart[$product->id] = [

                'id' => $product->id,

                'name' => $product->name,

                'price' => $product->price,

                'quantity' => 1,

                // INI FIX GAMBAR
                'image' => asset('storage/'.$product->image_url),

            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('user.cart')
            ->with('success', 'Pesanan berhasil dimasukkan lagi ke keranjang!');
    }
}