<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;

class CleanupTags extends Command
{
    protected $signature = 'tags:cleanup';
    protected $description = 'Delete tags not related to any job after confirmation';

    public function handle(): int
    {
        $unusedTags = Tag::doesntHave('jobs')->get();

        if ($unusedTags->isEmpty()) {
            $this->info('No unused tags found.');
            return 0;
        }

        $this->info('Unused tags:');
        foreach ($unusedTags as $tag) {
            $this->line("- {$tag->name} (ID: {$tag->id})");
        }

        if ($this->confirm('Do you want to delete these tags?')) {
            $count = $unusedTags->count();
            Tag::whereIn('id', $unusedTags->pluck('id'))->delete();
            $this->info("Deleted {$count} unused tags.");
        } else {
            $this->info('No tags were deleted.');
        }
        return 0;
    }
}

