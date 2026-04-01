@php($title = $product->name)
@php($breadcrumbs = 'Home / Products / '.$product->name)
@php($sizes = $product->sizesForSelect())
@php($gallery = $product->galleryUrls())
@php($mainImage = $product->imageUrl())
@extends('layouts.store')

@section('content')
  <div
    class="grid gap-4 lg:grid-cols-2 lg:items-start"
    data-product-detail
    data-product-id="{{ $product->id }}"
    data-product-name="{{ $product->name }}"
    data-product-price-mmk="{{ $product->price_mmk }}"
    @if($mainImage) data-product-image="{{ $mainImage }}" @endif
  >
    <section class="rounded-2xl border border-zinc-200 bg-white p-3">
      @if(count($gallery) > 0)
        <div class="relative aspect-4/3 w-full overflow-hidden rounded-2xl bg-zinc-100">
          <div
            id="product-gallery-scroll"
            class="product-gallery-scroll flex h-full w-full snap-x snap-mandatory overflow-x-auto overflow-y-hidden"
            role="region"
            aria-label="Product photos"
          >
            @foreach ($gallery as $url)
              <div class="flex h-full w-full min-w-full shrink-0 snap-center snap-always items-center justify-center p-2">
                <img src="{{ $url }}" alt="" class="max-h-full max-w-full object-contain" />
              </div>
            @endforeach
          </div>
        </div>
        @if(count($gallery) > 1)
          <div class="mt-3 flex justify-center gap-1.5" id="product-gallery-dots" aria-hidden="true">
            @foreach ($gallery as $i => $url)
              <button
                type="button"
                class="product-gallery-dot h-2 w-2 rounded-full bg-zinc-300 transition-colors data-[active=true]:bg-zinc-900"
                data-gallery-index="{{ $i }}"
                data-active="{{ $i === 0 ? 'true' : 'false' }}"
                aria-label="Photo {{ $i + 1 }}"
              ></button>
            @endforeach
          </div>
          <p class="mt-2 text-center text-[11px] text-zinc-500" data-i18n="product.swipe_hint">Swipe for more photos</p>
        @endif
      @else
        <div class="aspect-4/3 w-full rounded-2xl bg-zinc-100"></div>
      @endif
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

@if(count($gallery) > 1)
  @push('scripts')
    <script>
      (function () {
        var sc = document.getElementById('product-gallery-scroll');
        var dots = document.querySelectorAll('.product-gallery-dot');
        if (!sc || !dots.length) return;

        function syncDots() {
          var w = sc.clientWidth;
          if (!w) return;
          var idx = Math.round(sc.scrollLeft / w);
          dots.forEach(function (d, i) {
            d.setAttribute('data-active', i === idx ? 'true' : 'false');
          });
        }

        sc.addEventListener('scroll', syncDots, { passive: true });
        dots.forEach(function (dot) {
          dot.addEventListener('click', function () {
            var i = parseInt(dot.getAttribute('data-gallery-index'), 10);
            var w = sc.clientWidth;
            if (w) sc.scrollTo({ left: i * w, behavior: 'smooth' });
          });
        });
      })();
    </script>
  @endpush
@endif
