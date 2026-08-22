<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Company CMS') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background: #f5f7fb; font-family: Figtree, sans-serif; }
        .cms-shell { min-height: 100vh; }
        .cms-sidebar { width: 230px; background: #111827; color: #fff; position: fixed; inset: 0 auto 0 0; overflow-y: auto; padding: 22px 14px; }
        .cms-brand { font-size: 18px; font-weight: 700; padding: 0 10px 18px; border-bottom: 1px solid rgba(255,255,255,.12); margin-bottom: 14px; }
        .cms-sidebar a { display: block; color: #d1d5db; text-decoration: none; padding: 11px 12px; border-radius: 8px; margin: 4px 0; }
        .cms-sidebar a:hover, .cms-sidebar a.active { background: #2563eb; color: #fff; }
        .cms-main { margin-left: 230px; min-height: 100vh; }
        .cms-topbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: 0 24px; }
        .cms-content { padding: 28px; }
        .card { border: 0; border-radius: 12px; box-shadow: 0 4px 18px rgba(15,23,42,.06); }
        @media (max-width: 900px) {
            .cms-sidebar { position: static; width: 100%; }
            .cms-main { margin-left: 0; }
            .cms-sidebar a { display: inline-block; margin-right: 4px; }
        }
    </style>
</head>
<body>
<div class="cms-shell">
    <aside class="cms-sidebar">
        <div class="cms-brand">Company CMS</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">الخدمات</a>
        <a href="{{ route('admin.about.index') }}" class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}">النبذة</a>
        <a href="{{ route('admin.qwes.index') }}" class="{{ request()->routeIs('admin.qwes.*') ? 'active' : '' }}">الأسئلة الشائعة</a>
        <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">الأخبار</a>
        <a href="{{ route('admin.custom.index') }}" class="{{ request()->routeIs('admin.custom.*') ? 'active' : '' }}">العملاء</a>
        <a href="{{ route('admin.team.index') }}" class="{{ request()->routeIs('admin.team.*') ? 'active' : '' }}">فريق العمل</a>
        <a href="{{ route('admin.say.index') }}" class="{{ request()->routeIs('admin.say.*') ? 'active' : '' }}">ماذا قالوا</a>
    </aside>

    <div class="cms-main">
        <div class="cms-topbar">
            @include('admin.layouts.navigation')
        </div>

        <main class="cms-content">
            @if (session('flash_message'))
                <div class="alert alert-success">{{ session('flash_message') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @hasSection('content')
                @yield('content')
            @else
                {{ $slot ?? '' }}
            @endif
        </main>
    </div>
</div>
</body>
</html>
