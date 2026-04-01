<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $categories = Category::query()->orderBy('sort_order')->orderBy('name')->take(6)->get();
        $products = Product::query()->active()->with(['category', 'images'])->orderBy('sort_order')->orderByDesc('id')->take(8)->get();

        return view('store.home', compact('categories', 'products'));
    }
}
