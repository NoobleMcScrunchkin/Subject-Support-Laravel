<x-app-layout>
    <x-form-card>
        @if ($edit)
        <form method="POST" action="{{ route('editTeacher', ['id' => $teacher['id']]) }}">
        @else
        <form method="POST" action="{{ route('newTeacher') }}">
        @endif
            @csrf

            <div>
                <x-label for="firstname" :value="__('Firstname')" />

                <input id="firstname" 
                    value = "{{ $edit ? $teacher['firstname'] : "" }}"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="text"
                    name="firstname"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="surname" :value="__('Surname')" />

                <input id="surname" 
                    value = "{{ $edit ? $teacher['surname'] : "" }}"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="text"
                    name="surname"
                    required />
            </div>

            <div class="flex items-center justify-end mt-4">
                @if ($edit)
                    <x-button type="button" class="ml-3" data-bs-toggle="modal" data-bs-target="#resetPopup">
                        {{ __('Reset Password') }}
                    </x-button>
                @endif
                <x-button class="ml-3">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
        @if ($edit)
            <form id="resetPassForm" method="POST" action="/resetTeacherPass/{{ $teacher['id'] }}" hidden></form>
            <div class="modal fade" id="resetPopup" tabindex="-1" aria-labelledby="resetPopupLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resetPopupLabel">Reset Password?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to reset the password for {{ $teacher['firstname'] }} {{ $teacher['surname'] }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick='document.getElementById("resetPassForm").submit()' class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
        @endif
    </x-form-card>
</x-app-layout>