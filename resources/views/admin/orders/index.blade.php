@php($title = $title ?? 'Orders')
@php($subtitle = $subtitle ?? 'Orders management')
@extends('layouts.admin')

@section('content')
  <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Orders</h1>
      <p class="mt-1 text-sm text-zinc-600">Update status and notes; customers see status on “My orders”.</p>
    </div>
    <form method="get" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-2">
      <label class="text-xs font-semibold text-zinc-500">Status</label>
      <select name="status" onchange="this.form.submit()" class="h-10 rounded-xl border border-zinc-200 bg-white px-3 text-sm">
        <option value="">All</option>
        @foreach (\App\Models\Order::STATUSES as $st)
          <option value="{{ $st }}" @selected($statusFilter === $st)>{{ ucfirst($st) }}</option>
        @endforeach
      </select>
    </form>
  </div>

  <div class="mt-4 overflow-hidden rounded-2xl border border-zinc-200 bg-white">
    <div class="px-4 py-3 border-b border-zinc-200 text-sm font-semibold">All orders</div>
    <div class="divide-y divide-zinc-200">
      @forelse ($orders as $o)
        <a href="{{ route('admin.orders.show', $o) }}" class="flex flex-wrap items-center gap-3 px-4 py-3 hover:bg-zinc-50">
          <div class="min-w-0 flex-1">
            <div class="text-sm font-semibold">#{{ $o->id }}</div>
            <div class="mt-0.5 text-xs text-zinc-500">
              {{ $o->user?->name ?? '—' }} · {{ $o->user?->email ?? '—' }}
            </div>
            <div class="mt-0.5 text-xs text-zinc-400">{{ $o->created_at->format('M j, Y g:i A') }}</div>
          </div>
          <div class="text-right">
            <span class="inline-flex rounded-full bg-zinc-100 px-2 py-1 text-xs font-semibold text-zinc-800">{{ $o->labelStatus() }}</span>
            <div class="mt-1 text-sm font-semibold text-zinc-950">{{ number_format($o->subtotal_mmk) }} MMK</div>
          </div>
        </a>
      @empty
        <div class="px-4 py-8 text-center text-sm text-zinc-500">No orders yet.</div>
      @endforelse
    </div>
  </div>

  <div class="mt-4">
    {{ $orders->links() }}
  </div>
@endsection
