<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="/css/home.css">
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <script src="/bootstrap/js/bootstrap.js"></script>
  <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-brown">

  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5">


              <h1 class="text-center mb-4">Exam Results</h1>

              <form action="{{ route('results') }}" method="post">
              @csrf
                <div class="form-group">
                  <label for="rollid">Enter your Index No. (ICT001)</label>
                  <input type="text" class="form-control form-control-lg" id="rollid" value="ICT" autocomplete="off" name="st_index">
                </div>

                <div class="form-group">
                  <label for="default" class="control-label">Semester</label>
                  <select name="semester" class="form-control form-control-lg" id="default" required="required">
                    <option value="">Select Semester</option>
                    @foreach($semester as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->semester }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mt-4">
                  <button class="btn button-29 btn-lg btn-block" type="submit">Search</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



</body>

</html>