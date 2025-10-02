<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::where('role','user')->count();
        $totalOrders = 0;

        return view('admin.dashboard', compact('totalProducts','totalCategories','totalUsers','totalOrders'));
    }
}
