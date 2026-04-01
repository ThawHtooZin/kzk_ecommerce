@php($title = 'Products')
@php($subtitle = 'Edit '.$product->name)
@extends('layouts.admin')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Edit product</h1>
      <p class="mt-1 text-sm text-zinc-600">{{ $product->name }} (#{{ $product->id }})</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950">Back</a>
  </div>

  <form method="post" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="mt-4 grid gap-3 lg:grid-cols-3">
    @csrf
    @method('PUT')
    <section class="lg:col-span-2 rounded-2xl border border-zinc-200 bg-white p-4 space-y-3">
      <div>
        <label class="text-sm font-semibold" for="name">Product name</label>
        <input id="name" name="name" value="{{ old('name', $product->name) }}" required class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="slug">Slug</label>
        <input id="slug" name="slug" value="{{ old('slug', $product->slug) }}" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="category_id">Category</label>
        <select id="category_id" name="category_id" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400">
          <option value="">— None —</option>
          @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="grid gap-3 sm:grid-cols-2">
        <div>
          <label class="text-sm font-semibold" for="price_mmk">Price (MMK)</label>
          <input id="price_mmk" name="price_mmk" type="number" min="0" step="1" value="{{ old('price_mmk', $product->price_mmk) }}" required class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
        </div>
        <div>
          <label class="text-sm font-semibold" for="badge">Badge</label>
          <input id="badge" name="badge" value="{{ old('badge', $product->badge) }}" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
        </div>
      </div>
      <div class="grid gap-3 sm:grid-cols-2">
        <div>
          <label class="text-sm font-semibold" for="sort_order">Sort order</label>
          <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $product->sort_order) }}" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
        </div>
        <div class="flex items-end pb-1">
          <label class="flex items-center gap-2 text-sm font-semibold text-zinc-700">
            <input type="hidden" name="is_active" value="0" />
            <input type="checkbox" name="is_active" value="1" class="rounded border-zinc-300" @checked(old('is_active', $product->is_active)) />
            Visible on storefront
          </label>
        </div>
      </div>
      <div>
        <label class="text-sm font-semibold" for="size_options">Size options</label>
        <input id="size_options" name="size_options" value="{{ old('size_options', is_array($product->size_options) ? implode(', ', $product->size_options) : '') }}" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" placeholder="39, 40, 41, 42" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="description">Description</label>
        <textarea id="description" name="description" rows="4" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm outline-none focus:border-zinc-400">{{ old('description', $product->description) }}</textarea>
      </div>
      @if($product->images->isNotEmpty())
        @php($defaultPrimaryId = $product->images->firstWhere('is_primary')?->id ?? $product->images->first()?->id)
        <div class="rounded-xl border border-zinc-200 p-3">
          <div class="text-sm font-semibold">Product images</div>
          <p class="mt-1 text-xs text-zinc-500">
            <strong>Position</strong> = swipe order on the product page (1, 2, 3…). <strong>Main</strong> = thumbnail in product grids and cart (pick one).
          </p>
          <div class="mt-3 space-y-2">
            @foreach ($product->images as $g)
              <div class="flex flex-wrap items-center gap-3 rounded-lg border border-zinc-100 bg-zinc-50 p-3">
                <img src="{{ $g->url() }}" alt="" class="h-16 w-20 shrink-0 rounded-md object-cover" />
                <div class="flex flex-wrap items-center gap-4 text-sm">
                  <label class="flex items-center gap-2">
                    <span class="text-xs font-semibold text-zinc-500">Position</span>
                    <input type="number" name="gallery_position[{{ $g->id }}]" min="1" max="999" value="{{ old('gallery_position.'.$g->id, $g->sort_order) }}" class="h-9 w-16 rounded-lg border border-zinc-200 bg-white px-2 text-center text-sm" />
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="primary_image_id" value="{{ $g->id }}" class="border-zinc-300" @checked((int) old('primary_image_id', $defaultPrimaryId) === (int) $g->id) />
                    <span class="text-xs font-semibold text-zinc-700">Main image</span>
                  </label>
                </div>
                <label class="ml-auto flex items-center gap-2 text-xs text-zinc-600">
                  <input type="checkbox" name="remove_gallery_ids[]" value="{{ $g->id }}" class="rounded border-zinc-300" />
                  Remove
                </label>
              </div>
            @endforeach
          </div>
        </div>
      @endif
      @if($product->image_path)
        <div class="flex items-center gap-3 rounded-xl border border-zinc-200 p-3">
          <img src="{{ \App\Support\PublicImageStorage::publicUrl($product->image_path) }}" alt="" class="h-16 w-24 rounded-lg object-cover" />
          <div class="text-sm text-zinc-700">
            <div class="font-semibold">Legacy cover image</div>
            <label class="mt-1 flex items-center gap-2 text-xs">
              <input type="checkbox" name="remove_image" value="1" class="rounded border-zinc-300" />
              Remove (used when gallery is empty)
            </label>
          </div>
        </div>
      @endif
      <div>
        <label class="text-sm font-semibold" for="image">Replace / add cover image</label>
        <p class="mt-1 text-xs text-zinc-500">Stored as fallback when no gallery images exist.</p>
        <input id="image" name="image" type="file" accept="image/*" class="mt-2 block w-full text-sm text-zinc-600 file:mr-3 file:rounded-xl file:border-0 file:bg-zinc-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="gallery_images">Add gallery images</label>
        <p class="mt-1 text-xs text-zinc-500">Select multiple new files to append to the gallery.</p>
        <input id="gallery_images" name="gallery_images[]" type="file" accept="image/*" multiple class="mt-2 block w-full text-sm text-zinc-600 file:mr-3 file:rounded-xl file:border-0 file:bg-zinc-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white" />
      </div>
    </section>
    <aside class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 h-fit space-y-3">
      <div class="text-sm font-semibold">Actions</div>
      <button type="submit" class="w-full rounded-xl bg-zinc-950 px-4 py-3 text-sm font-semibold text-white hover:bg-zinc-900">
        Save product
      </button>
      <a href="{{ route('admin.products.delete', $product) }}" class="inline-flex w-full items-center justify-center rounded-xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold text-zinc-950 hover:bg-zinc-50">
        Delete
      </a>
    </aside>
  </form>
@endsection
