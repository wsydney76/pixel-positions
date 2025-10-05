<?php

use App\Models\Employer;
use App\Models\Job;

/* artisan test --testsuite=Feature --filter=EmployerShowTest */

it('shows an employer name as title and lists its jobs only', function () {
    $employer = Employer::factory()->create(['name' => 'Acme Corp']);
    $jobs = Job::factory()->count(2)->for($employer)->create();

    $otherJob = Job::factory()->create();

    $response = $this->get(route('employers.show', $employer));

    $response->assertOk();
    $response->assertSee('Acme Corp');

    foreach ($jobs as $job) {
        $response->assertSee($job->title);
    }

    $response->assertDontSee($otherJob->title);
});

it('returns 404 for a non-existing employer', function () {
    $this->get('/employers/999999')->assertNotFound();
});

