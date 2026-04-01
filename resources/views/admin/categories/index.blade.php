@php($title = 'Categories')
@php($subtitle = 'Category management')
@extends('layouts.admin')

@section('content')
  <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Categories</h1>
      <p class="mt-1 text-sm text-zinc-600">Create, edit, and delete categories. Upload a cover image for each.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-4 py-2 text-sm font-semibold text-zinc-950 ring-1 ring-zinc-200 hover:bg-zinc-50">
      Create category
    </a>
  </div>

  <div class="mt-4 overflow-hidden rounded-2xl border border-zinc-200 bg-white">
    <div class="px-4 py-3 border-b border-zinc-200 text-sm font-semibold">All categories</div>
    @if($categories->isEmpty())
      <div class="px-4 py-10 text-center text-sm text-zinc-600">No categories yet. Create one to get started.</div>
    @else
      <div class="divide-y divide-zinc-200">
        @foreach ($categories as $c)
          <div class="px-4 py-3 flex items-center gap-3">
            @if($c->imageUrl())
              <img src="{{ $c->imageUrl() }}" alt="" class="h-12 w-16 shrink-0 rounded-xl object-cover bg-zinc-100" />
            @else
              <div class="h-12 w-16 shrink-0 rounded-xl bg-zinc-100"></div>
            @endif
            <div class="min-w-0 flex-1">
              <div class="truncate text-sm font-semibold">{{ $c->name }}</div>
              <div class="mt-0.5 text-xs text-zinc-500">#{{ $c->id }} · {{ $c->slug }} · sort {{ $c->sort_order }}</div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
              <a class="rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm font-semibold hover:bg-zinc-50" href="{{ route('admin.categories.edit', $c) }}">Edit</a>
              <a class="rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm font-semibold hover:bg-zinc-50" href="{{ route('admin.categories.delete', $c) }}">Delete</a>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
