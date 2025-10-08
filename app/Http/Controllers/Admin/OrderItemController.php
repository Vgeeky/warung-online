<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function index()
    {
        $items = OrderItem::with(['order.user', 'product'])->latest()->get();
        return view('admin.order_items.index', compact('items'));
    }

    public function create()
    {
        $orders = Order::with('user')->get();
        $products = Product::all();
        return view('admin.order_items.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            $item = OrderItem::create($validated);
            $this->updateOrderTotal($item->order_id);
        });

        return redirect()->route('admin.order_items.index')->with('success', 'Item order berhasil ditambahkan.');
    }

    public function edit(OrderItem $order_item)
    {
        $orders = Order::with('user')->get();
        $products = Product::all();
        return view('admin.order_items.edit', compact('order_item', 'orders', 'products'));
    }

    public function update(Request $request, OrderItem $order_item)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($order_item, $validated) {
            $order_item->update($validated);
            $this->updateOrderTotal($order_item->order_id);
        });

        return redirect()->route('admin.order_items.index')->with('success', 'Item order berhasil diperbarui.');
    }

    public function destroy(OrderItem $order_item)
    {
        DB::transaction(function () use ($order_item) {
            $orderId = $order_item->order_id;
            $order_item->delete();
            $this->updateOrderTotal($orderId);
        });

        return redirect()->route('admin.order_items.index')->with('success', 'Item order berhasil dihapus.');
    }

    private function updateOrderTotal($orderId)
    {
        $total = OrderItem::where('order_id', $orderId)
            ->selectRaw('COALESCE(SUM(quantity * price), 0) AS total')
            ->value('total');

        Order::where('id', $orderId)->update(['total_amount' => $total]);
    }
}
