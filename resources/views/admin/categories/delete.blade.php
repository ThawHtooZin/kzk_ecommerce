@php($title = 'Categories')
@php($subtitle = 'Delete '.$category->name)
@extends('layouts.admin')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Delete category</h1>
      <p class="mt-1 text-sm text-zinc-600">{{ $category->name }} (#{{ $category->id }})</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950">Back</a>
  </div>

  <div class="mt-4 max-w-2xl rounded-2xl border border-zinc-200 bg-white p-4">
    <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900">
      @if($category->products()->exists())
        This category has products. Their category will be cleared (set to none) after delete.
      @else
        This cannot be undone. The category image file will be removed from storage.
      @endif
    </div>
    <form method="post" action="{{ route('admin.categories.destroy', $category) }}" class="mt-4 flex flex-col gap-2 sm:flex-row sm:justify-end">
      @csrf
      @method('DELETE')
      <a class="inline-flex items-center justify-center rounded-xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold hover:bg-zinc-50" href="{{ route('admin.categories.index') }}">
        Cancel
      </a>
      <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-rose-600 px-4 py-3 text-sm font-semibold text-white hover:bg-rose-700">
        Confirm delete
      </button>
    </form>
  </div>
@endsection
