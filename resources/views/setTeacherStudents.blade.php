<x-app-layout>
    <x-form-card>
        <form method="POST" action="{{ route('setTeacherStudents', [ 'id' => $teacher->id ]) }}">
            @csrf

            <div id="studentInputs">
                @if (sizeof($teacher->students))
                    @foreach ($teacher->students as $index=>$teacherstudent)
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="students[{{ $index }}]">Student</label>
                            <select class="form-select" id="students[{{ $index }}]" name="students[{{ $index }}]">
                                <option value="none">Choose...</option>
                                @foreach ($students as $student)
                                    @if ($student->id == $teacherstudent->id)
                                    <option selected value="{{ $student->id }}">{{ $student->firstname }} {{ $student->surname }}</option>
                                    @else
                                        <option value="{{ $student->id }}">{{ $student->firstname }} {{ $student->surname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                @else
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="students[0]">Student</label>
                        <select class="form-select" id="students[0]" name="students[0]">
                            <option value="none" selected>Choose...</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->firstname }} {{ $student->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
                    
            <div class="flex items-center justify-end mt-4">
                <x-button type="button" class="ml-3" onclick="addStudent();">
                    {{ __('Add Student') }}
                </x-button>
                <x-button class="ml-3">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
<script>
    const defaultInput = document.getElementById('studentInputs').children[0];
    var studentsNum = {{ sizeof($teacher->students) }};
    function addStudent() {
        studentsNum++;
        let newInput = defaultInput.cloneNode(true);
        let select = newInput.getElementsByTagName("select")[0];
        newInput.getElementsByTagName("label")[0].setAttribute("for", `students[${studentsNum}]`);
        select.setAttribute("id", `students[${studentsNum}]`);
        select.setAttribute("name", `students[${studentsNum}]`);

        console.log(select.options);
        for (let option in select.options) {
            if (option == 0) {
                select.options[option].selected = true;
            } else {
                select.options[option].selected = false;
            }
        }

        document.getElementById("studentInputs").appendChild(newInput);
    }
</script>
