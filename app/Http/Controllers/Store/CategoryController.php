<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('store.categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $products = Product::query()
            ->active()
            ->where('category_id', $category->id)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('store.categories.show', compact('category', 'products'));
    }
}
