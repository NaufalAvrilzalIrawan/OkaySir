@extends('layouts.main')
@section('content')
<a href="{{ route('diskon.buat') }}" class="btn btn-outline-primary">Tambah</a>

<div class="table-responsive">
    <table class="table table-stripped table-hover ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nominal</th>
                <th scope="col">Diskon</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($diskons->count() > 0)
                @foreach ($diskons as $diskon)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>RP. {{$diskon->nominal}}</td>
                        <td>{{$diskon->persen}}%</td>
                        <td>
                            <a class="btn btn-warning" href="/diskon/edit{{ $diskon->diskonID }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" href="/diskon/hapus{{ $diskon->diskonID }}" onclick="return confirm('Ingin menghapus data untuk nominal Rp. {{$diskon->nominal}}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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