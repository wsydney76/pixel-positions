<!doctype html>
<html lang="en" style="overflow-y: scroll;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Pixel Positions</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap">

    @vite(['resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>

</head>

<body class="bg-white text-black font-hanken-grotesk pb-20 dark:bg-black dark:text-white">

<a href="#content" class="sr-only focus:not-sr-only absolute left-4 top-4 bg-black text-white px-4 py-2 rounded z-50">Skip to content</a>

<div class="px-10">
    <nav
        class="-mx-10  px-10 bg-black text-white flex justify-between items-center py-4 dark:border-b dark:border-white/10">
        <div>
            <a href="/">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="">
            </a>
        </div>

        <div class="space-x-6 font-bold">
            <a href="/">Jobs</a>
            {{--<a href="#">Careers</a>
            <a href="#">Salaries</a>--}}
            <a href="{{ route('employers.index') }}">Employers</a>
            <a href="{{ route('tags.index') }}">Tags</a>
            <a href="{{ route('jobs.search') }}">Search</a>
            <a href="{{ route('demo') }}">Demo (Fullpage)</a>
        </div>

        @auth
            <div class="space-x-6 font-bold flex">
                <div>
                    {{ Auth::user()->name ?? '' }}
                </div>
                <a href="/jobs/create">Post a Job</a>

                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')

                    <button>Log Out</button>
                </form>
            </div>
        @endauth

        @guest
            <div class="space-x-6 font-bold">
                <a href="/register">Sign Up</a>
                <a href="/login">Log In</a>
            </div>
        @endguest
    </nav>

    <main id="content" class="mt-10 max-w-[986px] mx-auto">
        <x-flash/>

        {{ $slot }}
    </main>
</div>

@livewireScriptConfig

</body>
</html>
