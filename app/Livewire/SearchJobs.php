<?php

namespace App\Livewire;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchJobs extends Component
{

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

        if ($this->tagId) {
            $jobsQuery->whereHas('tags', function($q) {
                $q->where('tags.id', $this->tagId);
            });
        }

        $jobs = $execSearch ? $jobsQuery->get() : collect();

        return view('livewire.search-jobs', [
            'jobs' => $jobs,
            'execSearch' => $execSearch,
            'employers' => $this->employers,
            'employerId' => $this->employerId,
            'tags' => $this->tags,
            'tagId' => $this->tagId,
        ]);
    }
}
