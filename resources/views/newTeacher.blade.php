<x-app-layout>
    <x-form-card>
        <form method="POST" action="{{ route('newTeacher') }}">
            @csrf

            <div>
                <x-label for="firstname" :value="__('Firstname')" />

                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="surname" :value="__('Surname')" />

                <x-input id="surname" class="block mt-1 w-full"
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
