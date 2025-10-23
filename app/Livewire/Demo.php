<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Demo extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    public function updated(): void
    {
        $this->resetPage();
    }

    public function render(): Factory|ViewContract|View
    {
        $query = Job::query();
        if ($this->search) {
           $query->whereFullText('title', $this->search, ['mode' => 'boolean']);
        } else {
           $query->orderBy('created_at', 'desc');
        }

        return view('livewire.demo', [
            'jobs' => $query->paginate(6),
        ]);
    }
}
