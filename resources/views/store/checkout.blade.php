@php($title = 'Checkout')
@php($breadcrumbs = 'Home / Checkout')
@extends('layouts.store')

@section('content')
  <div data-checkout-root>
    <div class="flex items-start justify-between gap-3">
      <div>
        <h1 class="text-xl font-semibold tracking-tight" data-i18n="checkout.title">Checkout</h1>
        <p class="mt-1 text-sm text-zinc-600">
          <span data-i18n="checkout.signed_in">Signed in as</span>
          <span class="font-semibold text-zinc-950">{{ Auth::user()->name }}</span>
          ({{ Auth::user()->email }})
        </p>
      </div>
      <a href="{{ url('/cart') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="checkout.back_cart">Back to cart</a>
    </div>

    <div class="mt-4 grid gap-3 lg:grid-cols-3">
      <section class="lg:col-span-2 rounded-2xl border border-zinc-200 bg-white p-4">
        <div class="grid gap-3">
          <div class="grid gap-2 sm:grid-cols-2">
            <div>
              <label class="text-sm font-semibold" data-i18n="checkout.full_name">Full name</label>
              <input value="{{ Auth::user()->name }}" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-zinc-50 px-3 text-sm outline-none focus:border-zinc-400" readonly />
            </div>
            <div>
              <label class="text-sm font-semibold" data-i18n="checkout.phone">Phone</label>
              <input class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" data-i18n-placeholder="checkout.phone_ph" placeholder="Add at checkout step 2" />
            </div>
          </div>
          <div>
            <label class="text-sm font-semibold" data-i18n="checkout.address">Delivery address</label>
            <input class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" data-i18n-placeholder="checkout.address_ph" placeholder="Street, area…" />
          </div>
          <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 text-sm text-zinc-700" data-i18n="checkout.payment_note">
            Payment integration can be added later. Place order below runs the demo and clears your cart.
          </div>
        </div>
      </section>

      <aside class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 h-fit">
        <div class="text-sm font-semibold" data-i18n="checkout.summary">Order summary</div>
        <div data-checkout-summary class="mt-3 grid gap-2 text-sm text-zinc-700"></div>
        <div class="mt-3 grid gap-2 border-t border-zinc-200 pt-3 text-sm">
          <div class="flex items-center justify-between text-zinc-700">
            <span data-i18n="checkout.items">Items</span>
            <span data-checkout-item-count class="font-semibold text-zinc-950">0</span>
          </div>
          <div class="flex items-center justify-between text-zinc-700">
            <span data-i18n="checkout.subtotal">Subtotal</span>
            <span data-checkout-subtotal class="font-semibold text-zinc-950">0 MMK</span>
          </div>
        </div>
        <button data-place-order class="mt-4 w-full rounded-xl bg-zinc-950 px-4 py-3 text-sm font-semibold text-white hover:bg-zinc-900" type="button" data-i18n="checkout.place">
          Place order
        </button>
      </aside>
    </div>
  </div>
@endsection
