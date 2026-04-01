@php($title = 'Products')
@php($subtitle = 'Product management')
@extends('layouts.admin')

@section('content')
  <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Products</h1>
      <p class="mt-1 text-sm text-zinc-600">Full CRUD with images, pricing (MMK), category, and visibility.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-4 py-2 text-sm font-semibold text-zinc-950 ring-1 ring-zinc-200 hover:bg-zinc-50">
      Add product
    </a>
  </div>

  <div class="mt-4 overflow-hidden rounded-2xl border border-zinc-200 bg-white">
    <div class="px-4 py-3 border-b border-zinc-200 text-sm font-semibold">All products</div>
    @if($products->isEmpty())
      <div class="px-4 py-10 text-center text-sm text-zinc-600">No products yet. Add one to show on the storefront.</div>
    @else
      <div class="divide-y divide-zinc-200">
        @foreach ($products as $p)
          <div class="px-4 py-3 flex items-center gap-3">
            @if($p->imageUrl())
              <img src="{{ $p->imageUrl() }}" alt="" class="h-12 w-16 shrink-0 rounded-xl object-cover bg-zinc-100" />
            @else
              <div class="h-12 w-16 shrink-0 rounded-xl bg-zinc-100"></div>
            @endif
            <div class="min-w-0 flex-1">
              <div class="truncate text-sm font-semibold">{{ $p->name }}</div>
              <div class="mt-0.5 text-xs text-zinc-500">
                #{{ $p->id }} · {{ number_format($p->price_mmk) }} MMK
                @if($p->category)
                  · {{ $p->category->name }}
                @endif
              </div>
            </div>
            <span class="hidden sm:inline-flex rounded-full px-2 py-1 text-xs font-semibold {{ $p->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-200 text-zinc-700' }}">
              {{ $p->is_active ? 'Active' : 'Hidden' }}
            </span>
            <div class="flex flex-wrap items-center gap-2">
              <a class="rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm font-semibold hover:bg-zinc-50" href="{{ route('admin.products.edit', $p) }}">Edit</a>
              <a class="rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm font-semibold hover:bg-zinc-50" href="{{ route('admin.products.delete', $p) }}">Delete</a>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
