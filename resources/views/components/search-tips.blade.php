<div {{ $attributes->merge(['class' => 'mb-4 text-sm']) }}
     x-data="{ open: false }">

    <button class="cursor-pointer text-sm focus:outline-none"
            type="button"
            @click="open = !open">
        <b>💡 Search Tips</b>
    </button>

    <div class="mt-2 pl-6"
         x-show="open"
         x-transition
         x-cloak>
        <b>"phrase"</b> → exact phrase<br>
        <b>+word</b> → must include<br>
        <b>-word</b> → exclude<br>
        <b>word*</b> → partial match (e.g. data, database)<br>
        <b>Words with spaces</b> → any match<br><br>
        <b>Examples:</b> "project manager", developer +craft, manager -project, dev*
    </div>

</div>

