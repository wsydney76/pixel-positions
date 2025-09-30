<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Job;

class JobsList extends Component
{
    use WithPagination;

    public function render()
    {
        $jobs = Job::latest()
            ->with(['employer', 'tags'])
            ->paginate(6);

        return view('livewire.jobs-list', [
            'jobs' => $jobs,
        ]);
    }
}
