@php($title = 'Dashboard')
@php($subtitle = 'Overview')
@extends('layouts.admin')

@section('content')
  <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
    <div class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="text-xs text-zinc-500">Categories</div>
      <div class="mt-2 text-lg font-semibold tracking-tight">{{ $categoryCount }}</div>
      <div class="mt-1 text-xs text-zinc-500">In database</div>
    </div>
    <div class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="text-xs text-zinc-500">Products</div>
      <div class="mt-2 text-lg font-semibold tracking-tight">{{ $productCount }}</div>
      <div class="mt-1 text-xs text-zinc-500">Total rows</div>
    </div>
    <div class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="text-xs text-zinc-500">Active on storefront</div>
      <div class="mt-2 text-lg font-semibold tracking-tight">{{ $activeProductCount }}</div>
      <div class="mt-1 text-xs text-zinc-500">Visible to shoppers</div>
    </div>
    <div class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="text-xs text-zinc-500">Orders</div>
      <div class="mt-2 text-lg font-semibold tracking-tight">—</div>
      <div class="mt-1 text-xs text-zinc-500">Wire when you add order persistence</div>
    </div>
  </div>

  <div class="mt-4 grid gap-3 lg:grid-cols-3">
    <section class="lg:col-span-2 rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="flex items-center justify-between gap-3">
        <div>
          <div class="text-sm font-semibold">Quick actions</div>
          <div class="mt-1 text-xs text-zinc-500">Categories and products are full CRUD + image uploads</div>
        </div>
      </div>
      <div class="mt-3 grid gap-2 sm:grid-cols-2">
        <a class="rounded-xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold hover:bg-zinc-50" href="{{ route('admin.products.create') }}">Add product</a>
        <a class="rounded-xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold hover:bg-zinc-50" href="{{ route('admin.categories.create') }}">Add category</a>
        <a class="rounded-xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold hover:bg-zinc-50" href="{{ url('/admin/products') }}">All products</a>
        <a class="rounded-xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold hover:bg-zinc-50" href="{{ url('/admin/categories') }}">All categories</a>
      </div>
    </section>

    <section class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="text-sm font-semibold">Storefront</div>
      <div class="mt-3 rounded-2xl border border-zinc-200 bg-zinc-50 p-4 text-sm text-zinc-700">
        Images save under <code class="rounded bg-zinc-200 px-1">public/uploads/</code> (no symlink). Use <code class="rounded bg-zinc-200 px-1">php artisan db:seed --class=CatalogSeeder</code> to refresh demo catalog rows.
      </div>
      <a class="mt-3 inline-flex w-full items-center justify-center rounded-xl bg-zinc-950 px-4 py-3 text-sm font-semibold text-white hover:bg-zinc-900" href="{{ url('/') }}">
        View storefront
      </a>
    </section>
  </div>
@endsection
