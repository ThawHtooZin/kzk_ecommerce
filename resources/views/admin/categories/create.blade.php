@php($title = 'Categories')
@php($subtitle = 'Create category')
@extends('layouts.admin')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Create category</h1>
      <p class="mt-1 text-sm text-zinc-600">Slug is generated from the name if you leave it blank.</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950">Back</a>
  </div>

  <form method="post" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="mt-4 grid gap-3 lg:grid-cols-3">
    @csrf
    <section class="lg:col-span-2 rounded-2xl border border-zinc-200 bg-white p-4 space-y-3">
      <div>
        <label class="text-sm font-semibold" for="name">Category name</label>
        <input id="name" name="name" value="{{ old('name') }}" required class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" placeholder="e.g. Tape & Adhesives" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="slug">Slug (optional)</label>
        <input id="slug" name="slug" value="{{ old('slug') }}" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" placeholder="auto from name" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="sort_order">Sort order</label>
        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', 0) }}" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="description">Description</label>
        <textarea id="description" name="description" rows="4" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm outline-none focus:border-zinc-400" placeholder="Optional">{{ old('description') }}</textarea>
      </div>
      <div>
        <label class="text-sm font-semibold" for="image">Image</label>
        <input id="image" name="image" type="file" accept="image/*" class="mt-2 block w-full text-sm text-zinc-600 file:mr-3 file:rounded-xl file:border-0 file:bg-zinc-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white" />
        <p class="mt-1 text-xs text-zinc-500">JPEG, PNG, WebP — max 5MB.</p>
      </div>
    </section>
    <aside class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 h-fit space-y-3">
      <div class="text-sm font-semibold">Save</div>
      <button type="submit" class="w-full rounded-xl bg-zinc-950 px-4 py-3 text-sm font-semibold text-white hover:bg-zinc-900">
        Create
      </button>
    </aside>
  </form>
@endsection
