@extends('layouts.main')
@section('content')
<button class="btn btn-outline-success" onclick="window.print()">Cetak</button>

<div class="table-responsive">
    <form action="{{ route('stok.filter') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <select class="form-select" id="aksi" name="aksi">
                    <option value="Semua">Semua</option>
                    <option value="Masuk">Masuk</option>
                    <option value="Keluar">Keluar</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </form>
    <br><h1 id="print-only" class="d-flex justify-content-center">TABEL STOK</h1><br>
    <table class="table table-stripped table-hover ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Aksi</th>
                <th scope="col">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @if ($stoks->count() > 0)
                @foreach ($stoks as $stok)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$stok->produk->nama}}</td>
                        <td>{{$stok->jumlah}}</td>
                        <td>{{$stok->aksi}}</td>
                        <td>{{$stok->created_at}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection