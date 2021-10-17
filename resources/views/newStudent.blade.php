<x-app-layout>
    <x-form-card>
        @if (isset($student))
        <form method="POST" action="{{ route('editStudent', ['id' => $student['id']]) }}">
        @else
        <form method="POST" action="{{ route('newStudent') }}">
        @endif
            @csrf

            <div>
                <x-label for="firstname" :value="__('Firstname')" />

                <input id="firstname" 
                    value = "{{ isset($student) ? $student['firstname'] : "" }}"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="text"
                    name="firstname"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="surname" :value="__('Surname')" />

                <input id="surname" 
                    value = "{{ isset($student) ? $student['surname'] : "" }}"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="text"
                    name="surname"
                    required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
