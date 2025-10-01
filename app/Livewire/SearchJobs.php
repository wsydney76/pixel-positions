<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchJobs extends Component
{

    public $search = '';
    public $employerId = '';
    public $employers;
    protected $queryString = [
        'search' => ['except' => ''],
        'employerId' => ['except' => ''],
    ];

    public function render()
    {
        $this->employers = \App\Models\Employer::orderBy('name')->get();
        $execSearch = strlen($this->search) >= 3 || $this->employerId;
        $jobsQuery = $execSearch ? Job::query()
            ->with(['employer', 'tags'])
            ->orderBy('title')
            ->where(function($q) {
                $q->where('title', 'LIKE', '%'. $this->search .'%')
                  ->orWhere('description', 'LIKE', '%'. $this->search .'%');
            }) : Job::query()->whereRaw('0=1');

        if ($this->employerId) {
            $jobsQuery->where('employer_id', $this->employerId);
        }

        $jobs = $execSearch ? $jobsQuery->get() : collect();
        return view('livewire.search-jobs', [
            'jobs' => $jobs,
            'execSearch' => $execSearch,
            'employers' => $this->employers,
            'employerId' => $this->employerId,
        ]);
    }
}
