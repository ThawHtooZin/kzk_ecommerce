@php($title = 'Create account')
@php($breadcrumbs = 'Home / Register')
@extends('layouts.store')

@section('content')
  <div class="mx-auto max-w-md">
    <h1 class="text-xl font-semibold tracking-tight" data-i18n="auth.reg_title">Create account</h1>
    <p class="mt-1 text-sm text-zinc-600" data-i18n="auth.reg_sub">Register to place orders. Your cart is saved on this device.</p>

    @if ($errors->any())
      <ul class="mt-4 list-inside list-disc rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    @endif

    <form method="post" action="{{ url('/register') }}" class="mt-6 grid gap-4 rounded-2xl border border-zinc-200 bg-white p-4">
      @csrf
      <div>
        <label class="text-sm font-semibold" for="name" data-i18n="auth.name">Full name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="email" data-i18n="auth.email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="password" data-i18n="auth.password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="new-password" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
        <p class="mt-1 text-xs text-zinc-500" data-i18n="auth.pw_hint">At least 8 characters.</p>
      </div>
      <div>
        <label class="text-sm font-semibold" for="password_confirmation" data-i18n="auth.password_confirm">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
      </div>
      <button type="submit" class="h-11 w-full rounded-xl bg-zinc-950 text-sm font-semibold text-white hover:bg-zinc-900" data-i18n="auth.create_btn">
        Create account
      </button>
    </form>

    <p class="mt-4 text-center text-sm text-zinc-600">
      <span data-i18n="auth.have_account">Already registered?</span>
      <a href="{{ url('/login') }}" class="font-semibold text-zinc-950 hover:underline" data-i18n="auth.signin_link">Sign in</a>
    </p>
  </div>
@endsection
