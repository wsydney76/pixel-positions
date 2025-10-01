<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchJobs extends Component
{

    public $search = '';
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {

        $execSearch = strlen($this->search) >= 3;
        $jobs = $execSearch ? Job::query()
            ->with(['employer', 'tags'])
            ->orderBy('title')
            ->where('title', 'LIKE', '%'. $this->search .'%')
            ->orWhere('description', 'LIKE', '%'. $this->search .'%')
            ->get() : Collection::make();

        return view('livewire.search-jobs', [
            'jobs' => $jobs,
            'execSearch' => $execSearch
        ]);
    }
}
