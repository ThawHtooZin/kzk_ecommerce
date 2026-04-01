@php($title = 'Sign in')
@php($breadcrumbs = 'Home / Sign in')
@extends('layouts.store')

@section('content')
  <div class="mx-auto max-w-md">
    <h1 class="text-xl font-semibold tracking-tight" data-i18n="auth.login_title">Sign in</h1>
    <p class="mt-1 text-sm text-zinc-600" data-i18n="auth.login_sub">You need an account before checkout. Sign in to continue.</p>

    @if ($errors->any())
      <div class="mt-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="post" action="{{ url('/login') }}" class="mt-6 grid gap-4 rounded-2xl border border-zinc-200 bg-white p-4">
      @csrf
      <div>
        <label class="text-sm font-semibold" for="email" data-i18n="auth.email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
      </div>
      <div>
        <label class="text-sm font-semibold" for="password" data-i18n="auth.password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password" class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400" />
      </div>
      <label class="flex items-center gap-2 text-sm text-zinc-700">
        <input type="checkbox" name="remember" value="1" class="rounded border-zinc-300" />
        <span data-i18n="auth.remember">Remember me</span>
      </label>
      <button type="submit" class="h-11 w-full rounded-xl bg-zinc-950 text-sm font-semibold text-white hover:bg-zinc-900" data-i18n="auth.signin_btn">
        Sign in
      </button>
    </form>

    <p class="mt-4 text-center text-sm text-zinc-600">
      <span data-i18n="auth.no_account">No account yet?</span>
      <a href="{{ url('/register') }}" class="font-semibold text-zinc-950 hover:underline" data-i18n="auth.create_one">Create one</a>
    </p>
  </div>
@endsection
