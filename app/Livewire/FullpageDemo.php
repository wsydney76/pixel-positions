<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class FullpageDemo extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    public function render(): ContractsView|Factory|View
    {
        $query = trim($this->search)
            ? Job::whereFullText(['title', 'description'], $this->search, ['mode' => 'boolean'])
            : Job::orderByDesc('created_at');

        return view(
            'livewire.fullpage-demo',
            [
                'jobs' => $query
                    ->with(['employer', 'tags'])
                    ->paginate(6)
            ]
        );
    }

    public function updatedSearch(): void
    {
        if (trim($this->search) === '*') {
            // Avoid runtime error, * can only be used as a wildcard in boolean mode.
            $this->search = '';
        }

        $this->resetPage();
    }

}
