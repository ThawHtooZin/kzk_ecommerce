<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Support\PublicImageStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->with('category')->orderBy('sort_order')->orderByDesc('id')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price_mmk' => ['required', 'integer', 'min:0'],
            'badge' => ['nullable', 'string', 'max:64'],
            'size_options' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $slug = $this->resolveProductSlug($validated['slug'] ?? null, $validated['name']);

        $path = null;
        if ($request->hasFile('image')) {
            $path = PublicImageStorage::store($request->file('image'), 'products');
        }

        Product::query()->create([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'price_mmk' => $validated['price_mmk'],
            'badge' => $validated['badge'] ?? null,
            'size_options' => $this->parseSizeOptions($validated['size_options'] ?? null),
            'image_path' => $path,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.products.index')->with('status', 'Product created.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price_mmk' => ['required', 'integer', 'min:0'],
            'badge' => ['nullable', 'string', 'max:64'],
            'size_options' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $slug = $this->resolveProductSlug($validated['slug'] ?? null, $validated['name'], $product->id);

        if (! empty($validated['remove_image']) && $product->image_path) {
            PublicImageStorage::delete($product->image_path);
            $product->image_path = null;
        }

        if ($request->hasFile('image')) {
            PublicImageStorage::delete($product->image_path);
            $product->image_path = PublicImageStorage::store($request->file('image'), 'products');
        }

        $product->fill([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'price_mmk' => $validated['price_mmk'],
            'badge' => $validated['badge'] ?? null,
            'size_options' => $this->parseSizeOptions($validated['size_options'] ?? null),
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);
        $product->save();

        return redirect()->route('admin.products.index')->with('status', 'Product updated.');
    }

    public function delete(Product $product): View
    {
        return view('admin.products.delete', compact('product'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        PublicImageStorage::delete($product->image_path);
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Product deleted.');
    }

    private function resolveProductSlug(?string $slugInput, string $name, ?int $exceptId = null): string
    {
        $base = $slugInput !== null && $slugInput !== '' ? Str::slug($slugInput) : Str::slug($name);
        $slug = $base;
        $i = 1;
        while (Product::query()->where('slug', $slug)->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    /** @return list<string>|null */
    private function parseSizeOptions(?string $raw): ?array
    {
        if ($raw === null || trim($raw) === '') {
            return null;
        }

        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }
}
