<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Demo extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    public function render()
    {
        $query = $this->search
            ? Job::whereFullText(['title', 'description'], $this->search, ['mode' => 'boolean'])
            : Job::orderBy('created_at', 'desc');

        return view('livewire.demo', [
            'jobs' => $query
                ->with(['employer', 'tags'])
                ->paginate(6),
        ]);
    }

    public function updated(): void
    {
        $this->resetPage();
    }
}
