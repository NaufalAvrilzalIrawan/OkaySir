@extends('layouts.main')
@section('content')
<a href="{{ route('produk.buat') }}" class="btn btn-outline-primary">Tambah</a>

<div class="table-responsive">
    <table class="table table-stripped table-hover ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($produks->count() > 0)
                @foreach ($produks as $produk)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$produk->nama}}</td>
                        <td>RP. {{$produk->harga}}</td>
                        <td>{{$produk->stok}}</td>
                        <td>
                            @if ($produk->status == "Aktif")
                                <span class="badge rounded-pill text-bg-success">
                            @else
                                <span class="badge rounded-pill text-bg-danger">
                            @endif
                                {{$produk->status}}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="/produk/edit{{ $produk->produkID }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                            @if ($produk->status == "Aktif")
                                <a class="btn btn-danger" href="/produk/hapus{{ $produk->produkID }}" onclick="return confirm('Ingin menonaktifkan data {{$produk->nama}}')"><i class="fa fa-circle-xmark" aria-hidden="true"></i></a>
                            @else
                                <a class="btn btn-success" href="/produk/aktif{{ $produk->produkID }}" onclick="return confirm('Ingin mengaktifkan data {{$produk->nama}}')"><i class="fa fa-circle-check" aria-hidden="true"></i></a>
                            @endif
                        </td>
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