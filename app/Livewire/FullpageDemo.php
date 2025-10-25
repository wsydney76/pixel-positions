<?php

namespace App\Livewire;

use App\Models\Job;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Livewire component that provides a searchable, paginated list of Job models.
 *
 * This component binds the search term to the URL (history enabled), performs a
 * full-text search against title/description, and paginates results.
 */
class FullpageDemo extends Component
{
    /**
     * Adds pagination helpers (resetPage, page tracking) for Livewire components.
     */
    use WithPagination;

    /**
     * Search query string bound to the URL (history enabled).
     *
     * The Url attribute keeps the search state in the browser URL and enables
     * back/forward navigation for search changes.
     *
     */
    #[Url(history: true)]
    public string $search = '';

    /**
     * Render the component view with paginated job results.
     *
     * Builds a full-text search query on the title and description fields and
     * eager-loads relationships used by the view.
     *
     * We need to pass the found jobs via 'data' instead of using a state $this->jobs
     * because paginate() returns a type that is not serializable.
     *
     */
    public function render(): ContractsView|Factory|View
{
    // Trim the search term to ignore surrounding whitespace and decide which query to use.
    // If non-empty, perform a full-text search on title and description in boolean mode.
    // Otherwise, return jobs ordered by newest first.
    $query = trim($this->search)
        ? Job::whereFullText(['title', 'description'], $this->search, ['mode' => 'boolean'])
        : Job::orderByDesc('created_at');

    // Build the view payload: eager-load relationships used by the view and paginate.
    // Pagination result is passed as 'jobs' (not stored on the component) because
    // the paginator object is not serializable as component state.
    return view(
        'livewire.fullpage-demo',
        [
            'jobs' => $query
                ->with(['employer', 'tags']) // eager-load to avoid N+1 queries in the view
                ->paginate(6),               // 6 items per page
        ]
    );
}

    /**
     * Called when the user triggers a search action.
     *
     * resetPage() ensures pagination returns to page 1 when the search term changes,
     * preventing invalid/empty pages after filtering.
     *
     * The render() method will be called automatically after this method completes.
     *
     */
    public function performSearch(): void
    {
        if (trim($this->search) === '*') {
            // Avoid runtime error, * can only be used as a wildcard in boolean mode.
            $this->search = '';
        }

        // Reset pagination to the first page when a new search is performed.
        $this->resetPage();
    }

}
