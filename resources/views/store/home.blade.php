@php($title = 'Home')
@extends('layouts.store')

@section('content')
  <div
    id="first-visit-locale-modal"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/70 p-4 backdrop-blur-sm"
    hidden
    role="dialog"
    aria-modal="true"
    aria-labelledby="first-visit-locale-title"
  >
    <div class="w-full max-w-sm rounded-2xl border border-white/10 bg-slate-900 p-6 shadow-2xl shadow-black/40 ring-1 ring-white/10">
      <h2 id="first-visit-locale-title" class="text-center text-lg font-semibold text-white" data-i18n="modal.pick_title">Choose language</h2>
      <p class="mt-2 text-center text-xs text-white/60" data-i18n="modal.pick_hint">You can change this anytime from the top bar.</p>
      <div class="mt-6 flex flex-col gap-2 sm:flex-row">
        <button type="button" data-locale-pick="en" class="flex-1 rounded-xl bg-amber-300 px-4 py-3 text-sm font-semibold text-slate-950 hover:bg-amber-200" data-i18n="modal.btn_en">English</button>
        <button type="button" data-locale-pick="my" class="flex-1 rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm font-semibold text-white hover:bg-white/10" data-i18n="modal.btn_my">မြန်မာ</button>
      </div>
    </div>
  </div>

  <section class="rounded-2xl bg-slate-900 text-white overflow-hidden ring-1 ring-slate-800">
    <div class="px-4 py-8 sm:px-8 sm:py-10 grid gap-6 lg:grid-cols-2 lg:items-center">
      <div>
        <div class="inline-flex items-center gap-2 rounded-full bg-amber-300/15 px-3 py-1 text-xs text-amber-100 ring-1 ring-amber-300/20">
          <span class="h-2 w-2 rounded-full bg-amber-300"></span>
          <span data-i18n="home.hero_badge">Wholesale · Myanmar · MMK pricing</span>
        </div>
        <h1 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl" data-i18n="home.hero_title">High quality tools, fast delivery.</h1>
        <p class="mt-3 text-sm text-white/75 leading-relaxed max-w-prose" data-i18n="home.hero_sub">
          Categories and products come from your database. All prices are in Myanmar Kyat (MMK). Manage catalog in Admin.
        </p>
        <div class="mt-6 flex flex-wrap gap-2">
          <a href="{{ url('/products') }}" class="inline-flex items-center justify-center rounded-xl bg-amber-300 px-4 py-2 text-sm font-semibold text-slate-950 hover:bg-amber-200" data-i18n="home.browse">Browse products</a>
          <a href="{{ url('/categories') }}" class="inline-flex items-center justify-center rounded-xl border border-white/15 px-4 py-2 text-sm font-semibold text-white hover:bg-white/10" data-i18n="home.view_cat">View categories</a>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-3">
        <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
          <div class="text-xs text-white/70" data-i18n="home.card_new">New arrivals</div>
          <div class="mt-2 text-lg font-semibold" data-i18n="home.card_fresh">Fresh stock</div>
          <div class="mt-3 h-20 rounded-xl bg-linear-to-br from-amber-300/25 to-white/5"></div>
        </div>
        <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
          <div class="text-xs text-white/70" data-i18n="home.card_promo">Special promo</div>
          <div class="mt-2 text-lg font-semibold" data-i18n="home.card_deals">Weekly deals</div>
          <div class="mt-3 h-20 rounded-xl bg-linear-to-br from-amber-300/25 to-white/5"></div>
        </div>
        <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10 col-span-2">
          <div class="text-xs text-white/70" data-i18n="home.card_contact">Contact</div>
          <div class="mt-2 flex flex-wrap items-center justify-between gap-2">
            <div class="text-lg font-semibold">+95 9 123 456 789</div>
            <a class="rounded-xl bg-white/10 px-3 py-2 text-sm font-semibold hover:bg-white/15" href="{{ url('/contact') }}" data-i18n="home.contact_page">Contact page</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-6 grid gap-4 lg:grid-cols-2">
    <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4">
      <div class="flex items-center justify-between">
        <h2 class="text-sm font-semibold" data-i18n="home.section_cat">Product categories</h2>
        <a href="{{ url('/categories') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="home.see_all">See all</a>
      </div>
      <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3">
        @forelse ($categories as $cat)
          <a href="{{ url('/categories/'.$cat->id) }}" class="rounded-2xl bg-white p-3 ring-1 ring-zinc-200 hover:ring-zinc-300">
            @if($cat->imageUrl())
              <div class="aspect-4/3 w-full overflow-hidden rounded-xl bg-zinc-100">
                <img src="{{ $cat->imageUrl() }}" alt="" class="h-full w-full object-cover" />
              </div>
            @else
              <div class="h-16 rounded-xl bg-zinc-100"></div>
            @endif
            <div class="mt-2 text-sm font-semibold leading-tight">{{ $cat->name }}</div>
            <div class="mt-1 text-xs text-zinc-500" data-i18n="home.tap_open">Tap to open</div>
          </a>
        @empty
          <p class="col-span-full text-sm text-zinc-600" data-i18n="home.empty_cat">No categories yet. Add some in Admin.</p>
        @endforelse
      </div>
    </div>

    <div class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="flex items-center justify-between">
        <h2 class="text-sm font-semibold" data-i18n="home.section_new">New arrivals</h2>
        <a href="{{ url('/products') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="home.shop">Shop</a>
      </div>
      <div class="mt-3 grid grid-cols-2 gap-3">
        @forelse ($products as $p)
          <a href="{{ url('/products/'.$p->id) }}" class="rounded-2xl border border-zinc-200 p-3 hover:border-zinc-300">
            @if($p->imageUrl())
              <div class="aspect-4/3 w-full overflow-hidden rounded-xl bg-zinc-100">
                <img src="{{ $p->imageUrl() }}" alt="" class="h-full w-full object-cover" />
              </div>
            @else
              <div class="aspect-4/3 w-full rounded-xl bg-zinc-100"></div>
            @endif
            <div class="mt-2 text-sm font-semibold leading-tight line-clamp-2">{{ $p->name }}</div>
            <div class="mt-1 text-xs text-zinc-500">{{ number_format($p->price_mmk) }} MMK</div>
          </a>
        @empty
          <p class="col-span-full text-sm text-zinc-600" data-i18n="home.empty_prod">No products yet. Add some in Admin.</p>
        @endforelse
      </div>
    </div>
  </section>
@endsection
