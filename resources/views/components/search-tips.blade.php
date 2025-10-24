
<div {{ $attributes }} x-data="{ open: false }" class="mb-4">
  <button type="button" @click="open = !open" class="text-sm focus:outline-none">
      <b>💡 Search Tips</b>
  </button>
  <div x-show="open" x-transition class="text-sm mt-2" style="display: none;">
    <b>"phrase"</b> → exact phrase<br>
    <b>+word</b> → must include<br>
    <b>-word</b> → exclude<br>
    <b>word*</b> → partial match (e.g. data, database)<br>
    <b>Words with spaces</b> → any match<br><br>
    <b>Examples:</b> "error log", +mysql -oracle, data*
  </div>
</div>

