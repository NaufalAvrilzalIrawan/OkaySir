<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons/css/all.css') }}">
</head>

<body>
    <div class="row justify-content-evenly mt-5">
        <div class="card" style="width:50rem;">
          <div class="card-body">
            <h2 class="card-title text-center">Login</h2>

            <form method="post" action="/logging" class="row g-3 needs-validation" novalidate>
              @csrf
              <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                @error('email')
                    <div class="text-danger">
                      <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                    </div>
                @enderror
              </div>
              
              <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    <div class="input-group-text">
                        <span id="show" class="fa fa-eye"></span>
                    </div>
                </div>
                @error('password')
                  <div class="text-danger">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                  </div>
                @enderror
              </div>

              <div class="col-12">
                @if (Session::has('error'))
                  <div class="alert alert-danger" role="alert">
                      {{Session::get('error')}}
                  </div>
                @endif
                <button class="btn btn-primary" type="submit">Login</button>
              </div>
            </form>

          </div>
        </div>
    </div>
    
    <script>
        var data = document.getElementById('password');
        var toggle = document.getElementById("show");
        toggle.addEventListener("click", function(){
            if(data.type === "password"){
                data.type = "text";
                toggle.classList.remove("fa-eye");
                toggle.classList.add("fa-eye-slash");
            } else{
                data.type = "password";
                toggle.classList.remove("fa-eye-slash");
                toggle.classList.add("fa-eye");
            }
        })
    </script>
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>