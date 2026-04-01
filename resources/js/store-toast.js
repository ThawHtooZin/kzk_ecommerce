/** Non-blocking toasts (replaces window.alert for storefront UX). */

let toastHost;

function ensureHost() {
  if (toastHost) return toastHost;
  toastHost = document.createElement('div');
  toastHost.id = 'store-toast-host';
  toastHost.className =
    'pointer-events-none fixed bottom-6 left-1/2 z-[200] flex w-[min(100%-2rem,22rem)] -translate-x-1/2 flex-col gap-2';
  document.body.appendChild(toastHost);
  return toastHost;
}

/**
 * @param {string} message
 * @param {{ variant?: 'neutral' | 'error' | 'success'; durationMs?: number }} [opts]
 */
export function showStoreToast(message, opts = {}) {
  const { variant = 'neutral', durationMs = 4200 } = opts;
  const host = ensureHost();
  const el = document.createElement('div');
  const styles = {
    neutral: 'border-zinc-200 bg-white text-zinc-900',
    error: 'border-red-200 bg-red-50 text-red-900',
    success: 'border-emerald-200 bg-emerald-50 text-emerald-900',
  };
  el.className = `pointer-events-auto rounded-xl border px-4 py-3 text-sm font-medium shadow-lg ${styles[variant] ?? styles.neutral}`;
  el.setAttribute('role', 'status');
  el.textContent = message;
  host.appendChild(el);

  const remove = () => {
    el.remove();
  };
  const tid = window.setTimeout(remove, durationMs);
  el.addEventListener('click', () => {
    window.clearTimeout(tid);
    remove();
  });
}
