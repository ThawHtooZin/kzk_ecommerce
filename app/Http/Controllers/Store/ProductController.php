<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $categoryId = $request->query('category');

        $products = Product::query()
            ->active()
            ->with(['category', 'images'])
            ->when($q !== '', fn ($qb) => $qb->where('name', 'like', '%'.$q.'%'))
            ->when($categoryId !== null && $categoryId !== '' && is_numeric($categoryId), fn ($qb) => $qb->where('category_id', (int) $categoryId))
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $categories = Category::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('store.products.index', compact('products', 'categories', 'q'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load(['category', 'images']);

        return view('store.products.show', compact('product'));
    }
}
