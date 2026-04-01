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
      @if($product->imageUrl())
        <div class="flex items-center gap-3 rounded-xl border border-zinc-200 p-3">
          <img src="{{ $product->imageUrl() }}" alt="" class="h-16 w-24 rounded-lg object-cover" />
          <label class="flex items-center gap-2 text-sm text-zinc-700">
            <input type="checkbox" name="remove_image" value="1" class="rounded border-zinc-300" />
            Remove image
          </label>
        </div>
      @endif
      <div>
        <label class="text-sm font-semibold" for="image">{{ $product->image_path ? 'Replace image' : 'Image' }}</label>
        <input id="image" name="image" type="file" accept="image/*" class="mt-2 block w-full text-sm text-zinc-600 file:mr-3 file:rounded-xl file:border-0 file:bg-zinc-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white" />
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
