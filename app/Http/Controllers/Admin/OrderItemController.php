<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $items = OrderItem::with(['order', 'product'])->latest()->get(); // urutkan terbaru dulu
        return view('admin.order_items.index', compact('items'));
    }

    public function create()
    {
        $orders = Order::all();
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

        OrderItem::create($validated);

        return redirect()
            ->route('admin.order_items.index')
            ->with('success', 'Order item created successfully');
    }

    public function edit(OrderItem $order_item)
    {
        $orders = Order::all();
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

        $order_item->update($validated);

        return redirect()
            ->route('admin.order_items.index')
            ->with('success', 'Order item updated successfully');
    }

    public function destroy(OrderItem $order_item)
    {
        $order_item->delete();

        return redirect()
            ->route('admin.order_items.index')
            ->with('success', 'Order item deleted successfully');
    }
}
