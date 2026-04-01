/**
 * Client-side cart: localStorage (primary) + cookie mirror when payload fits.
 * Works in mobile browsers and typical in-app WebViews for the same origin.
 */

import { t } from './store-locale';
import { showStoreToast } from './store-toast';

const CART_STORAGE_KEY = 'kzk_store_cart_v1';
const CART_COOKIE_NAME = 'kzk_cart_v1';
const COOKIE_MAX_AGE_SEC = 60 * 60 * 24 * 90;

function storageOk() {
  try {
    const k = '__kzk_cart_test__';
    localStorage.setItem(k, '1');
    localStorage.removeItem(k);
    return true;
  } catch {
    return false;
  }
}

function setCookie(name, value, maxAgeSec) {
  document.cookie = `${name}=${encodeURIComponent(value)};path=/;max-age=${maxAgeSec};SameSite=Lax`;
}

function getCookie(name) {
  const esc = name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1');
  const m = document.cookie.match(new RegExp(`(?:^|; )${esc}=([^;]*)`));
  return m ? decodeURIComponent(m[1]) : null;
}

function parseCart(json) {
  try {
    const o = JSON.parse(json);
    if (o && Array.isArray(o.items)) return { items: o.items };
  } catch {
    /* ignore */
  }
  return { items: [] };
}

export function loadCart() {
  if (storageOk()) {
    const raw = localStorage.getItem(CART_STORAGE_KEY);
    if (raw) return parseCart(raw);
  }
  const c = getCookie(CART_COOKIE_NAME);
  if (c) return parseCart(c);
  return { items: [] };
}

function persistCart(state) {
  const str = JSON.stringify(state);
  if (storageOk()) {
    localStorage.setItem(CART_STORAGE_KEY, str);
  }
  if (str.length < 3600) {
    setCookie(CART_COOKIE_NAME, str, COOKIE_MAX_AGE_SEC);
  }
}

function lineKey(productId, size) {
  return `${String(productId)}::${size || ''}`;
}

export function dispatchCartChanged() {
  window.dispatchEvent(new CustomEvent('store-cart-changed', { detail: { cart: loadCart() } }));
}

export function getTotalCount() {
  return loadCart().items.reduce((n, it) => n + (it.qty || 0), 0);
}

export function getSubtotalMmk() {
  return loadCart().items.reduce((sum, it) => sum + (it.priceMmk || 0) * (it.qty || 0), 0);
}

export function formatMmk(n) {
  return `${Number(n).toLocaleString()} MMK`;
}

/**
 * @param {string} productId
 * @param {{ name?: string; priceMmk?: number; size?: string; imageUrl?: string | null }} meta
 * @param {number} qty
 */
export function addToCart(productId, meta, qty = 1) {
  const id = String(productId);
  const name = (meta.name && String(meta.name).trim()) || `Product #${id}`;
  const rawPrice = meta.priceMmk;
  const priceMmk =
    rawPrice != null && !Number.isNaN(Number(rawPrice)) ? Math.max(0, Math.floor(Number(rawPrice))) : 0;
  const size = meta.size || '';
  const imageUrl = meta.imageUrl || null;
  const q = Math.max(1, Math.floor(Number(qty)) || 1);

  const state = loadCart();
  const key = lineKey(id, size);
  const existing = state.items.find((it) => it.key === key);
  if (existing) {
    existing.qty += q;
    if (imageUrl && !existing.imageUrl) existing.imageUrl = imageUrl;
  } else {
    state.items.push({
      key,
      productId: id,
      name,
      priceMmk,
      size: size || null,
      qty: q,
      imageUrl,
    });
  }
  persistCart(state);
  dispatchCartChanged();
}

export function updateLineQty(key, qty) {
  const state = loadCart();
  const it = state.items.find((i) => i.key === key);
  if (!it) return;
  const q = Math.max(0, Math.floor(Number(qty)) || 0);
  if (q === 0) {
    state.items = state.items.filter((i) => i.key !== key);
  } else {
    it.qty = q;
  }
  persistCart(state);
  dispatchCartChanged();
}

export function removeLine(key) {
  const state = loadCart();
  state.items = state.items.filter((i) => i.key !== key);
  persistCart(state);
  dispatchCartChanged();
}

export function clearCart() {
  persistCart({ items: [] });
  if (storageOk()) {
    localStorage.removeItem(CART_STORAGE_KEY);
  }
  setCookie(CART_COOKIE_NAME, JSON.stringify({ items: [] }), COOKIE_MAX_AGE_SEC);
  dispatchCartChanged();
}

export function updateCartBadge() {
  const n = getTotalCount();
  document.querySelectorAll('[data-store-cart-count]').forEach((el) => {
    el.textContent = String(n);
    el.classList.toggle('hidden', n === 0);
    el.closest('[data-store-cart-wrap]')?.classList.toggle('opacity-60', n === 0);
  });
}

function bindProductDetail() {
  const root = document.querySelector('[data-product-detail]');
  if (!root) return;

  const productId = root.getAttribute('data-product-id');
  if (!productId) return;

  const name = root.getAttribute('data-product-name') || '';
  const priceMmk = Number(root.getAttribute('data-product-price-mmk')) || undefined;
  const imageUrl = root.getAttribute('data-product-image') || '';

  const qtyInput = root.querySelector('[data-product-qty]');
  const sizeEl = root.querySelector('[data-product-size]');
  const btn = root.querySelector('[data-add-to-cart]');

  btn?.addEventListener('click', () => {
    const qty = qtyInput ? Number(qtyInput.value) : 1;
    const size = sizeEl?.value?.trim() || '';
    const isSizeSelect = sizeEl && sizeEl.tagName === 'SELECT';
    if (isSizeSelect && sizeEl.options && sizeEl.options.length > 1 && !size) {
      showStoreToast(t('product.select_size_alert'), { variant: 'error' });
      return;
    }
    addToCart(productId, { name, priceMmk, size, imageUrl: imageUrl || undefined }, qty);
    btn.textContent = t('product.added');
    setTimeout(() => {
      btn.textContent = t('product.add');
    }, 1500);
  });

  window.addEventListener('store-locale-changed', () => {
    if (btn) btn.textContent = t('product.add');
  });
}

function bindCartPage() {
  const root = document.querySelector('[data-cart-root]');
  if (!root) return;

  const listEl = root.querySelector('[data-cart-lines]');
  const emptyEl = root.querySelector('[data-cart-empty]');
  const subtotalEl = root.querySelector('[data-cart-subtotal]');

  function render() {
    const { items } = loadCart();
    if (!listEl || !emptyEl) return;

    if (items.length === 0) {
      emptyEl.hidden = false;
      listEl.innerHTML = '';
      if (subtotalEl) subtotalEl.textContent = formatMmk(0);
      return;
    }

    emptyEl.hidden = true;
    listEl.innerHTML = items
      .map(
        (it) => `
      <div class="flex items-start gap-3 border-b border-zinc-200 py-4 last:border-0" data-cart-line="${it.key}">
        ${
          it.imageUrl
            ? `<img src="${escapeAttr(it.imageUrl)}" alt="" class="h-16 w-20 shrink-0 rounded-xl object-cover bg-zinc-100" />`
            : `<div class="h-16 w-20 shrink-0 rounded-xl bg-zinc-100"></div>`
        }
        <div class="min-w-0 flex-1">
          <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
              <div class="truncate text-sm font-semibold">${escapeHtml(it.name)}</div>
              ${it.size ? `<div class="mt-1 text-xs text-zinc-500">${escapeHtml(t('cart.size_prefix'))} ${escapeHtml(it.size)}</div>` : ''}
            </div>
            <button type="button" class="text-sm text-zinc-400 hover:text-zinc-700" data-remove-line="${escapeAttr(it.key)}" aria-label="${escapeAttr(t('cart.remove_aria'))}">×</button>
          </div>
          <div class="mt-3 flex items-center justify-between gap-3">
            <div class="inline-flex items-center overflow-hidden rounded-xl border border-zinc-200">
              <button type="button" class="h-9 w-10 text-zinc-700 hover:bg-zinc-50" data-dec="${escapeAttr(it.key)}">−</button>
              <div class="h-9 w-12 grid place-items-center text-sm font-semibold">${it.qty}</div>
              <button type="button" class="h-9 w-10 text-zinc-700 hover:bg-zinc-50" data-inc="${escapeAttr(it.key)}">+</button>
            </div>
            <div class="text-sm font-semibold">${formatMmk(it.priceMmk * it.qty)}</div>
          </div>
        </div>
      </div>`
      )
      .join('');

    if (subtotalEl) subtotalEl.textContent = formatMmk(getSubtotalMmk());

    listEl.querySelectorAll('[data-remove-line]').forEach((b) => {
      b.addEventListener('click', () => removeLine(b.getAttribute('data-remove-line')));
    });
    listEl.querySelectorAll('[data-dec]').forEach((b) => {
      b.addEventListener('click', () => {
        const key = b.getAttribute('data-dec');
        const line = loadCart().items.find((i) => i.key === key);
        if (line) updateLineQty(key, line.qty - 1);
      });
    });
    listEl.querySelectorAll('[data-inc]').forEach((b) => {
      b.addEventListener('click', () => {
        const key = b.getAttribute('data-inc');
        const line = loadCart().items.find((i) => i.key === key);
        if (line) updateLineQty(key, line.qty + 1);
      });
    });
  }

  window.addEventListener('store-cart-changed', render);
  render();
}

function escapeHtml(s) {
  return String(s)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

function escapeAttr(s) {
  return String(s).replace(/&/g, '&amp;').replace(/"/g, '&quot;');
}

function bindCheckoutPage() {
  const root = document.querySelector('[data-checkout-root]');
  if (!root) return;

  const summaryEl = root.querySelector('[data-checkout-summary]');
  const countEl = root.querySelector('[data-checkout-item-count]');
  const subtotalEl = root.querySelector('[data-checkout-subtotal]');

  function render() {
    const { items } = loadCart();
    if (summaryEl) {
      if (items.length === 0) {
        summaryEl.innerHTML = `<p class="text-sm text-zinc-600">${escapeHtml(t('checkout.empty'))}</p>`;
      } else {
        summaryEl.innerHTML = items
          .map(
            (it) => `
          <div class="flex justify-between gap-2 text-sm text-zinc-700">
            <span class="truncate">${escapeHtml(it.name)} × ${it.qty}</span>
            <span class="shrink-0 font-semibold text-zinc-950">${formatMmk(it.priceMmk * it.qty)}</span>
          </div>`
          )
          .join('');
      }
    }
    if (countEl) countEl.textContent = String(getTotalCount());
    if (subtotalEl) subtotalEl.textContent = formatMmk(getSubtotalMmk());
  }

  window.addEventListener('store-cart-changed', render);
  window.addEventListener('store-locale-changed', render);
  render();
}

function checkoutErrorMessage(data) {
  if (!data || typeof data !== 'object') return t('order.place_failed');
  if (typeof data.message === 'string' && data.message) return data.message;
  const errs = data.errors;
  if (errs && typeof errs === 'object') {
    const first = Object.values(errs).flat()[0];
    if (typeof first === 'string') return first;
  }
  return t('order.place_failed');
}

function bindPlaceOrder() {
  const btn = document.querySelector('[data-place-order]');
  if (!btn) return;
  btn.addEventListener('click', async () => {
    const { items } = loadCart();
    if (items.length === 0) {
      showStoreToast(t('cart.alert_empty'), { variant: 'error' });
      return;
    }

    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!token) {
      showStoreToast(t('order.place_failed'), { variant: 'error' });
      return;
    }

    const phone = document.querySelector('[data-checkout-phone]')?.value?.trim() ?? '';
    const address = document.querySelector('[data-checkout-address]')?.value?.trim() ?? '';

    const payload = {
      phone: phone || null,
      address: address || null,
      items: items.map((it) => ({
        product_id: Number(it.productId),
        qty: it.qty,
        size: it.size ? String(it.size) : '',
      })),
    };

    btn.disabled = true;
    try {
      const res = await fetch('/orders', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          'X-CSRF-TOKEN': token,
          'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify(payload),
      });

      const data = await res.json().catch(() => ({}));

      if (!res.ok) {
        showStoreToast(checkoutErrorMessage(data), { variant: 'error' });
        return;
      }

      clearCart();
      showStoreToast(t('order.placed_ok'), { variant: 'success' });
      const dest = typeof data.redirect === 'string' ? data.redirect : '/orders';
      window.setTimeout(() => {
        window.location.href = dest;
      }, 900);
    } catch {
      showStoreToast(t('order.place_failed'), { variant: 'error' });
    } finally {
      btn.disabled = false;
    }
  });
}

export function initStoreCart() {
  bindProductDetail();
  bindCartPage();
  bindCheckoutPage();
  bindPlaceOrder();
  updateCartBadge();
  window.addEventListener('store-cart-changed', () => updateCartBadge());
}
