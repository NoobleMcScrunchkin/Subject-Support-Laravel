<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (!Auth::user()->can('canViewAttendance'))
                        <?php $students = Auth::user()->students ?>
                    @endif
                    @if (sizeof($students))
                        <table class="table table-striped border table-hover">
                            <thead>
                                <tr>
                                    <th>Surname</th>
                                    <th>Firstname</th>
                                    <th>Status</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                @foreach ($students as $student)
                                    <?php
                                        $studentAtt = $attendance->where('students_id', $student->id);
                                        $period1 = False;
                                        $period2 = False;
                                        // echo $studentAtt->where('period', 1)->first()->complete;
                                        if ($studentAtt && $studentAtt->where('period', 1)->first() && $studentAtt->where('period', 1)->first()->complete) {
                                            $period1 = True;
                                        }
                                        if ($studentAtt && $studentAtt->where('period', 2)->first() && $studentAtt->where('period', 2)->first()->complete) {
                                            $period2 = True;
                                        }

                                        if (request()->routeIs('incomplete') && $period1 && $period2) {
                                            continue;
                                        }
                                        $count++;
                                    ?>
                                    <tr>
                                        <td>{{ $student->surname }}</td>
                                        <td class="">{{ $student->firstname }}</td>
                                        <td class="w-100">{{ ($period1 && $period2) ? "Complete" : "Incomplete" }}</td>
                                        <td class="whitespace-nowrap">
                                            <form method="POST" action="{{ __('/setAttendance/'.$student->id) }}">
                                                @csrf
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="period1" {{ $period1 ? "checked" : ""}}>
                                                    <span class="ml-2">Period 1</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="period2" {{ $period2 ? "checked" : ""}}>
                                                    <span class="ml-2">Period 2</span>
                                                </label>
                                                <x-button class="me-3">
                                                    {{ __('Save') }}
                                                </x-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($count == 0)
                                    <tr>
                                        <td colspan=4>No Incomplete Attendances</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        @if (request()->routeIs('dashboard'))
                            <x-a href="/showIncomplete">Show Incomplete</x-a>
                        @endif
                    @else
                        <h1>You have no Students assigned to you.</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
