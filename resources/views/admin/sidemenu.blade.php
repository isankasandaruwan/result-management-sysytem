<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidemenu</title>

  <!-- <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <script src="/bootstrap/js/bootstrap.js"></script>
  <script src="/bootstrap/js/bootstrap.bundle.js"></script> -->

  <link rel="stylesheet" href="/css/adminhome.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/3aa01fb27a.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <div class="bg-dark col-auto col-md-3 col-lg-3 min-vh-100 d-flex flex-column justify-content-between">
        <div class="bg-dark p-2">
          <a href="#" class="d-flex text-decoration-none mt-1 align-items-center ms-4 text-white">
            <span class="fs-4 d-none d-sm-inline">Side Menu</span>
          </a>
          <hr class="text-white"/>
          <ul class="nav nav-pills flex-column mt-4">
            <li class="nav-item py-2 py-sm-0">
              <a href="{{ url('home') }}" class="nav-link text-white">
                <span class="fs-4 d-none d-sm-inline">Dashboard</span>
              </a>
            </li>

            <li class="nav-item py-2 py-sm-0">
              <a href="{{ url('batch') }}" class="nav-link text-white">
                <span class="fs-4 d-none d-sm-inline">Batch</span>
              </a>
            </li>

            <li class="nav-item py-2 py-sm-0">
              <a href="{{ url('semester') }}" class="nav-link text-white">
                <span class="fs-4 d-none d-sm-inline">Semester</span>
              </a>
            </li>

            <li class="nav-item py-2 py-sm-0 disabled">
              <a href="#sidemenu3" data-bs-toggle="collapse"  class="nav-link text-white">
                <span class="fs-4 d-none d-sm-inline">Subjects</span>
                <i class="fa fa-caret-down ms-2"></i>
              </a>
              <ul class="nav collapse ms-1 flex-column bg-secondary" id="sidemenu3">
                <li class="nav-item">
                  <a href="{{ url('subjectsAdd') }}" class="nav-link text-white">Create Subject</a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('subjectcombine') }}" class="nav-link text-white">Combine Subject</a>
                </li>
              </ul>
            </li>

            <li class="nav-item py-2 py-sm-0 disabled">
              <a href="#sidemenu4" data-bs-toggle="collapse"  class="nav-link text-white">
                <span class="fs-4 d-none d-sm-inline">Students</span>
                <i class="fa fa-caret-down ms-2"></i>
              </a>
              <ul class="nav collapse ms-1 flex-column  bg-secondary" id="sidemenu4">
                <li class="nav-item">
                  <a href="{{ url('studentregister') }}" class="nav-link text-white">Student Register</a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('student-manage') }}" class="nav-link text-white">Manage Students</a>
                </li>
              </ul>
            </li>

            <li class="nav-item py-2 py-sm-0 disabled">
              <a href="#sidemenu5" data-bs-toggle="collapse"  class="nav-link text-white">
                <span class="fs-4 d-none d-sm-inline">Results</span>
                <i class="fa fa-caret-down ms-2"></i>
              </a>
              <ul class="nav collapse ms-1 flex-column bg-secondary" id="sidemenu5">
                <li class="nav-item">
                  <a href="{{ url('addresults') }}" class="nav-link text-white">Add Result</a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('resultsManage') }}" class="nav-link text-white">Manage Results</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>

        <div class="dropdown text-center py-4">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="ms-2">Admin</span>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
          </ul>
        </div>
      </div>

      <!-- content area -->
      <div class="p-0 col-9">
          @yield('content') 
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
