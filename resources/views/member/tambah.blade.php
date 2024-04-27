@extends('layouts.main')
@section('content')
    <form method="post" action="/member/tambah" class="row g-3 needs-validation" novalidate>
      @csrf
      <div class="col-md-4">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Mohon isi nama member" required>
        @error('nama')
          <div class="text-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
          </div>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="alamat" class="form-label">Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat" placeholder="Mohon isi alamat member" required rows="3"></textarea>
        @error('alamat')
          <div class="text-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
          </div>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
        <input type="number" class="form-control" id="nomorTelepon" name="nomorTelepon" placeholder="Mohon isi nomor telepon member" required>
        @error('nomorTelepon')
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