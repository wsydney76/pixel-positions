<?php

namespace App\Livewire;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
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
class JobsSearch extends Component
{
    use WithPagination;

    public string $facetMethod = 'all'; // 'all' or 'query'

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

    // Collections for dropdown options
    public Collection $employers;
    public Collection $tags;

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
     * Initialize filter dropdowns with available employers and tags.
     *
     * @return void
     */
    public function mount(): void
    {
        if ($this->facetMethod === 'all') {
            $this->setFacets();
        }
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
     * Render the component view with filtered jobs.
     *
     * @return \Illuminate\View\View
     */
    public function render(): mixed
    {
        $query = $this->getQuery();

        if ($this->facetMethod === 'query') {
            $this->setFacetsForQuery($query);
        }

        return view('livewire.jobs-search', [
            // Paginated jobs for display
            'jobs' => $query->paginate($this->perPage),

            // For debugging: show the raw SQL query being executed
            'sql' => $query->toRawSql(),
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
        $query = Job::query()->with(['employer', 'tags']);

        // Filter by employer if selected.
        if ($this->employer) {
            $query->whereHas('employer', function ($q) {
                $q->where('name', '=', $this->employer);
            });
        }

        // Filter by tag if selected.
        if ($this->tag) {
            $query->whereHas('tags', function ($q) {
                $q->where('name', '=', $this->tag);
            });
        }

        // Filter by search term if long enough.
        if (strlen($this->search) >= $this->minSearchLength) {
            $term = "%{$this->search}%";
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)->orWhere('description', 'like', $term);
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
     * @return void
     */
    protected function setFacets(): void
    {
        // Get employers that have jobs and prepare dropdown options.
        $this->employers = Employer::query()
            ->whereHas('jobs')
            ->orderBy('name')
            ->get()
            ->map(
                fn($e) => [
                    'label' => $e->name,
                    'value' => $e->name,
                ],
            )
            ->prepend([
                'label' => 'All Employers',
                'value' => '',
            ]);

        // Get tags that have jobs and prepare dropdown options.
        $this->tags = Tag::query()
            ->whereHas('jobs')
            ->orderBy('name')
            ->get()
            ->map(
                fn($t) => [
                    'label' => strtolower($t->name),
                    'value' => $t->name,
                ],
            )
            ->prepend([
                'label' => 'All Tags',
                'value' => '',
            ]);
    }

    /**
     * @param Builder|_IH_Job_QB $query
     * @return void
     */
    protected function setFacetsForQuery(Builder|_IH_Job_QB $query): void
    {
        // Get all jobs matching the current filters (without pagination)
        // to extract dynamic employers and tags for the dropdowns.
        // TODO: Depending on the size of the dataset, this may need optimization/a different approach.
        $jobs = $query->get();

        $this->employers = $jobs
            ->pluck('employer.name')
            ->unique()
            ->sort()
            ->map(
                fn($e) => [
                    'label' => $e,
                    'value' => $e,
                ],
            )
            ->prepend([
                'label' => 'All Employers',
                'value' => '',
            ]);

        $this->tags = $jobs
            ->pluck('tags.*.name')
            ->flatten()
            ->unique()
            ->sortBy(fn($t) => strtolower($t))
            ->map(
                fn($t) => [
                    'label' => strtolower($t),
                    'value' => $t,
                ],
            )
            ->prepend([
                'label' => 'All Tags',
                'value' => '',
            ]);
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
