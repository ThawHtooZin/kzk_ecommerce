@php($title = 'Admin Login')
@extends('layouts.embed')

@section('content')
  <div class="mx-auto max-w-md">
    <div class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm">
      <div class="text-lg font-semibold tracking-tight">Admin login</div>
      <div class="mt-1 text-sm text-zinc-600">Sign in to manage products, categories, and orders.</div>

      <form method="post" action="{{ url('/admin/login') }}" class="mt-4 grid gap-3">
        @csrf

        <div>
          <label class="text-sm font-semibold">Email</label>
          <input
            name="email"
            type="email"
            value="{{ old('email') }}"
            class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400"
            autocomplete="username"
            required
          />
          @error('email')
            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label class="text-sm font-semibold">Password</label>
          <input
            name="password"
            type="password"
            class="mt-2 h-11 w-full rounded-xl border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-400"
            autocomplete="current-password"
            required
          />
          @error('password')
            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="mt-1 inline-flex h-11 items-center justify-center rounded-xl bg-zinc-950 px-4 text-sm font-semibold text-white hover:bg-zinc-900">
          Sign in
        </button>
      </form>
    </div>
  </div>
@endsection

