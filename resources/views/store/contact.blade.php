@php($phone = config('store.contact_phone'))
@php($phoneTel = preg_replace('/\s+/', '', $phone))
@php($title = 'Contact')
@php($breadcrumbs = 'Home / Contact')
@extends('layouts.store')

@section('content')
  <div class="flex items-start justify-between gap-3">
    <div>
      <h1 class="text-xl font-semibold tracking-tight" data-i18n="contact.title">Contact</h1>
      <p class="mt-1 text-sm text-zinc-600" data-i18n="contact.sub">We serve customers in Myanmar. Prices are in MMK.</p>
    </div>
    <a href="{{ url('/') }}" class="text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="contact.home_link">Home</a>
  </div>

  <div class="mt-4 grid gap-3 lg:grid-cols-2">
    <section class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="text-sm font-semibold" data-i18n="contact.touch">Get in touch</div>
      <div class="mt-3 grid gap-2 text-sm text-zinc-700">
        <div class="flex items-center justify-between rounded-xl bg-zinc-50 border border-zinc-200 p-3">
          <span data-i18n="contact.phone_row">Phone / Viber / WhatsApp</span>
          <span class="font-semibold text-zinc-950">{{ $phone }}</span>
        </div>
        <div class="flex items-center justify-between rounded-xl bg-zinc-50 border border-zinc-200 p-3">
          <span data-i18n="contact.delivery_row">Delivery</span>
          <span class="font-semibold text-zinc-950" data-i18n="contact.mm">Myanmar</span>
        </div>
      </div>
      <div class="mt-4 rounded-2xl border border-zinc-200 bg-zinc-50 p-4 text-sm text-zinc-700" data-i18n="contact.dev_note" data-i18n-html></div>
    </section>

    <section class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="text-sm font-semibold" data-i18n="contact.quick">Quick actions</div>
      <div class="mt-3 grid gap-2">
        <a class="rounded-xl bg-zinc-950 px-4 py-3 text-center text-sm font-semibold text-white hover:bg-zinc-900" href="tel:{{ $phoneTel }}" data-i18n="contact.call">
          Call now
        </a>
        <a class="rounded-xl border border-zinc-200 bg-white px-4 py-3 text-center text-sm font-semibold hover:bg-zinc-50" href="{{ url('/products') }}" data-i18n="contact.browse">
          Browse products
        </a>
        <a class="rounded-xl border border-zinc-200 bg-white px-4 py-3 text-center text-sm font-semibold hover:bg-zinc-50" href="{{ url('/admin') }}" data-i18n="contact.admin">
          Go to admin
        </a>
      </div>
    </section>
  </div>
@endsection
