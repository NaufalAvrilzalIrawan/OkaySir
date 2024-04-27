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
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Okay Sir</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}" aria-current="page">Dashboard
                            <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Data</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="{{ route('produk') }}">Produk</a>
                            <a class="dropdown-item" href="{{ route('member') }}">Member</a>
                            <a class="dropdown-item" href="{{ route('penjualan') }}">Penjualan</a>
                            @if (auth()->user()->role == 1)
                            <a class="dropdown-item" href="{{ route('petugas') }}">Petugas</a>
                            @endif
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav d-flex my-2 my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                            </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-fluid !direction !spacing">
        @yield('content')
    </div>

    <footer class="footer bg-info text-center text-lg-start fixed-bottom">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgb(182, 182, 182);">
          N.A.I©2024
        </div>
        <!-- Copyright -->
      </footer>
</body>

</html>
