@extends('layouts.main')
@section('content')
<a href="{{ route('member.buat') }}" class="btn btn-outline-primary">Tambah</a>

<div class="table-responsive">
    <table class="table table-stripped table-hover ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($members->count() > 0)                
                @foreach ($members as $member)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$member->nama}}</td>
                        <td>{{$member->alamat}}</td>
                        <td>{{$member->nomorTelepon}}</td>
                        <td>
                            <a class="btn btn-warning" href="/member/edit{{ $member->memberID }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" href="/member/hapus{{ $member->memberID }}" onclick="return confirm('Ingin menghapus data {{$member->nama}}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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