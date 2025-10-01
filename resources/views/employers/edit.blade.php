<x-layout>
    <x-page-heading>Edit Employer</x-page-heading>

    <div class="container mx-auto max-w-2xl py-8">
        <x-forms.form method="POST" action="{{ route('employers.update' , $employer) }}"  enctype="multipart/form-data">
            @method('PATCH')
            <x-forms.input label="Name" name="name" :value="$employer->name"/>

            <div>
                Current Logo:
                <x-employer-logo :employer="$employer" width="120" />
            </div>

            <x-forms.input label="New Logo" name="logo" type="file" />

            <x-forms.button>Update Employer</x-forms.button>
        </x-forms.form>
    </div>

</x-layout>
