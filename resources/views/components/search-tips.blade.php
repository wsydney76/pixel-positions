<div {{ $attributes->merge(['class' => 'mb-4 text-sm']) }}
     x-data="{ open: false }">

    <button id="search-tips-button"
            class="cursor-pointer text-sm focus:outline-none"
            type="button"
            @click="open = !open"
            :aria-expanded="open"
            aria-controls="search-tips-panel">
        <b>💡 Search Tips</b>
    </button>

    <div id="search-tips-panel"
         class="mt-2 pl-6"
         role="region"
         aria-labelledby="search-tips-button"
         x-show="open"
         x-transition
         x-cloak
         :aria-hidden="!open">
        <b>"phrase"</b> → exact phrase<br>
        <b>+word</b> → must include<br>
        <b>-word</b> → exclude<br>
        <b>word*</b> → partial match (e.g. data, database)<br>
        <b>Words with spaces</b> → any match<br><br>
        <b>Examples:</b> "project manager", developer +craft, manager -project, dev*
    </div>

</div>
