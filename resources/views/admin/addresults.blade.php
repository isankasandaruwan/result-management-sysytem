@extends('admin.sidemenu')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="bg-secondary p-2 col-auto min-vw-100 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Add Results</span>
        </div>

        <div class="col-auto p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('showSubjectCodes') }}" method="GET" class="row g-3">
                @csrf
                <div class="col-auto">
                    <select name="batch_id" class="form-control">
                        <option value="">Select Batch</option>
                        @foreach($batch as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->batchname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <select name="semester_id" class="form-control">
                        <option value="">Select Semester</option>
                        @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Find</button>
                </div>
            </form>
        </div>

        <div class="col-8 offset-2 p-4 rounded" style="background-color: #e7f0ff;">
            @if($boolValue)
                
            <form action="{{ route('saveExamResults') }}" method="post">
                @csrf

                <!-- Hidden field for semester ID -->
                <input type="hidden" name="semester_id" value="{{ $semesterId }}">

                <div class="mb-3">
                    <label class="form-label">Enter Select Student Index</label>
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon3">Student Index</span>
                        <select name="student_id" class="form-control">
                            @if($students->isEmpty())
                                <option value="">There are no students</option>
                            @else
                                <option value="">Select One</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->st_index }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <label class="form-label">Enter All Subject Marks</label>
                    @foreach($subjects as $subject)
                    <div class="input-group mb-1">
                      <span class="input-group-text" id="basic-addon3">{{ $subject->subject_code }}</span>
                      <input type="text"  class="form-control" name="subject_marks[{{ $subject->id }}]" id="subject_{{ $subject->id }}" placeholder="Enter Marks" required><br>
                    </div>
                    @endforeach

                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
            
            @endif
        </div>

    </div>
</div>

@endsection