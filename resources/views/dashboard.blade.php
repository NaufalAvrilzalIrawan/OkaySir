@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-black">
        </div>
        <div class="card-body">
            <h3>PRODUK</h3>
            <h2 class="d-flex justify-content-end ">{{$produk}}</h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-black">
          </div>
          <div class="card-body">
              <h3>PENJUALAN</h3>
              <h2 class="d-flex justify-content-end ">{{$penjualan}}</h2>
          </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-black">
          </div>
          <div class="card-body">
              <h3>MEMBER</h3>
              <h2 class="d-flex justify-content-end ">{{$member}}</h2>
          </div>
        </div>
      </div>  
</div>

@endsection