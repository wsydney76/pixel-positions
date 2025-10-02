<?php

namespace App\Livewire;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\_IH_Job_QB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SearchJobs extends Component
{
    use WithPagination;

    #[Url(history: true, except: '')]
    public $employer = '';

    #[Url(history: true, except: '')]
    public $tag = '';

    #[Url(as: 'q', history: true, except: '')]
    public $search = '';

    #[Url(history: true, except: 'title')]
    public $sort = 'title';

    public $employers;
    public $tags;
    public $sortOptions = [
        ['label' => 'Title (A-Z)', 'value' => 'title'],
        ['label' => 'Latest', 'value' => 'latest'],
    ];


    public $perPage = 8;

    public function mount(): void
    {
        $this->employers = Employer::orderBy('name')
            ->get()
            ->map(fn($e) => [
                'label' => $e->name,
                'value' => $e->name
            ])
            ->prepend([
                'label' => 'All Employers',
                'value' => ''
            ]);

        $this->tags = Tag::orderBy('name')
            ->get()
            ->map(fn($t) => [
                'label' => strtolower($t->name),
                'value' => $t->name
            ])
            ->prepend([
                'label' => 'All Tags',
                'value' => ''
            ]);
    }

    public function render(): mixed
    {
        $query = $this->getQuery();

        return view('livewire.search-jobs', [
            'jobs' => $query->paginate($this->perPage),
            'sql' => $query->toRawSql()
        ]);
    }

    /**
     * @return Builder|_IH_Job_QB
     */
    protected function getQuery(): _IH_Job_QB|Builder
    {
        $query = Job::query()
            ->with(['employer', 'tags']);

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
            $term = "%{$this->search}%";
            $query->where(function($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('description', 'like', $term);
            });
        }

        if ($this->sort === 'latest') {
            $query->orderByDesc('created_at');
        } else {
            $query->orderBy('title');
        }

        return $query;
    }

    public function updated(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['employer', 'tag', 'search', 'sort']);
        $this->resetPage();
    }
}
