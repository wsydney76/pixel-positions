<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\_IH_Job_QB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Livewire component for searching and filtering jobs.
 *
 * Provides filtering by employer, tag, search query, and sorting.
 * Handles pagination and dynamic dropdowns for employers and tags.
 */
class SearchJobs extends Component
{
    use WithPagination;

    /**
     * Selected employer filter.
     *
     * @var string
     */
    #[Url(history: true, except: '')]
    public string $employer = '';

    /**
     * Selected tag filter.
     *
     * @var string
     */
    #[Url(history: true, except: '')]
    public string $tag = '';

    /**
     * Search query string.
     *
     * @var string
     */
    #[Url(as: 'q', history: true, except: '')]
    public string $search = '';

    /**
     * Selected sort option.
     *
     * @var string
     */
    #[Url(history: true, except: 'title')]
    public string $sort = 'title';

    /**
     * Available sort options for jobs.
     *
     * @var array<int, array<string, string>>
     */
    public array $sortOptions = [
        ['label' => 'Title (A-Z)', 'value' => 'title'],
        ['label' => 'Latest', 'value' => 'latest'],
    ];

    /**
     * Number of jobs per page for pagination.
     *
     * @var int
     */
    protected int $perPage = 8;

    /**
     * Minimum length for search query to trigger filtering.
     *
     * @var int
     */
    public int $minSearchLength = 3;

    /**
     * Render the component view with filtered jobs.
     *
     * @return \Illuminate\View\View
     */
    public function render(): mixed
    {
        $query = $this->getQuery();

        // Get all jobs matching the current filters (without pagination)
        // to extract dynamic employers and tags for the dropdowns.
        // TODO: Depending on the size of the dataset, this may need optimization/a different approach.
        $jobs = $query->get();

        return view('livewire.search-jobs', [
            'jobs' => $query->paginate($this->perPage),
            'sql' => $query->toRawSql(),
            // Build employer dropdown options from filtered jobs
            'employers' => $jobs->pluck('employer.name')
                ->unique()
                ->sort()
                ->map(fn($e) => [
                    'label' => $e,
                    'value' => $e
                ])->prepend([
                    'label' => 'All Employers',
                    'value' => ''
                ]),
            // Build tag dropdown options from filtered jobs
            'tags' => $jobs
                ->pluck('tags.*.name')
                ->flatten()
                ->unique()
                ->sortBy(fn($t) => strtolower($t))
                ->map(fn($t) => [
                    'label' => strtolower($t),
                    'value' => $t
                ])
                ->prepend([
                    'label' => 'All Tags',
                    'value' => ''
                ])
        ]);
    }

    /**
     * Build the jobs query based on filters and search.
     *
     * @return Builder|_IH_Job_QB
     */
    protected function getQuery(): Builder|_IH_Job_QB
    {
        // Start query with eager loading employer and tags.
        $query = Job::query()
            ->with(['employer', 'tags']);

        // Filter by employer if selected.
        if ($this->employer) {
            $query->whereHas('employer', function($q) {
                $q->where('name', '=', $this->employer);
            });
        }

        // Filter by tag if selected.
        if ($this->tag) {
            $query->whereHas('tags', function($q) {
                $q->where('name', '=', $this->tag);
            });
        }

        // Filter by search term if long enough.
        if (strlen($this->search) >= $this->minSearchLength) {
            $term = "%{$this->search}%";
            $query->where(function($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('description', 'like', $term);
            });
        }

        // Apply sorting.
        if ($this->sort === 'latest') {
            $query->orderByDesc('created_at');
        } else {
            $query->orderBy('title');
        }

        return $query;
    }

    /**
     * Reset pagination when any property is updated.
     *
     * Called automatically by Livewire when a public property changes.
     *
     * @return void
     */
    public function updated(): void
    {
        $this->resetPage();
    }

    /**
     * Reset all filters and pagination.
     *
     * Resets employer, tag, search, and sort to their default values.
     *
     * @return void
     */
    public function resetFilters(): void
    {
        $this->reset(['employer', 'tag', 'search', 'sort']);
        $this->resetPage();
    }
}
