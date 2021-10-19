<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-striped border table-hover">
                        <thead>
                            <tr>
                                <th>Surname</th>
                                <th>Firstname</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher['surname'] }}</td>
                                    <td class="w-100">{{ $teacher['firstname'] }}</td>
                                    <td class="d-flex">
                                        <form method="GET" action="{{ __('/editTeacher/'.$teacher['id']) }}">
                                            @csrf
                                            <x-button class="me-1">
                                                {{ __('Edit') }}
                                            </x-button>
                                        </form>
                                        <form method="GET" action="{{ __('/deleteTeacher/'.$teacher['id']) }}">
                                            @csrf
                                            <x-button class="me-3">
                                                {{ __('Delete') }}
                                            </x-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-a href="/newTeacher">New Teacher</x-a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
