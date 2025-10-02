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
use function dd;

/**
 * Livewire component for searching and filtering jobs.
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
    public $employer = '';

    /**
     * Selected tag filter.
     *
     * @var string
     */
    #[Url(history: true, except: '')]
    public $tag = '';

    /**
     * Search query string.
     *
     * @var string
     */
    #[Url(as: 'q', history: true, except: '')]
    public $search = '';

    /**
     * Selected sort option.
     *
     * @var string
     */
    #[Url(history: true, except: 'title')]
    public string $sort = 'title';

    /**
     * Available sort options.
     *
     * @var array
     */
    public array $sortOptions = [
        ['label' => 'Title (A-Z)', 'value' => 'title'],
        ['label' => 'Latest', 'value' => 'latest'],
    ];


    /**
     * Number of jobs per page.
     *
     * @var int
     */
    protected $perPage = 8;

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
        // No longer needed: dropdowns are now dynamic in render().
    }

    /**
     * Render the component view with filtered jobs.
     *
     * @return mixed
     */
    public function render(): mixed
    {
        $query = $this->getQuery();

        // Get all jobs matching the current filters (without pagination)
        $jobs = $query->get();

        return view('livewire.search-jobs', [
            'jobs' => $query->paginate($this->perPage),
            'sql' => $query->toRawSql(),
            'employers' => $this->getEmployersForJobs($query, $jobs),
            'tags' => $this->getTagsForJobs($query, $jobs)
        ]);
    }

    /**
     * Build the jobs query based on filters and search.
     *
     * @return Builder|_IH_Job_QB
     */
    protected function getQuery(): _IH_Job_QB|Builder
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
     * @param Builder|_IH_Job_QB $query
     * @return Collection
     */
    protected function getEmployersForJobs(Builder|_IH_Job_QB $query, Collection $jobs): Collection
    {
        // Drilldown: dynamically build employer options
        if (empty($this->employer)) {
            // Get employers related to found jobs
            $employerIds = $jobs->pluck('employer_id')->unique();
            $employers = Employer::whereIn('id', $employerIds)
                ->orderBy('name')
                ->get()
                ->map(fn($e) => [
                    'label' => $e->name,
                    'value' => $e->name
                ]);
        } else {
            // Only show the selected employer
            $employers = collect([
                [
                    'label' => $this->employer,
                    'value' => $this->employer
                ]
            ]);
        }

        return $employers->prepend([
            'label' => 'All Employers',
            'value' => ''
        ]);
    }

    /**
     * @param Builder|_IH_Job_QB $query
     * @return Collection
     */
    protected function getTagsForJobs(Builder|_IH_Job_QB $query, Collection $jobs): Collection
    {
        // Drilldown: dynamically build tag options
        if (empty($this->tag)) {
            // Get tags related to found jobs
            $jobIds = $jobs->pluck('id');
            $tagIds = \DB::table('job_tag')
                ->whereIn('job_id', $jobIds)
                ->pluck('tag_id')
                ->unique();
            $tags = Tag::whereIn('id', $tagIds)
                ->orderBy('name')
                ->get()
                ->map(fn($t) => [
                    'label' => strtolower($t->name),
                    'value' => $t->name
                ]);
        } else {
            // Only show the selected tag
            $tags = collect([
                [
                    'label' => $this->tag,
                    'value' => $this->tag
                ]
            ]);
        }

        return $tags->prepend([
            'label' => 'All Tags',
            'value' => ''
        ]);
    }

    /**
     * Reset pagination when any property is updated.
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
     * @return void
     */
    public function resetFilters(): void
    {
        $this->reset(['employer', 'tag', 'search', 'sort']);
        $this->resetPage();
    }
}
