@php($title = $title ?? 'Customers')
@php($subtitle = $subtitle ?? 'Customer list')
@extends('layouts.admin')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Customers</h1>
      <p class="mt-1 text-sm text-zinc-600">Registered shoppers (non-admin accounts).</p>
    </div>
  </div>

  <div class="mt-4 overflow-hidden rounded-2xl border border-zinc-200 bg-white">
    <div class="px-4 py-3 border-b border-zinc-200 text-sm font-semibold">Customers</div>
    <div class="divide-y divide-zinc-200">
      @forelse ($customers as $c)
        <div class="px-4 py-3 flex items-center gap-3">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-zinc-100 text-sm font-semibold text-zinc-600">
            {{ strtoupper(substr($c->name, 0, 1)) }}
          </div>
          <div class="min-w-0 flex-1">
            <div class="truncate text-sm font-semibold">{{ $c->name }}</div>
            <div class="mt-0.5 text-xs text-zinc-500 truncate">{{ $c->email }}</div>
          </div>
          <div class="text-right text-xs text-zinc-500">
            <div>{{ $c->orders_count }} orders</div>
            <div class="mt-0.5">#{{ $c->id }}</div>
          </div>
        </div>
      @empty
        <div class="px-4 py-8 text-center text-sm text-zinc-500">No customers yet.</div>
      @endforelse
    </div>
  </div>

  <div class="mt-4">
    {{ $customers->links() }}
  </div>
@endsection
