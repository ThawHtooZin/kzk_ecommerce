@php($title = $title ?? 'Order')
@php($subtitle = $subtitle ?? '')
@extends('layouts.admin')

@section('content')
  <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
    <div>
      <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950">← Orders</a>
      <h1 class="mt-2 text-xl font-semibold tracking-tight">Order #{{ $order->id }}</h1>
      <p class="mt-1 text-sm text-zinc-600">
        {{ $order->user?->name }} · {{ $order->user?->email }}
      </p>
      <p class="mt-1 text-xs text-zinc-400">{{ $order->created_at->format('M j, Y g:i A') }}</p>
    </div>
    <div class="text-right">
      <span class="inline-flex rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-800">{{ $order->labelStatus() }}</span>
      <div class="mt-2 text-lg font-semibold">{{ number_format($order->subtotal_mmk) }} MMK</div>
    </div>
  </div>

  <div class="mt-6 grid gap-4 lg:grid-cols-3">
    <section class="lg:col-span-2 space-y-4">
      <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white">
        <div class="border-b border-zinc-200 px-4 py-3 text-sm font-semibold">Line items</div>
        <div class="divide-y divide-zinc-200">
          @foreach ($order->items as $line)
            <div class="flex flex-wrap items-start justify-between gap-2 px-4 py-3">
              <div>
                <div class="text-sm font-semibold">{{ $line->product_name }}</div>
                @if($line->product_id)
                  <div class="mt-0.5 text-xs text-zinc-500">Product ID {{ $line->product_id }}</div>
                @endif
                @if($line->size)
                  <div class="mt-0.5 text-xs text-zinc-500">Size: {{ $line->size }}</div>
                @endif
                <div class="mt-0.5 text-xs text-zinc-500">{{ number_format($line->price_mmk) }} MMK × {{ $line->qty }}</div>
              </div>
              <div class="text-sm font-semibold">{{ number_format($line->lineTotalMmk()) }} MMK</div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4">
        <div class="text-sm font-semibold">Customer delivery details</div>
        @if($order->phone)
          <p class="mt-2 text-sm text-zinc-700"><span class="text-zinc-500">Phone</span> · {{ $order->phone }}</p>
        @endif
        @if($order->address)
          <p class="mt-2 text-sm text-zinc-700 whitespace-pre-wrap">{{ $order->address }}</p>
        @else
          <p class="mt-2 text-sm text-zinc-500">No address provided.</p>
        @endif
      </div>
    </section>

    <aside class="rounded-2xl border border-zinc-200 bg-white p-4 h-fit">
      <div class="text-sm font-semibold">Manage order</div>
      <form method="post" action="{{ route('admin.orders.update', $order) }}" class="mt-3 grid gap-3">
        @csrf
        @method('PATCH')
        <div>
          <label class="text-xs font-semibold text-zinc-500">Status</label>
          <select name="status" class="mt-1 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm">
            @foreach (\App\Models\Order::STATUSES as $st)
              <option value="{{ $st }}" @selected($order->status === $st)>{{ ucfirst($st) }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="text-xs font-semibold text-zinc-500">Internal note (customer does not see)</label>
          <textarea name="admin_note" rows="4" class="mt-1 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm" placeholder="Optional">{{ old('admin_note', $order->admin_note) }}</textarea>
        </div>
        <button type="submit" class="h-11 w-full rounded-xl bg-zinc-950 text-sm font-semibold text-white hover:bg-zinc-900">
          Save
        </button>
      </form>
    </aside>
  </div>
@endsection
