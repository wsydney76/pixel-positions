<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class FullpageDemo extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    public function render()
    {
        return view(
            'livewire.fullpage-demo',
            [
                'jobs' => Job::with(['employer', 'tags'])
                    ->whereFullText(
                        ['title', 'description'],
                        $this->search,
                        ['mode' => 'boolean'])
                    ->paginate(6),
            ]);
    }

    public function performSearch(): void
    {
        if (trim($this->search) === '*') {
            $this->search = '';
        }
        $this->resetPage();
    }
}
