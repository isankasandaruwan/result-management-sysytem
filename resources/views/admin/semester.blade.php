@extends('admin.sidemenu')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="bg-secondary p-2 col-auto col-12 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Manage Semesters</span>
        </div>

        <div class="col-auto p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('createsemester') }}" method="post" class="row g-3">
                @csrf
                <div class="col-auto"><input type="text" name="semester" class="form-control" placeholder="Enter Semesters Name" />
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Create Semesters</button>
                </div>
            </form>
        </div>

        <div class="col-12 p-4">
            <table class="table table-secondary">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Subject</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 1;
                    @endphp

                    @foreach($semesters as $semester)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $semester->semester }}</td>
                        <td>{{ $semester->subjects->count() }}</td>
                        <td class="text-center">
                            @if($semester->subjects->count() == 0)
                            <form action="{{ route('deleteSemester', $semester->id) }}" method="post"  onsubmit="return confirm('Are you sure you want to delete this Semester?')">
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