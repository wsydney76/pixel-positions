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
    public $employers;
    public $tags;
    protected $queryString = [
        'search' => ['except' => ''],
        'employerId' => ['except' => ''],
        'tagId' => ['except' => ''],
    ];

    public function render()
    {
        $this->employers = Employer::orderBy('name')->get();
        $this->tags = Tag::orderBy('name')->get();

        $execSearch = strlen($this->search) >= 3 || $this->employerId || $this->tagId;

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

        $jobs = $execSearch ? $jobsQuery->paginate(8) : collect();

        return view('livewire.search-jobs', [
            'jobs' => $jobs,
            'execSearch' => $execSearch,
            'employers' => $this->employers,
            'employerId' => $this->employerId,
            'tags' => $this->tags,
            'tagId' => $this->tagId,
        ]);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->employerId = '';
        $this->tagId = '';
        $this->resetPage();
    }
}
