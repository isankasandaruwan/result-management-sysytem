@extends('admin.sidemenu')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="bg-secondary p-2 col-auto col-12 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Manage Batches</span>
        </div>

        <div class="col-auto p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('createbatch') }}" method="post" class="row g-3">
                @csrf
                <div class="col-auto"><input type="text" name="batchname" class="form-control" placeholder="Enter Batch Name" />
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Create Batch</button>
                </div>
            </form>
        </div>

        <div class="col-12 p-4">
            <table class="table table-secondary">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Batch Name</th>
                        <th scope="col">Student</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 1;
                    @endphp

                    @foreach($batches as $batch)
                    <tr class="text-center">
                        <td>{{ $counter++ }}</td>
                        <td>{{ $batch->batchname }}</td>
                        <td>{{ $batch->students->count() }}</td>
                        <td>
                            @if($batch->students->isEmpty())
                            <form action="{{ route('delete.batch', $batch->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this batch?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @else
                            <button type="button" class="btn btn-danger" disabled>Delete</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>



@endsection