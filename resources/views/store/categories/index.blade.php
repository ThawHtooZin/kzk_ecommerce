@php($title = 'Categories')
@php($breadcrumbs = 'Home / Categories')
@extends('layouts.store')

@section('content')
  <div class="flex items-end justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight" data-i18n="categories.heading">Product categories</h1>
      <p class="mt-1 text-sm text-zinc-600" data-i18n="categories.lead">From the database — upload images in Admin.</p>
    </div>
    <a href="{{ url('/products') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="categories.browse_prod">Browse products</a>
  </div>

  <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
    @forelse ($categories as $cat)
      <a href="{{ url('/categories/'.$cat->id) }}" class="group rounded-2xl bg-white p-3 ring-1 ring-zinc-200 hover:ring-zinc-300">
        @if($cat->imageUrl())
          <div class="relative aspect-4/3 w-full overflow-hidden rounded-xl bg-zinc-100 group-hover:opacity-95 transition">
            <img src="{{ $cat->imageUrl() }}" alt="" class="h-full w-full object-cover" />
          </div>
        @else
          <div class="aspect-4/3 rounded-xl bg-zinc-100 group-hover:bg-zinc-200 transition"></div>
        @endif
        <div class="mt-2 text-sm font-semibold leading-tight">{{ $cat->name }}</div>
        <div class="mt-1 text-xs text-zinc-500" data-i18n="categories.view">View category</div>
      </a>
    @empty
      <p class="col-span-full rounded-2xl border border-zinc-200 bg-zinc-50 p-6 text-sm text-zinc-600" data-i18n="categories.empty_html" data-i18n-html></p>
    @endforelse
  </div>
@endsection
