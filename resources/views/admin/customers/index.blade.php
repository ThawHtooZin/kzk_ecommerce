@php($title = 'Customers')
@php($subtitle = 'Customer list')
@extends('layouts.admin')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Customers</h1>
      <p class="mt-1 text-sm text-zinc-600">Scaffold for `/admin/customers` (view only).</p>
    </div>
  </div>

  <div class="mt-4 overflow-hidden rounded-2xl border border-zinc-200 bg-white">
    <div class="px-4 py-3 border-b border-zinc-200 text-sm font-semibold">Customers</div>
    <div class="divide-y divide-zinc-200">
      @foreach ([
        ['id' => 1, 'name' => 'Customer A', 'phone' => '+965 50000001'],
        ['id' => 2, 'name' => 'Customer B', 'phone' => '+965 50000002'],
        ['id' => 3, 'name' => 'Customer C', 'phone' => '+965 50000003'],
      ] as $c)
        <div class="px-4 py-3 flex items-center gap-3">
          <div class="h-10 w-10 rounded-xl bg-zinc-100"></div>
          <div class="min-w-0 flex-1">
            <div class="truncate text-sm font-semibold">{{ $c['name'] }}</div>
            <div class="mt-0.5 text-xs text-zinc-500">#{{ $c['id'] }} · {{ $c['phone'] }}</div>
          </div>
          <span class="hidden sm:inline text-xs text-zinc-500">View only</span>
        </div>
      @endforeach
    </div>
  </div>
@endsection

