/** Client-side EN / မြန်မာ for the storefront. Persists with localStorage (same as first-visit). */

export const STORAGE_KEY = 'kzk_locale_choice_v1';

/** @type {Record<string, Record<string, string>>} */
const STRINGS = {
  en: {
    'nav.open_menu': 'Open menu',
    'nav.tagline': 'Myanmar · Prices in MMK',
    'nav.sign_in': 'Sign in',
    'nav.register': 'Register',
    'nav.logout': 'Log out',
    'nav.cart': 'Cart',
    'nav.search_placeholder': 'Search products…',
    'nav.home': 'Home',
    'nav.categories': 'Categories',
    'nav.products': 'Products',
    'nav.contact': 'Contact',
    'nav.admin': 'Admin',
    'nav.orders': 'My orders',
    'nav.lang_en': 'EN',
    'nav.lang_my': 'မြန်မာ',

    'footer.contact': 'Contact',
    'footer.phone_line': 'Call / Viber / WhatsApp:',
    'footer.delivery_line': 'Delivery in Myanmar · All prices MMK',
    'footer.quick_links': 'Quick links',
    'footer.rights': 'All rights reserved.',

    'modal.pick_title': 'Choose language',
    'modal.pick_hint': 'You can change this anytime from the top bar.',
    'modal.btn_en': 'English',
    'modal.btn_my': 'မြန်မာ',

    'home.hero_badge': 'Wholesale · Myanmar · MMK pricing',
    'home.hero_title': 'High quality tools, fast delivery.',
    'home.hero_sub':
      'Categories and products come from your database. All prices are in Myanmar Kyat (MMK). Manage catalog in Admin.',
    'home.browse': 'Browse products',
    'home.view_cat': 'View categories',
    'home.card_new': 'New arrivals',
    'home.card_fresh': 'Fresh stock',
    'home.card_promo': 'Special promo',
    'home.card_deals': 'Weekly deals',
    'home.card_contact': 'Contact',
    'home.contact_page': 'Contact page',
    'home.section_cat': 'Product categories',
    'home.see_all': 'See all',
    'home.tap_open': 'Tap to open',
    'home.empty_cat': 'No categories yet. Add some in Admin.',
    'home.section_new': 'New arrivals',
    'home.shop': 'Shop',
    'home.empty_prod': 'No products yet. Add some in Admin.',

    'products.title': 'Products',
    'products.sub': 'Live data from the database. Filter by category or search by name.',
    'products.go_cart': 'Go to cart',
    'products.search_label': 'Search',
    'products.search_ph': 'Search by name…',
    'products.cat_label': 'Category',
    'products.cat_all': 'All categories',
    'products.apply': 'Apply',
    'products.empty': 'No products match. Add products in Admin or clear filters.',
    'products.empty_html':
      'No products match. Add products in <a href="/admin/products" class="font-semibold text-zinc-950 underline">Admin</a> or clear filters.',
    'products.results_for': 'Results for',
    'products.results_sep': '—',
    'products.results_items': 'item(s).',

    'categories.title': 'Categories',
    'categories.sub': 'Browse categories from the database.',
    'categories.heading': 'Product categories',
    'categories.lead': 'From the database — upload images in Admin.',
    'categories.empty_html':
      'No categories yet. Create them in <a href="/admin/categories" class="font-semibold text-zinc-950 underline">Admin → Categories</a>.',
    'categories.browse_prod': 'Browse products',
    'categories.view': 'View category',
    'categories.empty': 'No categories yet. Create them in Admin.',

    'cat_show.products': 'Products',
    'cat_show.empty': 'No active products in this category yet.',
    'cat_show.fallback_desc': 'Products in this category from your catalog.',
    'cat_show.all_link': 'All categories',

    'product.back': 'Back',
    'product.price': 'Price:',
    'product.size': 'Size',
    'product.size_select': 'Select',
    'product.qty': 'Quantity',
    'product.add': 'Add to cart',
    'product.added': 'Added ✓',
    'product.select_size_alert': 'Please select a size.',
    'product.category': 'Category:',
    'product.note': 'Cart is saved on this device. Sign in to checkout.',
    'product.swipe_hint': 'Swipe for more photos',

    'cart.title': 'My cart',
    'cart.sub': 'Saved on this device (browser storage).',
    'cart.checkout': 'Checkout',
    'cart.signin_checkout': 'Sign in to checkout',
    'cart.empty_html':
      'Your cart is empty. <a class="font-semibold text-zinc-950 underline" href="/products">Browse products</a>',
    'cart.promo_note': 'Promo codes and notes can be added later.',
    'cart.summary': 'Summary',
    'cart.subtotal': 'Subtotal',
    'cart.delivery': 'Delivery',
    'cart.continue': 'Continue to checkout',
    'cart.create_account': 'Create account to order',
    'cart.or_signin': 'Or',
    'cart.signin': 'sign in',
    'cart.size_prefix': 'Size:',
    'cart.remove_aria': 'Remove',
    'cart.alert_empty': 'Your cart is empty.',
    'checkout.empty': 'Your cart is empty.',

    'checkout.title': 'Checkout',
    'checkout.signed_in': 'Signed in as',
    'checkout.payment_note':
      'Your order is saved to your account. You can track status under My orders. Payment integration can be added later.',
    'checkout.back_cart': 'Back to cart',
    'checkout.full_name': 'Full name',
    'checkout.phone': 'Phone',
    'checkout.phone_ph': 'Add at checkout step 2',
    'checkout.address': 'Delivery address',
    'checkout.address_ph': 'Street, area…',
    'checkout.note': 'Payment integration can be added later.',
    'checkout.summary': 'Order summary',
    'checkout.items': 'Items',
    'checkout.subtotal': 'Subtotal',
    'checkout.place': 'Place order',
    'order.demo_thanks':
      'Thank you! Your order request was recorded (demo). You can connect this button to your backend next.',
    'order.placed_ok': 'Order placed — taking you to your order…',
    'order.place_failed': 'Could not place order. Please try again.',

    'orders.title': 'My orders',
    'orders.sub': 'Track status and details for every order.',
    'orders.shop': 'Shop',
    'orders.empty': 'No orders yet. Browse products and place your first order at checkout.',
    'orders.detail_title': 'Order',
    'orders.back_list': 'All orders',
    'orders.items': 'Items',
    'orders.size': 'Size',
    'orders.subtotal': 'Subtotal',
    'orders.delivery': 'Delivery',
    'orders.phone': 'Phone',
    'orders.no_address': 'No address on file for this order.',

    'contact.title': 'Contact',
    'contact.sub': 'We serve customers in Myanmar. Prices are in MMK.',
    'contact.home_link': 'Home',
    'contact.touch': 'Get in touch',
    'contact.phone_row': 'Phone / Viber / WhatsApp',
    'contact.delivery_row': 'Delivery',
    'contact.mm': 'Myanmar',
    'contact.dev_note':
      'Update the phone number in the Blade templates (contact page, home, and store layout footer) if it changes.',
    'contact.quick': 'Quick actions',
    'contact.call': 'Call now',
    'contact.browse': 'Browse products',
    'contact.admin': 'Go to admin',

    'auth.login_title': 'Sign in',
    'auth.login_sub': 'You need an account before checkout. Sign in to continue.',
    'auth.email': 'Email',
    'auth.password': 'Password',
    'auth.remember': 'Remember me',
    'auth.signin_btn': 'Sign in',
    'auth.no_account': 'No account yet?',
    'auth.create_one': 'Create one',

    'auth.reg_title': 'Create account',
    'auth.reg_sub': 'Register to place orders. Your cart is saved on this device.',
    'auth.name': 'Full name',
    'auth.password_confirm': 'Confirm password',
    'auth.pw_hint': 'At least 8 characters.',
    'auth.create_btn': 'Create account',
    'auth.have_account': 'Already registered?',
    'auth.signin_link': 'Sign in',
  },

  my: {
    'nav.open_menu': 'မီနူးဖွင့်ရန်',
    'nav.tagline': 'မြန်မာ · ဈေးနှုန်း MMK',
    'nav.sign_in': 'ဝင်ရောက်ရန်',
    'nav.register': 'အကောင့်ဖွင့်ရန်',
    'nav.logout': 'ထွက်ရန်',
    'nav.cart': 'ခြင်းတောင်း',
    'nav.search_placeholder': 'ကုန်ပစ္စည်းရှာရန်…',
    'nav.home': 'ပင်မစာမျက်နှာ',
    'nav.categories': 'အမျိုးအစားများ',
    'nav.products': 'ကုန်ပစ္စည်းများ',
    'nav.contact': 'ဆက်သွယ်ရန်',
    'nav.admin': 'စီမံခန့်ခွဲမှု',
    'nav.orders': 'ကျွန်ုပ်၏ မှာယူမှုများ',
    'nav.lang_en': 'EN',
    'nav.lang_my': 'မြန်မာ',

    'footer.contact': 'ဆက်သွယ်ရန်',
    'footer.phone_line': 'ဖုန်း / Viber / WhatsApp:',
    'footer.delivery_line': 'မြန်မာနိုင်ငံတွင်း ပို့ဆောင်မှု · ဈေးနှုန်း MMK',
    'footer.quick_links': 'လင့်ခ်များ',
    'footer.rights': 'မူပိုင်ခွင့်ရှိပါသည်။',

    'modal.pick_title': 'ဘာသာစကား ရွေးပါ',
    'modal.pick_hint': 'အပေါ်ဘားမှ နောက်ပိုင်းတွင် ပြောင်းလဲနိုင်ပါသည်။',
    'modal.btn_en': 'English',
    'modal.btn_my': 'မြန်မာ',

    'home.hero_badge': 'လက်ကား · မြန်မာ · MMK ဈေးနှုန်း',
    'home.hero_title': 'ကိရိယာအရည်အသွေး မြင့်၊ ပို့ဆောင်မှု မြန်ဆန်။',
    'home.hero_sub':
      'အမျိုးအစားနှင့် ကုန်ပစ္စည်းများကို ဒေတာဘေ့စ်မှ ရယူပါ။ ဈေးနှုန်းအားလုံး မြန်မာကျပ် (MMK) ဖြစ်ပါသည်။ စီမံခန့်ခွဲမှုကို Admin တွင် လုပ်ဆောင်ပါ။',
    'home.browse': 'ကုန်ပစ္စည်းကြည့်ရန်',
    'home.view_cat': 'အမျိုးအစားကြည့်ရန်',
    'home.card_new': 'အသစ်ရောက်များ',
    'home.card_fresh': 'စတော့ အသစ်',
    'home.card_promo': 'ကမ်းလှမ်းချက်',
    'home.card_deals': 'အပတ်စဉ် လျှော့ဈေး',
    'home.card_contact': 'ဆက်သွယ်ရန်',
    'home.contact_page': 'ဆက်သွယ်ရေးစာမျက်နှာ',
    'home.section_cat': 'ကုန်ပစ္စည်း အမျိုးအစားများ',
    'home.see_all': 'အားလုံး',
    'home.tap_open': 'ဖွင့်ရန် နှိပ်ပါ',
    'home.empty_cat': 'အမျိုးအစား မရှိသေးပါ။ Admin တွင် ထည့်ပါ။',
    'home.section_new': 'အသစ်ရောက်များ',
    'home.shop': 'ဝယ်ယူရန်',
    'home.empty_prod': 'ကုန်ပစ္စည်း မရှိသေးပါ။ Admin တွင် ထည့်ပါ။',

    'products.title': 'ကုန်ပစ္စည်းများ',
    'products.sub': 'ဒေတာဘေ့စ်မှ တိုက်ရိုက်။ အမျိုးအစား သို့မဟုတ် အမည်ဖြင့် ရှာပါ။',
    'products.go_cart': 'ခြင်းတောင်းသို့',
    'products.search_label': 'ရှာရန်',
    'products.search_ph': 'အမည်ဖြင့် ရှာရန်…',
    'products.cat_label': 'အမျိုးအစား',
    'products.cat_all': 'အမျိုးအစားအားလုံး',
    'products.apply': 'သုံးရန်',
    'products.empty': 'ကိုက်ညီသော ကုန်ပစ္စည်း မရှိပါ။',
    'products.empty_html':
      'ကိုက်ညီသော ကုန်ပစ္စည်း မရှိပါ။ <a href="/admin/products" class="font-semibold text-zinc-950 underline">Admin</a> တွင် ထည့်ပါ သို့မဟုတ် စစ်ထုတ်ချက်များ ရှင်းပါ။',
    'products.results_for': 'ရှာဖွေချက်',
    'products.results_sep': '—',
    'products.results_items': 'ခု။',

    'categories.title': 'အမျိုးအစားများ',
    'categories.sub': 'ဒေတာဘေ့စ်မှ အမျိုးအစားများ။',
    'categories.heading': 'ကုန်ပစ္စည်း အမျိုးအစားများ',
    'categories.lead': 'ဒေတာဘေ့စ်မှ — Admin တွင် ပုံများ တင်ပါ။',
    'categories.empty_html':
      'အမျိုးအစား မရှိသေးပါ။ <a href="/admin/categories" class="font-semibold text-zinc-950 underline">Admin → Categories</a> တွင် ဖန်တီးပါ။',
    'categories.browse_prod': 'ကုန်ပစ္စည်းကြည့်ရန်',
    'categories.view': 'ကြည့်ရန်',
    'categories.empty': 'အမျိုးအစား မရှိသေးပါ။ Admin တွင် ဖန်တီးပါ။',

    'cat_show.products': 'ကုန်ပစ္စည်းများ',
    'cat_show.empty': 'ဤအမျိုးအစားတွင် ကုန်ပစ္စည်း မရှိသေးပါ။',
    'cat_show.fallback_desc': 'ဤအမျိုးအစားမှ ကုန်ပစ္စည်းများ။',
    'cat_show.all_link': 'အမျိုးအစားအားလုံး',

    'product.back': 'နောက်သို့',
    'product.price': 'ဈေးနှုန်း:',
    'product.size': 'အရွယ်အစား',
    'product.size_select': 'ရွေးပါ',
    'product.qty': 'အရေအတွက်',
    'product.add': 'ခြင်းတောင်းထဲ ထည့်ရန်',
    'product.added': 'ထည့်ပြီး ✓',
    'product.select_size_alert': 'အရွယ်အစား ရွေးချယ်ပါ။',
    'product.category': 'အမျိုးအစား:',
    'product.note': 'ခြင်းတောင်း ဤစက်တွင် သိမ်းပါသည်။ ငွေပေးချေရန် ဝင်ရောက်ပါ။',
    'product.swipe_hint': 'ပိုပုံများအတွက် ဘေးသို့ ပွတ်ဆွဲပါ',

    'cart.title': 'ကျွန်ုပ်၏ ခြင်းတောင်း',
    'cart.sub': 'ဤစက်တွင် သိမ်းဆည်းထားသည်။',
    'cart.checkout': 'ငွေပေးချေရန်',
    'cart.signin_checkout': 'ငွေပေးချေရန် ဝင်ရောက်ပါ',
    'cart.empty_html':
      'ခြင်းတောင်း ဗလာဖြစ်နေပါသည်။ <a class="font-semibold text-zinc-950 underline" href="/products">ကုန်ပစ္စည်းကြည့်ရန်</a>',
    'cart.promo_note': 'ပရိုမိုကုဒ်များကို နောက်မှ ထည့်သွင်းနိုင်ပါသည်။',
    'cart.summary': 'စာရင်း',
    'cart.subtotal': 'စုစုပေါင်း',
    'cart.delivery': 'ပို့ဆောင်ခ',
    'cart.continue': 'ငွေပေးချေရန် ဆက်လုပ်ရန်',
    'cart.create_account': 'မှာယူရန် အကောင့်ဖွင့်ပါ',
    'cart.or_signin': 'သို့မဟုတ်',
    'cart.signin': 'ဝင်ရောက်ပါ',
    'cart.size_prefix': 'အရွယ်အစား:',
    'cart.remove_aria': 'ဖယ်ရှားရန်',
    'cart.alert_empty': 'ခြင်းတောင်း ဗလာဖြစ်နေပါသည်။',
    'checkout.empty': 'ခြင်းတောင်း ဗလာဖြစ်နေပါသည်။',

    'checkout.title': 'ငွေပေးချေရန်',
    'checkout.signed_in': 'ဝင်ရောက်ထားသူ',
    'checkout.payment_note':
      'မှာယူမှုကို အကောင့်တွင် သိမ်းပါသည်။ အခြေအနေကို ကျွန်ုပ်၏ မှာယူမှုများ တွင် ကြည့်နိုင်ပါသည်။ ငွေပေးချေမှုကို နောက်မှ ချိတ်ဆက်နိုင်ပါသည်။',
    'checkout.back_cart': 'ခြင်းတောင်းသို့ ပြန်သွားရန်',
    'checkout.full_name': 'အမည်အပြည့်အစုံ',
    'checkout.phone': 'ဖုန်း',
    'checkout.phone_ph': 'နောက်တစ်ဆင့်တွင် ထည့်ပါ',
    'checkout.address': 'ပို့ဆောင်ရမည့်လိပ်စာ',
    'checkout.address_ph': 'လမ်း၊ မြို့နယ်…',
    'checkout.note': 'ငွေပေးချေမှုကို နောက်မှ ချိတ်ဆက်နိုင်ပါသည်။',
    'checkout.summary': 'မှာယူမှုစာရင်း',
    'checkout.items': 'ပစ္စည်းများ',
    'checkout.subtotal': 'စုစုပေါင်း',
    'checkout.place': 'မှာယူမည်',
    'order.demo_thanks': 'ကျေးဇူးတင်ပါသည်။ (စမ်းသပ်မှု) မှာယူမှုကို မှတ်တမ်းတင်ပြီးပါပြီ။',
    'order.placed_ok': 'မှာယူမှု အောင်မြင်ပါသည် — မှာယူမှုစာမျက်နှာသို့…',
    'order.place_failed': 'မှာယူ၍ မရပါ။ ထပ်ကြိုးစားပါ။',

    'orders.title': 'ကျွန်ုပ်၏ မှာယူမှုများ',
    'orders.sub': 'မှာယူမှုတိုင်းအတွက် အခြေအနေနှင့် အသေးစိတ်။',
    'orders.shop': 'ဝယ်ယူရန်',
    'orders.empty': 'မှာယူမှု မရှိသေးပါ။ ကုန်ပစ္စည်းကြည့်ပြီး ငွေပေးချေရန်တွင် မှာယူပါ။',
    'orders.detail_title': 'မှာယူမှု',
    'orders.back_list': 'မှာယူမှုအားလုံး',
    'orders.items': 'ပစ္စည်းများ',
    'orders.size': 'အရွယ်အစား',
    'orders.subtotal': 'စုစုပေါင်း',
    'orders.delivery': 'ပို့ဆောင်မှု',
    'orders.phone': 'ဖုန်း',
    'orders.no_address': 'ဤမှာယူမှုတွင် လိပ်စာ မရှိပါ။',

    'contact.title': 'ဆက်သွယ်ရန်',
    'contact.sub': 'မြန်မာနိုင်ငံ ဖောက်သည်များ။ ဈေးနှုန်း MMK။',
    'contact.home_link': 'ပင်မစာမျက်နှာ',
    'contact.touch': 'ဆက်သွယ်ရန်',
    'contact.phone_row': 'ဖုန်း / Viber / WhatsApp',
    'contact.delivery_row': 'ပို့ဆောင်မှု',
    'contact.mm': 'မြန်မာ',
    'contact.dev_note':
      'ဖုန်းနံပါတ် ပြောင်းလဲလျှင် contact စာမျက်နှာ၊ ပင်မစာမျက်နှာ၊ store layout footer တို့ရှိ Blade တွင်ပြင်ဆင်ပါ။',
    'contact.quick': 'လုပ်ဆောင်ချက်များ',
    'contact.call': 'ခေါ်ဆိုရန်',
    'contact.browse': 'ကုန်ပစ္စည်းကြည့်ရန်',
    'contact.admin': 'Admin သို့',

    'auth.login_title': 'ဝင်ရောက်ရန်',
    'auth.login_sub': 'ငွေပေးချေရန် အကောင့် လိုအပ်ပါသည်။',
    'auth.email': 'အီးမေးလ်',
    'auth.password': 'စကားဝှက်',
    'auth.remember': 'မှတ်ထားရန်',
    'auth.signin_btn': 'ဝင်ရောက်ရန်',
    'auth.no_account': 'အကောင့် မရှိသေးဘူးလား?',
    'auth.create_one': 'ဖွင့်ရန်',

    'auth.reg_title': 'အကောင့်ဖွင့်ရန်',
    'auth.reg_sub': 'မှာယူရန် အကောင့်ဖွင့်ပါ။ ခြင်းတောင်း ဤစက်တွင် သိမ်းပါသည်။',
    'auth.name': 'အမည်အပြည့်အစုံ',
    'auth.password_confirm': 'စကားဝှက် အတည်ပြုရန်',
    'auth.pw_hint': 'အနည်းဆုံး ၈ လုံး။',
    'auth.create_btn': 'အကောင့်ဖွင့်ရန်',
    'auth.have_account': 'အကောင့် ရှိပြီးသားလား?',
    'auth.signin_link': 'ဝင်ရောက်ရန်',

  },
};

export function getLocale() {
  const v = localStorage.getItem(STORAGE_KEY);
  return v === 'my' ? 'my' : 'en';
}

export function t(key) {
  const code = getLocale();
  return STRINGS[code]?.[key] ?? STRINGS.en[key] ?? key;
}

export function applyStoreLocale() {
  const code = getLocale();
  const lang = code === 'my' ? 'my' : 'en';
  document.documentElement.lang = lang;
  document.documentElement.classList.toggle('locale-my', code === 'my');

  const dict = STRINGS[code] ?? STRINGS.en;

  document.querySelectorAll('[data-i18n]').forEach((el) => {
    const key = el.getAttribute('data-i18n');
    if (!key || !dict[key]) return;
    const val = dict[key];
    if (el.hasAttribute('data-i18n-html')) {
      el.innerHTML = val;
    } else {
      el.textContent = val;
    }
  });

  document.querySelectorAll('[data-i18n-placeholder]').forEach((el) => {
    const key = el.getAttribute('data-i18n-placeholder');
    if (key && dict[key]) el.setAttribute('placeholder', dict[key]);
  });

  document.querySelectorAll('[data-i18n-aria]').forEach((el) => {
    const key = el.getAttribute('data-i18n-aria');
    if (key && dict[key]) el.setAttribute('aria-label', dict[key]);
  });

  window.dispatchEvent(new CustomEvent('store-locale-changed', { detail: { locale: code } }));
}

export function setLocale(code) {
  if (code !== 'en' && code !== 'my') return;
  localStorage.setItem(STORAGE_KEY, code);
  applyStoreLocale();
  window.dispatchEvent(new CustomEvent('store-cart-changed'));
}

export function initLanguageSwitcher() {
  document.querySelectorAll('[data-locale-switch]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const v = btn.getAttribute('data-locale-switch');
      if (v === 'en' || v === 'my') setLocale(v);
    });
  });
}
