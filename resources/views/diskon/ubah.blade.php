@extends('layouts.main')
@section('content')
    <form method="post" action="/diskon/ubah{{$diskon->diskonID}}" class="row g-3 needs-validation" novalidate>
      @csrf
      <div class="col-md-4">
        <label for="nominal" class="form-label">Nominal</label>
        <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Mohon isi nominal barang" value="{{ $diskon->nominal }}" required>
        @error('nominal')
          <div class="text-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
          </div>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="persen" class="form-label">Diskon</label>
        <div class="input-group">
          <input type="number" class="form-control" id="persen" name="persen" placeholder="Mohon isi diskon barang" value="{{$diskon->persen}}" required>
            <div class="input-group-text">
              <span id="show" class="fa fa-percent"></span>
            </div>
        </div>
        @error('persen')
          <div class="text-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
          </div>
        @enderror
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit">Ubah</button>
      </div>
    </form>
@endsection