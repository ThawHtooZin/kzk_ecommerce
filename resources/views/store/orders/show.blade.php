@extends('layouts.store')

@section('content')
  <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">
        <span data-i18n="orders.detail_title">Order</span> #{{ $order->id }}
      </h1>
      <p class="mt-1 text-sm text-zinc-600">{{ $order->created_at->format('M j, Y · g:i A') }}</p>
    </div>
    <div class="flex flex-wrap gap-2">
      <span class="inline-flex rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-800">{{ $order->labelStatus() }}</span>
      <a href="{{ route('orders.index') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="orders.back_list">All orders</a>
    </div>
  </div>

  <div class="mt-4 grid gap-4 lg:grid-cols-3">
    <section class="lg:col-span-2 rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="text-sm font-semibold" data-i18n="orders.items">Items</div>
      <div class="mt-3 divide-y divide-zinc-200">
        @foreach ($order->items as $line)
          <div class="flex flex-wrap items-start justify-between gap-2 py-3 first:pt-0">
            <div class="min-w-0">
              <div class="text-sm font-semibold text-zinc-950">{{ $line->product_name }}</div>
              @if($line->size)
                <div class="mt-0.5 text-xs text-zinc-500"><span data-i18n="orders.size">Size</span>: {{ $line->size }}</div>
              @endif
              <div class="mt-0.5 text-xs text-zinc-500">{{ number_format($line->price_mmk) }} MMK × {{ $line->qty }}</div>
            </div>
            <div class="text-sm font-semibold text-zinc-950">{{ number_format($line->lineTotalMmk()) }} MMK</div>
          </div>
        @endforeach
      </div>
      <div class="mt-4 flex justify-between border-t border-zinc-200 pt-3 text-sm">
        <span class="font-semibold text-zinc-700" data-i18n="orders.subtotal">Subtotal</span>
        <span class="font-semibold text-zinc-950">{{ number_format($order->subtotal_mmk) }} MMK</span>
      </div>
    </section>

    <aside class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 h-fit">
      <div class="text-sm font-semibold" data-i18n="orders.delivery">Delivery</div>
      @if($order->phone)
        <div class="mt-2 text-sm text-zinc-700"><span class="text-zinc-500" data-i18n="orders.phone">Phone</span> · {{ $order->phone }}</div>
      @endif
      @if($order->address)
        <div class="mt-2 text-sm text-zinc-700 whitespace-pre-wrap">{{ $order->address }}</div>
      @else
        <p class="mt-2 text-sm text-zinc-500" data-i18n="orders.no_address">No address on file for this order.</p>
      @endif
    </aside>
  </div>
@endsection
