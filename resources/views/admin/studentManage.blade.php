@extends('admin.sidemenu')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="bg-secondary p-2 col-auto col-12 d-flex flex-column justify-content-between">
            <span class="fs-4 text-white d-none d-sm-inline">Student Manage</span>
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
            <form action="{{ route('search') }}" method="GET" class="row g-2">

                <label for="st_name"><span class="fw-bold">Enter Student Index Number :</span></label>
                <div class="col-5">  
                    <input class="form-control form-control-md" type="text" name="st_index" 
                    
                    @if(isset($student))
                    placeholder="{{ $student->st_index }}" 
                    @else{
                    placeholder="ICT001" 
                    }
                    @endif
                    required>
                    
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary mb-3 ps-3 pe-3">Search</button>
                </div>
            </form>

        </div>

        <div class="col-10 offset-1 p-4 rounded" style="background-color: #e7f0ff;">

            <!-- Display Student Data -->
            @if(isset($student))

                <table class="fw-bold">
                    <tr>
                        <th>Student Name In Full</th>
                        <td class="text-secondary text-uppercase">: {{ $student->st_name }}</td>
                    </tr>
                    <tr>
                        <th>Student ID</th>
                        <td class="text-secondary text-uppercase">: {{ $student->st_idno }}</td>
                    </tr>
                    <tr>
                        <th>Student Email</th>
                        <td class="text-secondary">: {{ $student->email }}</td>
                    </tr>
                    <tr>
                        <th>Batch</th>
                        <td class="text-secondary text-uppercase">: {{ $student->batch->batchname }}</td>
                    </tr>
                </table>
          
                <!-- Delete and Edit Buttons -->
               
                
                    <form action="{{ route('student.delete', ['id' => $student->id]) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-success mb-3 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        <button type="submit" class="btn btn-danger mb-3 ps-3 pe-3">Delete Student</button>
                    </form>
                
            @endif


        </div>

        <div>
            @if(isset($student))
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="editSubjectLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSubjectLabel">Edit Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('students.update', ['student' => $student->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="st_name">Student Name:</label>
                                    <input type="text" class="form-control" id="st_name" name="st_name" value="{{ $student->st_name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Student Email:</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="st_idno">Student ID:</label>
                                    <input type="text" class="form-control" id="st_idno" name="st_idno" value="{{ $student->st_idno }}" aria-label="Disabled input example" disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="st_index">Student Index:</label>
                                    <input type="text" class="form-control" id="subject_name" name="st_index" value="{{ $student->st_index }}" aria-label="Disabled input example" disabled readonly>
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
        </div>

    </div>
</div>



@endsection
