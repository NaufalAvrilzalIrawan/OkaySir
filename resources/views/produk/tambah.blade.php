@extends('layouts.main')
@section('content')
    <form method="post" action="/produk/tambah" class="row g-3 needs-validation" novalidate>
      @csrf
      <div class="col-md-4">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Mohon isi nama barang" required>
        @error('nama')
          <div class="text-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
          </div>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" placeholder="Mohon isi harga barang" required>
        @error('harga')
          <div class="text-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
          </div>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" class="form-control" id="stok" name="stok" placeholder="Mohon isi stok barang" required>
        @error('stok')
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