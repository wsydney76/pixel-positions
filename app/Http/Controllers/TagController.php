<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the tags.
     */
    public function index(): View
    {
        $tags = Tag::query()->withCount('jobs')->orderBy('name')->get();

        return view('tags.index', [
            'tags' => $tags,
        ]);
    }

    /**
     * Display the specified tag and its related jobs.
     */
    public function show(Tag $tag): View
    {
        $jobs = $tag
            ->jobs()
            ->with(['employer', 'tags'])
            ->latest()
            ->get();

        return view('tags.show', [
            'tag' => $tag,
            'jobs' => $jobs,
        ]);
    }
}
