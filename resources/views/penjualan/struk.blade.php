@extends('layouts.main')
@section('content')
    <a class="btn btn-outline-success" onclick="window.print()">Cetak</a>
    <a href="{{ route('penjualan') }}" class="btn btn-outline-danger">Kembali</a>

    <div class="w-75 mx-auto border border-black p-3">
        <h2 class="d-flex align-items-center justify-content-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Okay Sir</h2><br>
        <p>Nama member : {{ $penjualan->namaMember}}</p>
        <p>tanggal : {{ $penjualan->created_at }}</p>
        <hr>
        @foreach ($penjualan->detailPenjualan as $detail)
            <p><b>{{ $detail->produk->nama }}</b></p>
            <div class="row">
                <div class="d-flex">
                    <div class="col-6">
                        {{ $detail->jumlah }} x {{ $detail->produk->harga }}
                    </div>
                    <div class="col-6 justify-content-end">
                        <span class="d-flex justify-content-end ">
                            RP. {{ $penjualan->nomor($detail->subtotal, 2) }}
                        </span>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
        <hr>
        <table class="w-100">
            <tr>
                <td><b>Total</b></td>
                <td>:</td>
                <td align="end">RP. {{ $penjualan->nomor($penjualan->total) }}</td>
            </tr>
            <tr>
                <td><b>Total Akhir</b></td>
                <td>:</td>
                <td align="end">RP. {{ $penjualan->nomor($penjualan->totalAkhir, 2) }}</td>
            </tr>
            <tr>
                <td><b>Bayar</b></td>
                <td>:</td>
                <td align="end">RP. {{ $penjualan->nomor($penjualan->bayar, 2) }}</td>
            </tr>
            <tr>
                <td><b>Kembalian</b></td>
                <td>:</td>
                <td align="end">RP. {{ $penjualan->nomor($penjualan->kembalian, 2) }}</td>
            </tr>
        </table>
        <hr>
        <div class="d-flex align-items-center justify-content-center">
            <p>N.A.I</p>
        </div>
    </div>
@endsection
