@extends('admin.sidemenu')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="bg-secondary p-2 col-auto col-12 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Student Semester Exam Results Manage</span>
        </div>

        <div class="col-8 p-4 ms-5">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
                        
            <!-- Search Form -->
            <form action="{{ route('show.student.index') }}" method="GET" class="row g-2">
                @csrf
                <label for="semester" class="fw-bold">Select Semester</label>
                <div class="col-auto">
                    @if(isset($students))
                    <input type="text" class="form-control" value="{{ $semesters }}" disabled readonly>

                    @else

                        <select name="semester" class="form-control" onchange="this.form.submit()">
                            <option value="">Select Semester</option>
                            @foreach($semesters as $semester)
                                <!-- Display each semester as an option -->
                                <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                            @endforeach
                        </select>

                    @endif
                </div>
            </form>
            @if(isset($students))
            <form action="{{ route('show.exam.results') }}" method="GET" class="row g-2">
                @csrf
                <label for="Index" class="fw-bold">Select Index</label>
                <div class="col-auto">
                    <select name="Index" class="form-control" onchange="this.form.submit()">
                        <option value="">Select Index</option>
                        @foreach($students as $studentId => $studentIndex)
                            <option value="{{ $studentId }}">{{ $studentIndex }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="semester" value="{{ request('semester') }}">
            </form>

            @endif
            
        </div>

        <div class="col-8 offset-2 p-4 rounded" style="background-color: #e7f0ff;">
            
            @if(isset($examResults))
        
                @if($examResults->isNotEmpty())
        
                <h4 class="h4 text-center">{{ $index }} {{ $semesters }} Exam Results</h4>
   
                    @foreach($examResults as $result)

                    <form action="{{ route('update.marks', $result->id) }}" method="post">
                        @csrf
                        
                        <div class="input-group mb-1">
                            <span class="input-group-text">{{ $result->subject_code }}</span>
                            <input type="text" class="form-control" name="mark" value="{{ $result->mark }}" required><br>
                            <button class="btn btn-outline-success" type="submit" id="button-addon2">Button</button>
                        </div>
                    </form>

                    @endforeach

        
                @else
                    <p>No exam results found for the selected student.</p>
                @endif
        
            @endif
            
        </div>

    </div>
</div>

@endsection
