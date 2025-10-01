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
    public $sortOptions = [
        ['label' => 'Title (A-Z)', 'value' => 'title'],
        ['label' => 'Latest', 'value' => 'latest'],
    ];

    protected $queryString = [
        'employer' => ['except' => ''],
        'tag' => ['except' => ''],
        'search' => ['except' => ''],
        'sort' => ['except' => 'title'],
    ];

    public $perPage = 8;

    public function mount(): void
    {
        $this->employers = Employer::orderBy('name')->get()
            ->map(fn($e) => ['label' => $e->name, 'value' => $e->name])
            ->prepend(['label' => 'All Employers', 'value' => '']);

        $this->tags = Tag::orderBy('name')->get()
            ->map(fn($t) => ['label' => strtolower($t->name), 'value' => $t->name])
            ->prepend(['label' => 'All Tags', 'value' => '']);
    }

    public function render(): mixed
    {
        $query = Job::query()
            ->with(['employer', 'tags']);

        if ($this->sort === 'latest') {
            $query->orderByDesc('created_at');
        } else {
            $query->orderBy('title');
        }

        if ($this->employer) {
            $query->whereHas('employer', function($q) {
                $q->where('name', '=', $this->employer);
            });
        }

        if ($this->tag) {
            $query->whereHas('tags', function($q) {
                $q->where('name', '=', $this->tag);
            });
        }

        if (strlen($this->search) >= 3) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.search-jobs', [
            'jobs' => $query->paginate($this->perPage),
            'sql' => $query->toRawSql()
        ]);
    }

    public function updated(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'employer', 'tag', 'sort']);
        $this->resetPage();
    }
}
