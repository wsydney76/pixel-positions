<?php

namespace App\Livewire;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class SearchJobs extends Component
{
    use WithPagination;

    public $search = '';
    public $employerId = '';
    public $tagId = '';
    protected $queryString = [
        'search' => ['except' => ''],
        'employerId' => ['except' => ''],
        'tagId' => ['except' => ''],
    ];

    public function render(): mixed
    {

        $jobsQuery = Job::query()
            ->with(['employer', 'tags'])
            ->orderBy('title');

        if (strlen($this->search) >= 3) {
            $jobsQuery->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->employerId) {
            $jobsQuery->where('employer_id', $this->employerId);
        }

        if ($this->tagId) {
            $jobsQuery->whereHas('tags', function($q) {
                $q->where('tags.id', $this->tagId);
            });
        }

        $jobs = $jobsQuery->paginate(8);

        return view('livewire.search-jobs', [
            'employers' => Employer::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
            'jobs' => $jobs,
        ]);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedEmployerId(): void
    {
        $this->resetPage();
    }

    public function updatedTagId(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->employerId = '';
        $this->tagId = '';
        $this->resetPage();
    }
}
