@php($title = $category->name)
@php($breadcrumbs = 'Home / Categories / '.$category->name)
@extends('layouts.store')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div class="flex gap-4 min-w-0">
      @if($category->imageUrl())
        <img src="{{ $category->imageUrl() }}" alt="" class="hidden sm:block h-24 w-32 shrink-0 rounded-2xl object-cover bg-zinc-100 ring-1 ring-zinc-200" />
      @endif
      <div class="min-w-0">
        <h1 class="text-xl font-semibold tracking-tight">{{ $category->name }}</h1>
        @if($category->description)
          <p class="mt-1 text-sm text-zinc-600">{{ $category->description }}</p>
        @else
          <p class="mt-1 text-sm text-zinc-600" data-i18n="cat_show.fallback_desc">Products in this category from your catalog.</p>
        @endif
      </div>
    </div>
    <a href="{{ url('/categories') }}" class="shrink-0 text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="cat_show.all_link">All categories</a>
  </div>

  <div class="mt-4 rounded-2xl border border-zinc-200 bg-zinc-50 p-4">
    <div class="text-sm font-semibold" data-i18n="cat_show.products">Products</div>
    <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
      @forelse ($products as $p)
        <a href="{{ url('/products/'.$p->id) }}" class="rounded-2xl bg-white p-3 ring-1 ring-zinc-200 hover:ring-zinc-300">
          @if($p->imageUrl())
            <div class="aspect-4/3 w-full overflow-hidden rounded-xl bg-zinc-100">
              <img src="{{ $p->imageUrl() }}" alt="" class="h-full w-full object-cover" />
            </div>
          @else
            <div class="aspect-4/3 rounded-xl bg-zinc-100"></div>
          @endif
          <div class="mt-2 text-sm font-semibold leading-tight line-clamp-2">{{ $p->name }}</div>
          <div class="mt-1 text-xs text-zinc-500">{{ number_format($p->price_mmk) }} MMK</div>
        </a>
      @empty
        <p class="col-span-full text-sm text-zinc-600" data-i18n="cat_show.empty">No active products in this category yet.</p>
      @endforelse
    </div>
  </div>
@endsection
