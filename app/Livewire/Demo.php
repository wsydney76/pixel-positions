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
        $query = Job::query()->orderByDesc('created_at');
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        return view('livewire.demo', [
            'jobs' => $query->paginate(6),
        ]);
    }
}
