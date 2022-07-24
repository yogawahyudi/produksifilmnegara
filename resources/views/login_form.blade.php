{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>How To Create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">   
     
 
</head>
<body>
    @if (Session::has('error'))        
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{session::get('error')}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-center" style="background-image: url({{asset('assets/images/bg-login.jpg')}}); background-size: cover; min-height: 100vh; width: 100vw">
               <div class="row">
                <div class="col-12">
                    <div class="card shadow-md" style="width: 500px">
                        <div class="card-body">
                            <div class="row mb-3 mt-3">
                                <div class="col-12 text-center">
                                    <img src="{{asset('assets/images/logo-pfn.png')}}" alt="Logo PFN" style="height: 100px">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="text-center text-muted">Selamat Datang</h5>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('dashboard.login')}}" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                    </div>
                                    <div class="form-floating mb-5">
                                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                    </div>
                                    <div class="row mb-5 d-flex justify-content-center">
                                        <div class="col-10 d-grid gap-2">
                                            <button class="btn btn-danger">Log In</button>
                                        </div>
                                    </div>
                                    <div class="row mb-5 d-flex justify-content-between">
                                        <div class="col-6">
                                            <a href="">Reset Password</a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="">Register</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
     
</body>
</html> --}}

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('dashboard.login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
