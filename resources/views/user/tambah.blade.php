@extends('layouts.main')
@section('content')
    <form method="post" action="/user/tambah" class="row g-3 needs-validation" novalidate>
      @csrf
      <div class="col-md-4">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Mohon isi nama petugas" required>
          @error('name')
            <div class="text-danger">
              <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
            </div>
          @enderror
      </div>
      <div class="col-md-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Mohon isi email petugas" required>
        @error('email')
          <div class="text-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
          </div>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mohon isi password petugas" required>
        @error('password')
          <div class="text-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
          </div>
        @enderror
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit">Tambah</button>
      </div>
    </form>
@endsection