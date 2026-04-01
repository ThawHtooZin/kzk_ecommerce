<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Support\PublicImageStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $slug = $this->resolveCategorySlug($validated['slug'] ?? null, $validated['name']);

        $path = null;
        if ($request->hasFile('image')) {
            $path = PublicImageStorage::store($request->file('image'), 'categories');
        }

        Category::query()->create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'image_path' => $path,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.categories.index')->with('status', 'Category created.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $slug = $this->resolveCategorySlug($validated['slug'] ?? null, $validated['name'], $category->id);

        if (! empty($validated['remove_image']) && $category->image_path) {
            PublicImageStorage::delete($category->image_path);
            $category->image_path = null;
        }

        if ($request->hasFile('image')) {
            PublicImageStorage::delete($category->image_path);
            $category->image_path = PublicImageStorage::store($request->file('image'), 'categories');
        }

        $category->fill([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);
        $category->save();

        return redirect()->route('admin.categories.index')->with('status', 'Category updated.');
    }

    public function delete(Category $category): View
    {
        return view('admin.categories.delete', compact('category'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        PublicImageStorage::delete($category->image_path);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category deleted.');
    }

    private function resolveCategorySlug(?string $slugInput, string $name, ?int $exceptId = null): string
    {
        $base = $slugInput !== null && $slugInput !== '' ? Str::slug($slugInput) : Str::slug($name);
        $slug = $base;
        $i = 1;
        while (Category::query()->where('slug', $slug)->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
