<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ isset($title) ? $title.' · ' : '' }}Admin · {{ config('app.name', 'Ecommerce') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="min-h-screen bg-zinc-100 text-zinc-950 antialiased">
    <div class="min-h-screen lg:flex">
      <div class="fixed inset-0 z-40 bg-black/40 lg:hidden" data-admin-overlay hidden></div>

      <aside class="fixed inset-y-0 left-0 z-50 w-[280px] -translate-x-full lg:translate-x-0 transition-transform duration-200 bg-zinc-950 text-white lg:static lg:inset-auto" data-admin-sidebar>
        <div class="flex h-16 items-center justify-between px-4 border-b border-white/10">
          <a href="{{ url('/admin') }}" class="flex items-center gap-2">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
              <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
              </svg>
            </span>
            <div class="leading-tight">
              <div class="text-sm font-semibold tracking-tight">Admin</div>
              <div class="text-[11px] text-white/70 -mt-0.5">Dashboard</div>
            </div>
          </a>
          <button type="button" class="lg:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/10" data-admin-close>
            <span class="sr-only">Close sidebar</span>
            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" d="M6 6l12 12M18 6l-12 12" />
            </svg>
          </button>
        </div>

        <nav class="px-3 py-4 text-sm">
          <div class="px-3 pb-2 text-[11px] uppercase tracking-wider text-white/50">Overview</div>
          <a href="{{ url('/admin') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('admin') ? 'bg-white/10' : '' }}">
            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-white/10">
              <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" d="M4 10l8-6 8 6v10a1 1 0 0 1-1 1h-5v-7H10v7H5a1 1 0 0 1-1-1z" />
              </svg>
            </span>
            Dashboard
          </a>

          <div class="mt-4 px-3 pb-2 text-[11px] uppercase tracking-wider text-white/50">Management</div>
          <a href="{{ url('/admin/products') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('admin/products*') ? 'bg-white/10' : '' }}">Products</a>
          <a href="{{ url('/admin/categories') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('admin/categories*') ? 'bg-white/10' : '' }}">Categories</a>
          <a href="{{ url('/admin/orders') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('admin/orders*') ? 'bg-white/10' : '' }}">Orders</a>
          <a href="{{ url('/admin/customers') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 hover:bg-white/10 {{ request()->is('admin/customers*') ? 'bg-white/10' : '' }}">Customers</a>

          <div class="mt-4 px-3 pb-2 text-[11px] uppercase tracking-wider text-white/50">Site</div>
          <a href="{{ url('/') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 hover:bg-white/10">View storefront</a>
        </nav>
      </aside>

      <div class="w-full lg:flex-1">
        <header class="sticky top-0 z-30 border-b border-zinc-200 bg-white/90 backdrop-blur">
          <div class="flex h-16 items-center gap-3 px-4">
            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-zinc-200 bg-white lg:hidden" data-admin-open>
              <span class="sr-only">Open sidebar</span>
              <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>

            <div class="min-w-0">
              <div class="truncate text-sm font-semibold">{{ $title ?? 'Admin' }}</div>
              <div class="truncate text-xs text-zinc-500">{{ $subtitle ?? 'Manage your store' }}</div>
            </div>

            <div class="flex-1"></div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-zinc-600">
              <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
              Database-backed catalog
            </div>
          </div>
        </header>

        <main class="px-4 py-5">
          @if (session('status'))
            <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
              {{ session('status') }}
            </div>
          @endif
          {{ $slot ?? '' }}
          @yield('content')
        </main>
      </div>
    </div>
  </body>
</html>
