<?php

use App\Models\Job;
use App\Models\Tag;
use App\Models\Employer;

/* artisan test --testsuite=Feature --filter=TagPagesTest */

it('shows all tags alphabetically with counts and links', function () {
    // Create tags out of order
    $tagC = Tag::factory()->create(['name' => 'zulu']);
    $tagA = Tag::factory()->create(['name' => 'alpha']);
    $tagB = Tag::factory()->create(['name' => 'middle']);

    // Attach jobs to two tags to produce counts
    $job1 = Job::factory()->create();
    $job2 = Job::factory()->create();
    $job1->tags()->attach($tagA);
    $job2->tags()->attach($tagC);

    $response = $this->get(route('tags.index'));

    $response->assertOk();
    // Ensure alphabetical order (alpha, middle, zulu)
    $response->assertSeeInOrder(['alpha', 'middle', 'zulu']);
    // Counts
    $response->assertSee('1', false); // at least count badges present
    // Links
    $response->assertSee(route('tags.show', $tagA), false);
});

it('shows a tag page with only its related jobs', function () {
    $tag = Tag::factory()->create(['name' => 'backend']);
    $otherTag = Tag::factory()->create(['name' => 'frontend']);

    $jobWithTag1 = Job::factory()->create(['title' => 'Senior PHP Dev']);
    $jobWithTag2 = Job::factory()->create(['title' => 'Laravel Engineer']);
    $otherJob = Job::factory()->create(['title' => 'React Developer']);

    $jobWithTag1->tags()->attach($tag);
    $jobWithTag2->tags()->attach($tag);
    $otherJob->tags()->attach($otherTag);

    $response = $this->get(route('tags.show', $tag));

    $response->assertOk();
    $response->assertSee('Tag: backend');
    $response->assertSee($jobWithTag1->title);
    $response->assertSee($jobWithTag2->title);
    $response->assertDontSee($otherJob->title);
});

it('shows helpful message when a tag has no jobs', function () {
    $tag = Tag::factory()->create(['name' => 'emptytag']);

    $response = $this->get(route('tags.show', $tag));

    $response->assertOk();
    $response->assertSee('No jobs currently use this tag.');
});

