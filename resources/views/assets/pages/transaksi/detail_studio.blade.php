

@extends('assets.master_assets')
       
@section('content')
<div class="container-fluid mt-5">
    <div class="row mb-3">
        <div class="col-12">
            <a type="button" class="btn btn-link" href="{{route('user.studio')}}"><i class="bx bx-left-arrow-alt bx-lg text-danger"></i></a>
            <h1 class="text-danger text-center">{{Str::upper($studio->studio)}}</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card card-body">
                <div class="container-fluid mt-3 mb-3">
                    <div class="row mb-5">
                        <div class="col-10">
                            <div id="carosel{{$studio->id}}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" style="max-height: 60vh">
                                                            @forelse ($studio->studioImage as $key=>$img)
                                                            <div class="carousel-item 
                                                            @if($key == 0)
                                                            active
                                                            @endif
                                                            ">
                                                            <img src="{{asset('assets/images/studio/'.$img->img)}}" class="d-block w-100" alt="...">
                                                            </div>   
                                                            @empty                                                             
                                                            <div class="carousel-item active">
                                                            <img src="{{asset('assets/images/logo-pfn.png')}}" class="d-block w-100" alt="...">
                                                            </div>
                                                            @endforelse
                                                        </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carosel{{$studio->id}}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carosel{{$studio->id}}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                </div>   
                        </div>
                        <div class="col-2">

                            @forelse ($studio->studioImage as $item)
                            <div class="row mb-3">
                                <div class="col-12 rounded">
                                    <a href="{{asset('assets/images/studio/'.$item->img)}}">
                                        <img src="{{asset('assets/images/studio/'.$item->img)}}" class="d-block w-100 rounded" alt="...">
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="row mb-3">
                                <div class="col-12 rounded">
                                    <a href="{{asset('assets/images/logo-pfn.png')}}">
                                        <img src="{{asset('assets/images/logo-pfn.png')}}" class="d-block w-100 rounded" alt="...">
                                    </a>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-6 border-end border-danger border-3">
                                        <div class="row">
                                            <h3 class="text-muted">Luas</h3>
                                            <p>Panjang x lebar : {{$studio->luas}} m2</p>
                                            <p>Tinggi : {{$studio->tinggi}} m2</p>
                                        </div>
                                        <div class="row">
                                            <h3 class="text-muted">Fasilitas</h3>
                                            @php
                                            $fasilitas = explode(',', $studio->fasilitas);
                                            @endphp
                                            @foreach ($fasilitas as $fas)
                                            <div class="col-6">
                                                <p>{{$fas}}</p>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-6 border-start border-danger border-3">
                                        <div class="row mb-3">
                                            <h3 class="text-muted">Harga</h3>
                                            <p>Shooting : Rp. {{number_format($studio->harga_shooting,2,',','.')}}</p>
                                            <p>Setting : Rp. {{number_format($studio->harga_setting,2,',','.')}}</p>
                                            <p>Overcharge Shooting : Rp. {{number_format($studio->overcharge_shooting,2,',','.')}}</p>
                                            <p>Overcharge Setting : Rp. {{number_format($studio->overcharge_setting,2,',','.')}}</p>
                                        </div>
                                        <div class="row mb-5 mt-5 d-flex justify-content-center">
                                            <div class="col-6">
                                                <a href="{{route('order.studio.user', $studio->id)}}" class="btn btn-danger">Pesan Sekarang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection