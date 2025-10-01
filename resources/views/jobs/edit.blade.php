<x-layout>
    <x-page-heading>Edit Job</x-page-heading>
    <div class="container mx-auto max-w-2xl py-8">
        <x-forms.form method="POST" action="{{ route('jobs.update' , $job) }}">
            @method('PATCH')
            <x-forms.input label="Title" name="title" :value="$job->title"/>
            <x-forms.input label="Salary" name="salary" :value="$job->salary"/>
            <x-forms.input label="Location" name="location" :value="$job->location"/>
            <x-forms.textarea label="Description" :value="$job->description"
                              name="description"></x-forms.textarea>
            <x-forms.select label="Schedule" name="schedule" :value="$job->schedule">
                <option value="Part Time" @selected(old('schedule', $job->schedule) === 'Part Time')>Part Time</option>
                <option value="Full Time" @selected(old('schedule', $job->schedule) === 'Full Time')>Full Time</option>
            </x-forms.select>
            <x-forms.input label="URL" name="url" :value="$job->url"/>



            <x-forms.checkbox label="Feature (Costs Extra)" name="featured" :value="$job->featured == 1"/>
            <x-forms.input label="Tags (comma separated)" name="tags"
                           :value="$job->tags->pluck('name')->implode(', ')"/>
            <x-forms.button>Update Job</x-forms.button>
        </x-forms.form>
    </div>
</x-layout>>

