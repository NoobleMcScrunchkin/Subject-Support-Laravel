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
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student['surname'] }}</td>
                                    <td class="w-100">{{ $student['firstname'] }}</td>
                                    @if(Auth::user()->can('canCreateStudents'))
                                        <td class="d-flex">
                                            <form method="GET" action="{{ __('/editStudent/'.$student['id']) }}">
                                                @csrf
                                                <x-button class="me-1">
                                                    {{ __('Edit') }}
                                                </x-button>
                                            </form>
                                            <form method="GET" action="{{ __('/deleteStudent/'.$student['id']) }}">
                                                @csrf
                                                <x-button class="me-3">
                                                    {{ __('Delete') }}
                                                </x-button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            @if (sizeof($students) == 0)
                                <tr>
                                    <td colspan=4>No Students</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if(Auth::user()->can('canCreateStudents'))
                        <x-a href="/newStudent">New Student</x-a>
                    @endif  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
