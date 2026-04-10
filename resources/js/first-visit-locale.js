import { setLocale } from './store-locale';

const STORAGE_KEY = 'kzk_locale_choice_v1';

/** Android System WebView (incl. Flutter webview_flutter) — separate storage from Chrome; avoid blocking modal. */
function isEmbeddedWebView() {
  const ua = navigator.userAgent || '';
  return /; wv\)/i.test(ua) || /\bFlutter\b/i.test(ua);
}

export function initFirstVisitLocale() {
  const root = document.getElementById('first-visit-locale-modal');
  if (!root) {
    return;
  }

  const saved = localStorage.getItem(STORAGE_KEY);
  if (saved === 'en' || saved === 'my') {
    root.remove();
    return;
  }

  if (isEmbeddedWebView()) {
    const lang = (navigator.language || '').toLowerCase().startsWith('my') ? 'my' : 'en';
    setLocale(lang);
    root.remove();
    return;
  }

  root.hidden = false;

  const finish = (code) => {
    setLocale(code);
    root.remove();
  };

  root.querySelector('[data-locale-pick="en"]')?.addEventListener('click', () => finish('en'));
  root.querySelector('[data-locale-pick="my"]')?.addEventListener('click', () => finish('my'));
}
