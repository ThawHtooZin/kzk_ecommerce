<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ isset($title) ? $title.' · ' : '' }}{{ config('app.name', 'Ecommerce') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="min-h-screen bg-slate-100 text-slate-950 antialiased">
    <div class="mx-auto min-h-screen max-w-[1100px] bg-white lg:rounded-2xl lg:my-6 overflow-hidden ring-1 ring-slate-200 shadow-sm">
      <header class="sticky top-0 z-30 bg-slate-900/95 text-white backdrop-blur border-b border-white/10">
        <div class="px-3 py-2.5 sm:px-4 sm:py-3">
          <div class="flex items-center gap-1.5 sm:gap-3">
            <button type="button" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-white/10 bg-white/5 lg:hidden" data-mobile-menu-trigger aria-expanded="false" aria-controls="store-mobile-menu">
              <span class="sr-only" data-i18n="nav.open_menu">Open menu</span>
              <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>

            <a href="{{ url('/') }}" class="flex min-w-0 flex-1 items-center gap-2 lg:flex-initial">
              <img src="/brand/logo.svg" alt="" class="h-9 w-9 shrink-0 rounded-xl bg-white/5 ring-1 ring-white/10" />
              <div class="min-w-0 self-center leading-tight">
                <div class="text-sm font-semibold tracking-tight truncate">{{ config('app.name', 'KZK') }}</div>
                <div class="hidden text-[11px] text-white/70 sm:block truncate" data-i18n="nav.tagline">Myanmar · Prices in MMK</div>
              </div>
            </a>

            <div class="hidden min-w-0 flex-1 lg:block"></div>

            <div class="flex h-10 shrink-0 items-center gap-px rounded-xl border border-white/10 bg-white/6 p-0.5 text-[11px] font-bold leading-none shadow-sm sm:text-xs" aria-label="Language">
              <button type="button" data-locale-switch="en" class="rounded-lg px-2 py-1.5 text-amber-200 hover:bg-white/10 sm:px-2.5" data-i18n="nav.lang_en">EN</button>
              <button type="button" data-locale-switch="my" class="rounded-lg px-2 py-1.5 text-amber-200 hover:bg-white/10 sm:px-2.5" data-i18n="nav.lang_my">မြန်မာ</button>
            </div>

            @guest
              <a href="{{ url('/login') }}" class="hidden h-10 shrink-0 items-center rounded-xl px-3 text-sm font-medium text-white/90 hover:bg-white/10 lg:inline-flex" data-i18n="nav.sign_in">Sign in</a>
            @else
              <div class="hidden items-center gap-1 lg:flex">
                <a href="{{ route('orders.index') }}" class="hidden h-10 items-center rounded-xl px-3 text-sm font-medium text-white/90 hover:bg-white/10 sm:inline-flex" data-i18n="nav.orders">My orders</a>
                <span class="hidden max-w-[140px] truncate text-sm text-white/80 sm:inline" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span>
                <form method="post" action="{{ url('/logout') }}" class="inline">
                  @csrf
                  <button type="submit" class="h-10 rounded-xl px-3 text-sm font-medium text-white/90 hover:bg-white/10" data-i18n="nav.logout">Log out</button>
                </form>
              </div>
            @endguest

            <a href="{{ url('/cart') }}" data-store-cart-wrap class="relative inline-flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 px-2.5 text-sm font-medium text-white sm:px-3">
              <svg viewBox="0 0 24 24" class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" d="M6 6h15l-1.5 9h-12z" />
                <path stroke-linecap="round" d="M6 6l-2-2" />
                <path stroke-linecap="round" d="M9 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM18 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
              </svg>
              <span class="hidden sm:inline" data-i18n="nav.cart">Cart</span>
              <span data-store-cart-count class="absolute -right-1 -top-1 hidden min-h-5 min-w-5 rounded-full bg-amber-300 px-1 text-center text-[11px] font-bold leading-5 text-slate-950">0</span>
            </a>
          </div>

          <div class="mt-3 hidden lg:block">
            <form action="{{ url('/products') }}" method="get" class="relative">
              <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-white/60" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" d="M21 21l-4.35-4.35" />
                <path stroke-linecap="round" d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z" />
              </svg>
              <input
                name="q"
                value="{{ request('q') }}"
                data-i18n-placeholder="nav.search_placeholder"
                placeholder="Search products…"
                class="h-12 w-full rounded-2xl border border-white/10 bg-white/5 px-11 text-sm text-white placeholder:text-white/50 outline-none focus:border-amber-300/60 focus:ring-4 focus:ring-amber-300/15"
              />
            </form>
          </div>

          <nav class="mt-3 hidden lg:flex items-center gap-2 text-sm">
            @auth
              <a class="rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->routeIs('orders.*') ? 'bg-white/10 font-semibold' : '' }}" href="{{ route('orders.index') }}" data-i18n="nav.orders">My orders</a>
            @endauth
            <a class="rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('/') ? 'bg-white/10 font-semibold' : '' }}" href="{{ url('/') }}" data-i18n="nav.home">Home</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('categories*') ? 'bg-white/10 font-semibold' : '' }}" href="{{ url('/categories') }}" data-i18n="nav.categories">Categories</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('products*') ? 'bg-white/10 font-semibold' : '' }}" href="{{ url('/products') }}" data-i18n="nav.products">Products</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('contact') ? 'bg-white/10 font-semibold' : '' }}" href="{{ url('/contact') }}" data-i18n="nav.contact">Contact</a>
            @guest
              <a class="rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('login') ? 'bg-white/10 font-semibold' : '' }}" href="{{ url('/login') }}" data-i18n="nav.sign_in">Sign in</a>
              <a class="rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('register') ? 'bg-white/10 font-semibold' : '' }}" href="{{ url('/register') }}" data-i18n="nav.register">Register</a>
            @endguest
            <div class="flex-1"></div>
            <a class="rounded-xl px-3 py-2 hover:bg-white/10" href="{{ url('/admin') }}" data-i18n="nav.admin">Admin</a>
          </nav>
        </div>

        <div id="store-mobile-menu" class="lg:hidden" data-mobile-menu hidden>
          <div class="border-t border-white/10 px-4 pb-5 pt-4">
            <form action="{{ url('/products') }}" method="get" class="relative mb-5">
              <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-white/60" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" d="M21 21l-4.35-4.35" />
                <path stroke-linecap="round" d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z" />
              </svg>
              <input
                name="q"
                value="{{ request('q') }}"
                data-i18n-placeholder="nav.search_placeholder"
                placeholder="Search products…"
                class="h-12 w-full rounded-2xl border border-white/10 bg-white/5 py-3 pl-11 pr-4 text-sm text-white placeholder:text-white/50 outline-none focus:border-amber-300/60 focus:ring-4 focus:ring-amber-300/15"
              />
            </form>

            <nav class="flex flex-col gap-1 text-[15px] leading-snug">
              <a class="rounded-xl px-4 py-3.5 font-medium text-white/95 hover:bg-white/10 active:bg-white/15 {{ request()->is('/') ? 'bg-white/10' : '' }}" href="{{ url('/') }}" data-i18n="nav.home">Home</a>
              <a class="rounded-xl px-4 py-3.5 font-medium text-white/95 hover:bg-white/10 active:bg-white/15 {{ request()->is('categories*') ? 'bg-white/10' : '' }}" href="{{ url('/categories') }}" data-i18n="nav.categories">Categories</a>
              <a class="rounded-xl px-4 py-3.5 font-medium text-white/95 hover:bg-white/10 active:bg-white/15 {{ request()->is('products*') ? 'bg-white/10' : '' }}" href="{{ url('/products') }}" data-i18n="nav.products">Products</a>
              <a class="rounded-xl px-4 py-3.5 font-medium text-white/95 hover:bg-white/10 active:bg-white/15 {{ request()->is('contact') ? 'bg-white/10' : '' }}" href="{{ url('/contact') }}" data-i18n="nav.contact">Contact</a>
              @auth
                <a class="rounded-xl px-4 py-3.5 font-medium text-white/95 hover:bg-white/10 active:bg-white/15 {{ request()->routeIs('orders.*') ? 'bg-white/10' : '' }}" href="{{ route('orders.index') }}" data-i18n="nav.orders">My orders</a>
              @endauth
              @guest
                <a class="rounded-xl px-4 py-3.5 font-medium text-white/95 hover:bg-white/10 active:bg-white/15" href="{{ url('/login') }}" data-i18n="nav.sign_in">Sign in</a>
                <a class="rounded-xl px-4 py-3.5 font-medium text-amber-200 hover:bg-white/10 active:bg-white/15" href="{{ url('/register') }}" data-i18n="nav.register">Register</a>
              @endguest
              <a class="rounded-xl px-4 py-3.5 font-medium text-white/95 hover:bg-white/10 active:bg-white/15" href="{{ url('/admin') }}" data-i18n="nav.admin">Admin</a>
            </nav>

            @auth
              <div class="mt-5 border-t border-white/10 pt-5">
                <div class="mb-3 truncate px-1 text-xs font-medium text-white/55" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</div>
                <form method="post" action="{{ url('/logout') }}">
                  @csrf
                  <button type="submit" class="w-full rounded-xl bg-white/5 px-4 py-3.5 text-left text-[15px] font-medium text-white/95 ring-1 ring-white/10 hover:bg-white/10 active:bg-white/15" data-i18n="nav.logout">Log out</button>
                </form>
              </div>
            @endauth
          </div>
        </div>
      </header>

      <main class="px-4 py-5 bg-white">
        @isset($breadcrumbs)
          <div class="mb-4 text-xs text-zinc-500">
            {{ $breadcrumbs }}
          </div>
        @endisset

        {{ $slot ?? '' }}
        @yield('content')
      </main>

      <footer class="border-t border-slate-200 px-4 py-6 bg-slate-50">
        <div class="grid gap-4 lg:grid-cols-3">
          <div class="text-sm">
            <div class="font-semibold" data-i18n="footer.contact">Contact</div>
            <div class="mt-1 text-zinc-600"><span data-i18n="footer.phone_line">Call / Viber / WhatsApp:</span> <span class="font-medium">{{ config('store.contact_phone') }}</span></div>
            <div class="text-zinc-600" data-i18n="footer.delivery_line">Delivery in Myanmar · All prices MMK</div>
          </div>
          <div class="text-sm">
            <div class="font-semibold" data-i18n="footer.quick_links">Quick links</div>
            <div class="mt-1 flex flex-wrap gap-2 text-zinc-600">
              <a class="hover:text-zinc-950" href="{{ url('/products') }}" data-i18n="nav.products">Products</a>
              <span>·</span>
              <a class="hover:text-zinc-950" href="{{ url('/categories') }}" data-i18n="nav.categories">Categories</a>
              <span>·</span>
              <a class="hover:text-zinc-950" href="{{ url('/contact') }}" data-i18n="nav.contact">Contact</a>
            </div>
          </div>
          <div class="text-sm lg:text-right text-zinc-600">
            <div class="font-semibold text-zinc-950">{{ config('app.name', 'KZK') }}</div>
            <div class="mt-1">© {{ date('Y') }}. <span data-i18n="footer.rights">All rights reserved.</span></div>
          </div>
        </div>
      </footer>
    </div>

    @stack('scripts')
  </body>
</html>
