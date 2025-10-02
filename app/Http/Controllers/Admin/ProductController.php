<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:100',
            'description'=>'nullable|string',
            'price'=>'required|numeric',
            'stock'=>'required|integer',
            'image'=>'nullable|image|max:2048',
            'category_id'=>'nullable|exists:categories,id',
        ]);

        $data = $request->all();

        if($request->hasFile('image')){
            $data['image_url'] = $request->file('image')->store('products','public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success','Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required|string|max:100',
            'description'=>'nullable|string',
            'price'=>'required|numeric',
            'stock'=>'required|integer',
            'image'=>'nullable|image|max:2048',
            'category_id'=>'nullable|exists:categories,id',
        ]);

        $data = $request->all();

        if($request->hasFile('image')){
            if($product->image_url){
                Storage::disk('public')->delete($product->image_url);
            }
            $data['image_url'] = $request->file('image')->store('products','public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success','Product updated.');
    }

    public function destroy(Product $product)
    {
        if($product->image_url){
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success','Product deleted.');
    }
}
