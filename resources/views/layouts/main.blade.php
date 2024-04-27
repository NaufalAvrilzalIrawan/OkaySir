<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Kasir</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/icons/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">
        <script src="assets/js/jquery-3.7.1.min.js"></script>
        <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="sidebar col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Okay Sir</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produk') }}" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline">Produk</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('member') }}" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline">Member</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penjualan') }}" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline">Penjualan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stok') }}" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline">Stok</span>
                            </a>
                        </li>
                        @if (auth()->user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('diskon') }}" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">Diskon</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('petugas') }}" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">Petugas</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline mx-1">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('profil') }}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                @if (Session::has('success'))
                  <div class="alert alert-danger" role="alert">
                      {{Session::get('success')}}
                  </div>
                @endif
                @if (Session::has('error'))
                  <div class="alert alert-danger" role="alert">
                      {{Session::get('error')}}
                  </div>
                @endif
                @yield('content')
            </div>
            
        </div>
        {{-- <footer class="footer bg-info text-center text-lg-start fixed-bottom">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgb(182, 182, 182);">
              N.A.I©2024
            </div>
            <!-- Copyright -->
        </footer> --}}
    </div>
</body>

</html>
