@extends('admin.sidemenu')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="bg-secondary p-2 col-auto col-12 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Register Student</span>
        </div>

        <div class="col-8 p-4 ms-5">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('studentcreate') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="st_name">Enter Student Name in full :</label>
                    <input class="form-control form-control-md" type="text" id="st_name" name="st_name" placeholder="Student Name">
                </div>
                <div class="form-group">
                    <label for="st_idno">Student ID:</label>
                    <input class="form-control form-control-md" type="text" id="st_idno" name="st_idno" placeholder="Student ID Number">
                </div>
                <div class="form-group">
                    <label for="st_index">Student Index:</label>
                    <input class="form-control form-control-md" type="text" id="st_index" name="st_index" placeholder="Student Index Number">
                </div>
                <div class="form-group">
                    <label for="email">Student Email:</label>
                    <input class="form-control form-control-md" type="text" id="email" name="email" placeholder="Student email address">
                </div>

                <div class="form-group">
                    <label for="batch_id">Select Student Batch :</label>
                    <select name="batch_id" class="form-control form-control-md" id="default" required="required">
                        @foreach($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->batchname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-md btn-primary" type="submit">Register</button>
                </div>

            </form>
        </div>
    </div>
</div>



@endsection