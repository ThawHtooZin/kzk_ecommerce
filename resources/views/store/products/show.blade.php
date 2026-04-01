@php($title = $product->name)
@php($breadcrumbs = 'Home / Products / '.$product->name)
@php($sizes = $product->sizesForSelect())
@extends('layouts.store')

@section('content')
  <div
    class="grid gap-4 lg:grid-cols-2 lg:items-start"
    data-product-detail
    data-product-id="{{ $product->id }}"
    data-product-name="{{ $product->name }}"
    data-product-price-mmk="{{ $product->price_mmk }}"
    @if($product->imageUrl()) data-product-image="{{ $product->imageUrl() }}" @endif
  >
    <section class="rounded-2xl border border-zinc-200 bg-white p-3">
      @if($product->imageUrl())
        <div class="aspect-4/3 w-full overflow-hidden rounded-2xl bg-zinc-100">
          <img src="{{ $product->imageUrl() }}" alt="" class="h-full w-full object-contain" />
        </div>
      @else
        <div class="aspect-4/3 w-full rounded-2xl bg-zinc-100"></div>
      @endif
      <div class="mt-3 flex items-center justify-center gap-2">
        <span class="h-2 w-2 rounded-full bg-zinc-950"></span>
        <span class="h-2 w-2 rounded-full bg-zinc-300"></span>
        <span class="h-2 w-2 rounded-full bg-zinc-300"></span>
      </div>
    </section>

    <section class="rounded-2xl border border-zinc-200 bg-white p-4">
      <div class="flex items-start justify-between gap-3">
        <div>
          @if($product->badge)
            <span class="inline-block rounded-lg bg-zinc-950 px-2 py-1 text-[11px] font-semibold text-white">{{ $product->badge }}</span>
          @endif
          <h1 class="mt-2 text-xl font-semibold tracking-tight">{{ $product->name }}</h1>
          <div class="mt-1 text-sm text-zinc-600">
            <span data-i18n="product.price">Price:</span>
            <span class="font-semibold text-zinc-950">{{ number_format($product->price_mmk) }} MMK</span>
          </div>
          @if($product->category)
            <div class="mt-1 text-sm text-zinc-600">
              <span data-i18n="product.category">Category:</span>
              <a class="font-semibold text-zinc-950 hover:underline" href="{{ url('/categories/'.$product->category_id) }}">{{ $product->category->name }}</a>
            </div>
          @endif
        </div>
        <a href="{{ url('/products') }}" class="shrink-0 text-sm font-semibold text-zinc-700 hover:text-zinc-950" data-i18n="product.back">Back</a>
      </div>

      @if($product->description)
        <p class="mt-4 text-sm text-zinc-700 leading-relaxed">{{ $product->description }}</p>
      @endif

      <div class="mt-4 grid gap-3">
        @if(count($sizes) > 0)
          <div>
            <label class="text-sm font-semibold" data-i18n="product.size">Size</label>
            <select data-product-size class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400">
              <option value="" data-i18n="product.size_select">Select</option>
              @foreach ($sizes as $sz)
                <option value="{{ $sz }}">{{ $sz }}</option>
              @endforeach
            </select>
          </div>
        @else
          <input type="hidden" data-product-size value="" />
        @endif

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="text-sm font-semibold" data-i18n="product.qty">Quantity</label>
            <input data-product-qty type="number" min="1" value="1" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
          </div>
          <div class="flex items-end">
            <button type="button" data-add-to-cart class="inline-flex h-11 w-full items-center justify-center rounded-xl bg-zinc-950 px-4 text-sm font-semibold text-white hover:bg-zinc-900" data-i18n="product.add">
              Add to cart
            </button>
          </div>
        </div>

        <div class="rounded-2xl bg-zinc-50 p-4 text-sm text-zinc-700 border border-zinc-200" data-i18n="product.note">
          Cart is saved on this device. Sign in to checkout.
        </div>
      </div>
    </section>
  </div>
@endsection
