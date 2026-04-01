import { setLocale } from './store-locale';

const STORAGE_KEY = 'kzk_locale_choice_v1';

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

  root.hidden = false;

  const finish = (code) => {
    setLocale(code);
    root.remove();
  };

  root.querySelector('[data-locale-pick="en"]')?.addEventListener('click', () => finish('en'));
  root.querySelector('[data-locale-pick="my"]')?.addEventListener('click', () => finish('my'));
}
