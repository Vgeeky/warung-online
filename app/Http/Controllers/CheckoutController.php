<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

class CheckoutController extends Controller
{
    // ======================================
    // HALAMAN CHECKOUT
    // ======================================
    public function showCheckoutPage()
    {
        // CONFIG MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // AMBIL CART
        $cart = session()->get('cart', []);

        // HITUNG TOTAL
        $total = 0;

        foreach ($cart as $item) {

            $total += $item['price'] * $item['quantity'];

        }

        // JIKA KOSONG
        if ($total <= 0) {

            return redirect()
                ->route('dashboard')
                ->with('error', 'Keranjang kosong.');

        }

        return view('user.checkout', compact('total'));
    }

    // ======================================
    // SIMPAN ORDER
    // ======================================
    public function saveOrderData(Request $request)
    {
        try {

            // VALIDASI
            $request->validate([

                'customer_name' => 'required',

                'table_number' => 'required',

            ]);

            // AMBIL CART
            $cart = session()->get('cart', []);

            // HITUNG TOTAL
            $total = 0;

            foreach ($cart as $item) {

                $total += $item['price'] * $item['quantity'];

            }

            // CEK CART KOSONG
            if ($total <= 0) {

                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang kosong.'
                ], 400);

            }

            // ======================================
            // SIMPAN ORDER KE DATABASE
            // ======================================
            $order = new Order();

            $order->user_id = auth()->id();

            $order->customer_name = $request->customer_name;

            $order->table_number = $request->table_number;

            $order->total_price = $total;

            $order->status = 'pending';

            $order->shipping_address = 'Kantin';

            $order->city = 'Bandung';

            $order->postal_code = '00000';

            $order->save();

            // ======================================
            // CONFIG MIDTRANS
            // ======================================
            Config::$serverKey = config('midtrans.server_key');
            Config::$clientKey = config('midtrans.client_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // ======================================
            // PARAMETER MIDTRANS
            // ======================================
            $params = [

                'transaction_details' => [

                    'order_id' => (string) $order->id,

                    'gross_amount' => (int) $total,

                ],

            ];

            // ======================================
            // BUAT SNAP TOKEN
            // ======================================
            $snapToken = Snap::getSnapToken($params);

            // ======================================
            // RESPONSE JSON
            // ======================================
            return response()->json([

                'success' => true,

                'snap_token' => $snapToken,

                'order_id' => $order->id,

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage(),

                'line' => $e->getLine(),

                'file' => $e->getFile(),

            ], 500);

        }
    }
}