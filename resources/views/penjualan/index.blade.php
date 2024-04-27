@extends('layouts.main')
@section('content')
<a href="{{ route('transaksi') }}" class="btn btn-outline-primary">Tambah</a>
<button class="btn btn-outline-success" onclick="print()">Cetak</button>

<div class="table-responsive">
    <form action="{{ route('penjualan.filter') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <label for="dari" class="form-label">Dari</label>
                <input type="date" class="form-control" id="dari" name="dari" required>
            </div>
            <div class="col-md-3">
                <label for="sampai" class="form-label">sampai</label>
                <input type="date" class="form-control" id="sampai" name="sampai" required>
            </div>
            <div class="col-md-3 mt-4">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </form>
    <br><h1 id="print-only" class="d-flex justify-content-center">TABEL TRANSAKSI</h1><br>
    <table class="table table-stripped table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">User</th>
                <th scope="col">Member</th>
                <th scope="col">Produk</th>
                <th scope="col">Total Akhir</th>
                <th scope="col">Bayar</th>
                <th scope="col">Kembalian</th>
                <th scope="col" class="aksiCol">Status</th>
                <th scope="col" class="aksiCol">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($penjualans->count() > 0)
                @foreach ($penjualans as $penjualan)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$penjualan->tanggal}}</td>
                        <td>{{$penjualan->user->name}}</td>
                        <td>{{$penjualan->namaMember}}</td>
                        <td>
                            @foreach ($penjualan->detailPenjualan as $detail)
                                {{$detail->produk->nama}} : {{$detail->jumlah}} = {{number_format($detail->subtotal,2)}} <br>
                            @endforeach
                        </td>
                        <td>Rp. {{number_format($penjualan->totalAkhir,2)}}</td>
                        <td>Rp. {{number_format($penjualan->bayar,2)}}</td>
                        <td>Rp. {{number_format($penjualan->kembalian,2)}}</td>
                        <td class="aksiCol">
                            @if ($penjualan->status == "selesai")
                                <span class="badge rounded-pill text-bg-success">
                            @else
                                <span class="badge rounded-pill text-bg-warning">
                            @endif
                                {{$penjualan->status}}
                            </span>
                        </td>
                        <td class="aksiCol"><a href="/struk{{ $penjualan->penjualanID }}" class="btn btn-outline-success">Struk</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection