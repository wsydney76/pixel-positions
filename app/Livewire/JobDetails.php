<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Attributes\On;
use Livewire\Component;
use function sleep;

class JobDetails extends Component
{
    public ?Job $job = null;

    public function render()
    {
        return view('livewire.job-details');
    }

    #[On('load-job-details')]
    public function loadJobDetails(int $id): void
    {
        $this->job = Job::findOrFail($id);
        $this->dispatch('job-details-loaded');
    }
}
