@php
    $route = Route::currentRouteName();
    // Teks dinamis yang lebih bermakna
    $text = 'Welcome Back'; 

    if ($route === 'login') {
        $text = 'Sign in';
    } elseif ($route === 'register') {
        $text = 'Create Account';
    }
@endphp

<div class="flex flex-col items-center justify-center text-center">
    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">
        {{ $text }}
    </h1>
    <p class="text-slate-500 text-sm mt-2 font-medium">to BlogKu</p>
</div>