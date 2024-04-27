@extends('layouts.main')
@section('content')
<a href="{{ route('user.buat') }}" class="btn btn-outline-primary">Tambah</a>
<div class="table-responsive">
    <table class="table table-stripped table-hover ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count() > 0)
                @foreach ($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->status == "Aktif")
                                <span class="badge rounded-pill text-bg-success">
                            @else
                                <span class="badge rounded-pill text-bg-danger">
                            @endif
                                {{$user->status}}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="/user/edit{{ $user->userID }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                            @if ($user->status == "Aktif")
                                <a class="btn btn-danger" href="/user/hapus{{ $user->userID }}" onclick="return confirm('Ingin menonaktifkan data {{$user->name}}')"><i class="fa fa-circle-xmark" aria-hidden="true"></i></a>
                            @else
                                <a class="btn btn-success" href="/user/aktif{{ $user->userID }}" onclick="return confirm('Ingin mengaktifkan data {{$user->nama}}')"><i class="fa fa-circle-check" aria-hidden="true"></i></a>
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