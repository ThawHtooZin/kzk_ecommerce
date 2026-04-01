import './bootstrap';
import { initFirstVisitLocale } from './first-visit-locale';
import { applyStoreLocale, initLanguageSwitcher } from './store-locale';
import { initStoreCart } from './store-cart';

function onReady(fn) {
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', fn);
  else fn();
}

onReady(() => {
  applyStoreLocale();
  initFirstVisitLocale();
  initLanguageSwitcher();
  initStoreCart();
  // Store: mobile top menu
  const storeTrigger = document.querySelector('[data-mobile-menu-trigger]');
  const storeMenu = document.querySelector('[data-mobile-menu]');
  if (storeTrigger && storeMenu) {
    storeTrigger.addEventListener('click', () => {
      storeMenu.hidden = !storeMenu.hidden;
    });
  }

  // Admin: sidebar open/close (AdminLTE-ish)
  const sidebar = document.querySelector('[data-admin-sidebar]');
  const overlay = document.querySelector('[data-admin-overlay]');
  const openBtn = document.querySelector('[data-admin-open]');
  const closeBtn = document.querySelector('[data-admin-close]');

  const open = () => {
    if (!sidebar || !overlay) return;
    sidebar.classList.remove('-translate-x-full');
    overlay.hidden = false;
  };
  const close = () => {
    if (!sidebar || !overlay) return;
    sidebar.classList.add('-translate-x-full');
    overlay.hidden = true;
  };

  if (openBtn) openBtn.addEventListener('click', open);
  if (closeBtn) closeBtn.addEventListener('click', close);
  if (overlay) overlay.addEventListener('click', close);
});
