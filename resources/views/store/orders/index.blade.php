@extends('layouts.store')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight" data-i18n="orders.title">My orders</h1>
      <p class="mt-1 text-sm text-zinc-600" data-i18n="orders.sub">Track status and details for every order.</p>
    </div>
    <a href="{{ url('/products') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="orders.shop">Shop</a>
  </div>

  <div class="mt-4 space-y-3">
    @forelse ($orders as $o)
      <a href="{{ route('orders.show', $o) }}" class="block rounded-2xl border border-zinc-200 bg-white p-4 hover:border-zinc-300">
        <div class="flex flex-wrap items-center justify-between gap-2">
          <div>
            <div class="text-sm font-semibold text-zinc-950">#{{ $o->id }}</div>
            <div class="mt-0.5 text-xs text-zinc-500">{{ $o->created_at->format('M j, Y · g:i A') }}</div>
          </div>
          <div class="text-right">
            <span class="inline-flex rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-semibold text-zinc-800">{{ $o->labelStatus() }}</span>
            <div class="mt-1 text-sm font-semibold text-zinc-950">{{ number_format($o->subtotal_mmk) }} MMK</div>
          </div>
        </div>
      </a>
    @empty
      <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-8 text-center text-sm text-zinc-600" data-i18n="orders.empty">
        No orders yet. Browse products and place your first order at checkout.
      </div>
    @endforelse
  </div>

  <div class="mt-6">
    {{ $orders->links() }}
  </div>
@endsection
