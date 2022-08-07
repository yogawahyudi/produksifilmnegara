       @extends('users.master_user')
       
        @section('content')
            <div class="row d-flex align-items-center" style="min-height: calc(100vh - 100px)">
                <div class="col-12">
                    <div class="row  d-flex align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <img src="{{asset('assets/images/bg-login.jpg')}}" alt="" class="rounded" style="height: 50vh; width: 90%">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <h1>Penyewaan Studio <br>
                                Perum Produksi Film Negara
                                </h1>
                            </div>
                            <div class="row">
                                <p>
                                    Menyediakan studio yang luas <br>
                                    untuk kebutuhan syuting anda
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{route('user.studio')}}" class="btn btn-danger">Lihat Studio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection