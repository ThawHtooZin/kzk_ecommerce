@php($title = 'Orders')
@php($subtitle = 'Orders management')
@extends('layouts.admin')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight">Orders</h1>
      <p class="mt-1 text-sm text-zinc-600">Scaffold for `/admin/orders`.</p>
    </div>
  </div>

  <div class="mt-4 overflow-hidden rounded-2xl border border-zinc-200 bg-white">
    <div class="px-4 py-3 border-b border-zinc-200 text-sm font-semibold">Recent orders</div>
    <div class="divide-y divide-zinc-200">
      @foreach ([
        ['id' => 9001, 'customer' => 'Customer A', 'total' => '3.000 د.ك', 'status' => 'New'],
        ['id' => 9002, 'customer' => 'Customer B', 'total' => '7.500 د.ك', 'status' => 'Processing'],
        ['id' => 9003, 'customer' => 'Customer C', 'total' => '1.250 د.ك', 'status' => 'Delivered'],
      ] as $o)
        <div class="px-4 py-3 flex items-center gap-3">
          <div class="min-w-0 flex-1">
            <div class="text-sm font-semibold">Order #{{ $o['id'] }}</div>
            <div class="mt-0.5 text-xs text-zinc-500">{{ $o['customer'] }} · {{ $o['total'] }}</div>
          </div>
          <span class="rounded-full bg-zinc-100 px-2 py-1 text-xs font-semibold text-zinc-700">{{ $o['status'] }}</span>
        </div>
      @endforeach
    </div>
  </div>
@endsection

