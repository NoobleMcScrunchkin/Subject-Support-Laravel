<x-app-layout>
    <x-form-card>
        <form method="POST" action="{{ route('changePassword') }}">
            @csrf

            <div>
                <x-label for="oldPassword" :value="__('Current Password')" />

                <input id="oldPassword"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="password"
                    name="oldPassword"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="newPassword" :value="__('New Password')" />

                <input id="newPassword" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="password"
                    name="newPassword"
                    onkeyup = "if (this.value == document.getElementById('confirmation').value) {document.getElementById('saveBtn').disabled = false;} else {document.getElementById('saveBtn').disabled = true}"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="confirmation" :value="__('Confirm Password')" />

                <input id="confirmation" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="password"
                    name="confirmation"
                    onkeyup = "if (this.value == document.getElementById('newPassword').value) {document.getElementById('saveBtn').disabled = false;} else {document.getElementById('saveBtn').disabled = true}"
                    required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button id="saveBtn" class="ml-3" disabled>
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
