<x-layouts.app>
    <x-page-heading>Edit Employer</x-page-heading>

    <div class="container mx-auto max-w-2xl py-8">
        <x-forms.form
            method="POST"
            action="{{ route('employers.update' , $employer) }}"
            enctype="multipart/form-data"
        >
            @method('PATCH')
            <x-forms.input label="Name" name="name" :value="$employer->name" />

            <x-forms.file label="Logo" name="logo">
                <x-employer-logo :employer width="120" />
            </x-forms.file>

            <x-forms.button>Update Employer</x-forms.button>
        </x-forms.form>
    </div>
</x-layouts.app>
