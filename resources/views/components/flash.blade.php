@if(session('success'))
    <p class="my-8 px-8 py-4 text-green-800 border border-green-700 bg-green-200 rounded-xl">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="my-8 px-8 py-4 text-red-800 border border-red-700 bg-red-200 rounded-xl">{{ session('error') }}</p>
@endif
