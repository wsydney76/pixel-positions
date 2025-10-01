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
    public $employer = '';
    public $tag = '';
    public $sort = 'title';

    public $employers;
    public $tags;

    protected $queryString = [
        'employer' => ['except' => ''],
        'tag' => ['except' => ''],
        'search' => ['except' => ''],
        'sort' => ['except' => 'title'],
    ];

    public function mount()
    {
        $this->employers = Employer::orderBy('name')->pluck('name');
        $this->tags = Tag::orderBy('name')->pluck('name');
    }

    public function render(): mixed
    {
        $jobsQuery = Job::query()
            ->with(['employer', 'tags']);

        if ($this->sort === 'latest') {
            $jobsQuery->orderByDesc('created_at');
        } else {
            $jobsQuery->orderBy('title');
        }

        if ($this->employer) {
            $jobsQuery->whereHas('employer', function($q) {
                $q->where('name', $this->employer);
            });
        }

        if ($this->tag) {
            $jobsQuery->whereHas('tags', function($q) {
                $q->where('tags.name', $this->tag);
            });
        }

        if (strlen($this->search) >= 3) {
            $jobsQuery->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        $jobs = $jobsQuery->paginate(8);

        return view('livewire.search-jobs', [
            'employers' => $this->employers,
            'tags' => $this->tags,
            'jobs' => $jobs,
            'sql' => $jobsQuery->toRawSql()
        ]);
    }

    public function updated($propertyName): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'employer', 'tag', 'sort']);
        $this->resetPage();
    }
}
