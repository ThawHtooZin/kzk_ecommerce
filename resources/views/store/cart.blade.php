@php($title = 'Cart')
@php($breadcrumbs = 'Home / Cart')
@extends('layouts.store')

@section('content')
  <div data-cart-root>
    <div class="flex items-start justify-between gap-3">
      <div>
        <h1 class="text-xl font-semibold tracking-tight" data-i18n="cart.title">My cart</h1>
        <p class="mt-1 text-sm text-zinc-600" data-i18n="cart.sub">Saved on this device (browser storage).</p>
      </div>
      @auth
        <a href="{{ url('/checkout') }}" class="inline-flex items-center rounded-xl bg-zinc-950 px-3 py-2 text-sm font-semibold text-white hover:bg-zinc-900" data-i18n="cart.checkout">Checkout</a>
      @else
        <a href="{{ url('/login') }}" class="inline-flex items-center rounded-xl bg-zinc-950 px-3 py-2 text-sm font-semibold text-white hover:bg-zinc-900" data-i18n="cart.signin_checkout">Sign in to checkout</a>
      @endauth
    </div>

    <div class="mt-4 grid gap-3 lg:grid-cols-3">
      <section class="lg:col-span-2 rounded-2xl border border-zinc-200 bg-white p-4">
        <div data-cart-empty data-i18n="cart.empty_html" data-i18n-html class="py-8 text-center text-sm text-zinc-600">
          Your cart is empty. <a class="font-semibold text-zinc-950 underline" href="{{ url('/products') }}">Browse products</a>
        </div>
        <div data-cart-lines></div>

        <div class="mt-4 border-t border-zinc-200 pt-4 grid gap-3">
          <p class="text-xs text-zinc-500" data-i18n="cart.promo_note">Promo codes and notes can be added later.</p>
        </div>
      </section>

      <aside class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 h-fit">
        <div class="text-sm font-semibold" data-i18n="cart.summary">Summary</div>
        <div class="mt-3 grid gap-2 text-sm">
          <div class="flex items-center justify-between text-zinc-700">
            <span data-i18n="cart.subtotal">Subtotal</span>
            <span data-cart-subtotal class="font-semibold text-zinc-950">0 MMK</span>
          </div>
          <div class="flex items-center justify-between text-zinc-700">
            <span data-i18n="cart.delivery">Delivery</span>
            <span class="font-semibold text-zinc-950">—</span>
          </div>
        </div>
        @auth
          <a href="{{ url('/checkout') }}" class="mt-4 inline-flex w-full items-center justify-center rounded-xl bg-zinc-950 px-4 py-3 text-sm font-semibold text-white hover:bg-zinc-900" data-i18n="cart.continue">Continue to checkout</a>
        @else
          <a href="{{ url('/register') }}" class="mt-4 inline-flex w-full items-center justify-center rounded-xl bg-zinc-950 px-4 py-3 text-sm font-semibold text-white hover:bg-zinc-900" data-i18n="cart.create_account">Create account to order</a>
          <p class="mt-2 text-center text-xs text-zinc-500">
            <span data-i18n="cart.or_signin">Or</span>
            <a href="{{ url('/login') }}" class="font-semibold text-zinc-800 underline" data-i18n="cart.signin">sign in</a>
          </p>
        @endauth
      </aside>
    </div>
  </div>
@endsection
