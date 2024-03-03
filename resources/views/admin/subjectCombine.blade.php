@extends('admin.sidemenu')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="bg-secondary p-2 col-auto col-12 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Semester Subject Add</span>
        </div>

        <div class="col-auto p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('subject_combine') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="semester">Select Semester:</label>
                    <select name="semester_id" class="form-control form-control-lg" id="default" required="required">
                        @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">Select Subject:</label>
                    <select name="subject_id" class="form-control form-control-lg" id="subject" required="required">
                        @if($subjects->isEmpty())
                            <option value="" disabled>No subjects available</option>
                        @else
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group mt-4">
                    <button class="btn btn-md btn-primary" type="submit">Add Subject</button>
                </div>
            </form>

        </div>

        <div class="col-12 p-4">

        </div>


    </div>
</div>



@endsection