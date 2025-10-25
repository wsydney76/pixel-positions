
<div {{ $attributes->merge(['class' => 'mb-4 text-sm']) }} x-data="{ open: false }">
  <button type="button" @click="open = !open" class="text-sm focus:outline-none cursor-pointer">
      <b>💡 Search Tips</b>
  </button>
  <div x-show="open" x-transition x-cloak class="pl-6 mt-2">
    <b>"phrase"</b> → exact phrase<br>
    <b>+word</b> → must include<br>
    <b>-word</b> → exclude<br>
    <b>word*</b> → partial match (e.g. data, database)<br>
    <b>Words with spaces</b> → any match<br><br>
    <b>Examples:</b> "error log", +mysql -oracle, data*
  </div>
</div>

