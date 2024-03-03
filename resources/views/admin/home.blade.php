@extends('admin.sidemenu')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="bg-secondary p-2 col-auto col-12 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Dashboard</span>
        </div>

        <div class="col-12 p-4">

            <div class="row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card text-bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Batch</h5>
                            <p class="card-text">There are {{ $batchCount }} batches in this institute</p>
                            <a href="{{ url('batch') }}" class="btn btn-dark">manage</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-bg-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Total Student</h5>
                            <p class="card-text">There are {{ $studentCount }} students in this institution</p>
                            <a href="{{ url('semester') }}" class="btn btn-dark">manage</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Subject</h5>
                            <p class="card-text">{{ $subjectCount }} subjects are taught in this institute</p>
                            <a href="{{ url('subjectsAdd') }}" class="btn btn-dark">manage</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>



@endsection