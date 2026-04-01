@php($title = 'Products')
@php($breadcrumbs = 'Home / Products')
@extends('layouts.store')

@section('content')
  <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <h1 class="text-xl font-semibold tracking-tight" data-i18n="products.title">Products</h1>
      <p class="mt-1 text-sm text-zinc-600" data-i18n="products.sub">Live data from the database. Filter by category or search by name.</p>
    </div>
    <div class="flex flex-wrap gap-2">
      <a href="{{ url('/categories') }}" class="inline-flex items-center rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm font-semibold hover:bg-zinc-50" data-i18n="nav.categories">Categories</a>
      <a href="{{ url('/cart') }}" class="inline-flex items-center rounded-xl bg-zinc-950 px-3 py-2 text-sm font-semibold text-white hover:bg-zinc-900" data-i18n="products.go_cart">Go to cart</a>
    </div>
  </div>

  <form method="get" action="{{ url('/products') }}" class="mt-4 flex flex-col gap-2 sm:flex-row sm:flex-wrap sm:items-end">
    <div class="flex-1 min-w-[200px]">
      <label class="text-xs font-semibold text-zinc-500" data-i18n="products.search_label">Search</label>
      <input name="q" value="{{ $q }}" data-i18n-placeholder="products.search_ph" placeholder="Search by name…" class="mt-1 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
    </div>
    <div class="w-full sm:w-56">
      <label class="text-xs font-semibold text-zinc-500" data-i18n="products.cat_label">Category</label>
      <select name="category" onchange="this.form.submit()" class="mt-1 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400">
        <option value="" data-i18n="products.cat_all">All categories</option>
        @foreach ($categories as $cat)
          <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="h-11 rounded-xl bg-zinc-950 px-4 text-sm font-semibold text-white hover:bg-zinc-900 sm:mb-px" data-i18n="products.apply">
      Apply
    </button>
  </form>

  @if($q !== '')
    <div class="mt-4 rounded-2xl border border-zinc-200 bg-zinc-50 p-4 text-sm">
      <span data-i18n="products.results_for">Results for</span>
      <span class="font-semibold">“{{ $q }}”</span>
      <span data-i18n="products.results_sep">—</span>
      {{ $products->count() }}
      <span data-i18n="products.results_items">item(s).</span>
    </div>
  @endif

  <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
    @forelse ($products as $p)
      <a href="{{ url('/products/'.$p->id) }}" class="group rounded-2xl border border-zinc-200 bg-white p-3 hover:border-zinc-300">
        <div class="relative aspect-4/3 w-full overflow-hidden rounded-xl bg-zinc-100 group-hover:bg-zinc-200 transition">
          @if($p->badge)
            <div class="absolute left-2 top-2 z-10 rounded-lg bg-zinc-950 px-2 py-1 text-[11px] font-semibold text-white">
              {{ $p->badge }}
            </div>
          @endif
          @if($p->imageUrl())
            <img src="{{ $p->imageUrl() }}" alt="" class="h-full w-full object-cover" />
          @endif
        </div>
        <div class="mt-2 text-sm font-semibold leading-tight line-clamp-2">{{ $p->name }}</div>
        <div class="mt-1 text-xs text-zinc-500">{{ number_format($p->price_mmk) }} MMK</div>
      </a>
    @empty
      <p class="col-span-full rounded-2xl border border-zinc-200 bg-zinc-50 p-6 text-sm text-zinc-600" data-i18n="products.empty_html" data-i18n-html></p>
    @endforelse
  </div>
@endsection
