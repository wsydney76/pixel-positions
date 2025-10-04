@if (session('success'))
    <p class="my-8 rounded-xl border border-green-700 bg-green-200 px-8 py-4 text-green-800">
        {{ session('success') }}
    </p>
@endif

@if (session('error'))
    <p class="my-8 rounded-xl border border-red-700 bg-red-200 px-8 py-4 text-red-800">
        {{ session('error') }}
    </p>
@endif
