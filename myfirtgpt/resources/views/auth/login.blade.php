@extends('layouts.app')

@section('title', 'Administrator Login')

@section('content')
<section class="mx-auto flex min-h-[70vh] max-w-md items-center px-4 py-12 sm:px-6">
    <div class="w-full rounded-3xl border border-slate-200 bg-white p-7 shadow-xl sm:p-9">
        <div class="mb-8 text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-950 text-white">
                <i class="fa-solid fa-lock" aria-hidden="true"></i>
            </div>
            <h1 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-950">Administrator sign in</h1>
            <p class="mt-2 text-sm text-slate-600">Access the CMS administration area.</p>
        </div>

        @if ($errors->any())
            <div role="alert" class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                <p class="font-bold">Sign-in failed</p>
                <ul class="mt-1 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-bold text-slate-800">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 px-4 text-slate-950 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
            </div>
            <div>
                <label for="password" class="block text-sm font-bold text-slate-800">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="mt-2 min-h-12 w-full rounded-xl border border-slate-300 px-4 text-slate-950 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20">
            </div>
            <label class="flex items-center gap-3 text-sm text-slate-600">
                <input name="remember" type="checkbox" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-600">
                Remember this device
            </label>
            <button type="submit" class="min-h-12 w-full rounded-xl bg-slate-950 px-5 font-bold text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                Sign in
            </button>
        </form>
    </div>
</section>
@endsection
