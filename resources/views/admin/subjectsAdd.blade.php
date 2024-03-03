@extends('admin.sidemenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="bg-secondary p-2 col-auto col-12 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Include Subject</span>
        </div>

        <div class="col-12 p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('createsubjects') }}" method="post" class="row g-2">
                @csrf
                <div class="col-5">
                    <input type="text" name="subject_code" class="form-control" placeholder="Subject Code">
                </div>
                <div class="col-5">
                    <input type="text" name="subject_name" class="form-control" placeholder="Subject Name">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary mb-3 ps-3 pe-3">Save</button>
                </div>
            </form>
        </div>

        <div class="col-12 p-4">
            <table class="table table-secondary">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Semester</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 1;
                    @endphp

                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $subject->subject_code }}</td>
                        <td>{{ $subject->subject_name }}</td>
                        <td>
                            @foreach ($subject->semesters as $semester)
                                {{ $semester->semester }}
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if ($subject->semesters->isEmpty())
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $subject->id }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.subjects.delete', $subject->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $subject->id }}" tabindex="-1" aria-labelledby="editSubjectLabel{{ $subject->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSubjectLabel{{ $subject->id }}">Edit Subject</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="subject_code">Subject Code</label>
                                                    <input type="text" class="form-control" id="subject_code" name="subject_code" value="{{ $subject->subject_code }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subject_name">Subject Name</label>
                                                    <input type="text" class="form-control" id="subject_name" name="subject_name" value="{{ $subject->subject_name }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
