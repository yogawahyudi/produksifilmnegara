<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Produksi Film Negara </title>
    <link rel="shortcut icon" href="{{asset('assets/images/logo-pfn.png')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('assets/libs/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
       .navbar .nav-link {
            color : #e2181c;
           
        }

        .navbar .nav-link.active {
            color : #ff0000;
        }
    </style>
</head>
 
<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-md">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/images/logo-pfn.png')}}" alt="logo-pfn" style="height: 75px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-lg-auto">
                    <a class="nav-link fw-bold me-3 ms-3 active" aria-current="page" href="{{route('dashboard')}}">Beranda</a>
                    <a class="nav-link fw-bold me-3 ms-3" href="{{route('user.studio')}}">Studio</a>
                    <a class="nav-link fw-bold fs-1 me-3 ms-3" href="{{route('index.chatbot')}}" style="position: fixed;top: 590px;z-index: 999;right: 30px;"><i class="bx bx-bot bx-lg"></i></a>
                </div>
                
                    @if (Auth::check())
                        <ul class="navbar-nav me-3 ms-3 float-lg-end float-md-end">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::guard()->user()->img != null)
                                <img src="{{asset('/assets/images/profile/user/'.Auth::guard()->user()->img)}}" alt="user" class="rounded-circle" width="31" height="31">
                                @else
                                <img src="{{asset('/assets/images/profile/default-person.jpg')}}" alt="user" class="rounded-circle" width="31" height="31">                                    
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('index.transaksi.user')}}"><i class='bx bx-history'></i>
                                    Transaksi</a>
                                      <a class="dropdown-item" href="{{route('index.profile')}}"><i class="bx bx-user"></i>
                                    My Profile</a>
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item" href="javascript:void(0)"><i class='bx bx-log-out-circle' ></i>
                                            Logout</button>
                                    </form>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                    {{-- <a class="nav-link me-3 ms-3 text-danger" href="#">Profile</a>
                    <a class="nav-link me-3 ms-3 text-danger" href="#">Transaksi</a> --}}
                    @else            
                    <div class="navbar-nav ms-lg-4">
                        <a class="nav-item text-danger nav-link" href="{{route('login')}}">Log in</a>
                    </div>
                        <!-- Action -->
                    <div class="d-flex align-items-lg-center mt-3 mt-lg-0">
                            <a href="{{route('register')}}" class="btn btn-sm btn-danger w-full w-lg-auto">
                            Register
                            </a>
                    </div>
                    @endif
            </div>
        </div>
    </nav>
    <div class="container-fluid">
@yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="{{asset('/dist/js/formatRupiah.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js')}}"></script>

</body>

</html>