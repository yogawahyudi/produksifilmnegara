       @extends('users.master_user')
       
        @section('content')
        <div class="row mb-5 d-flex align-items-center" style="min-height: calc(100vh - 100px)">
            <div class="col-12" id="studio-wrapper">
                @foreach ($studio as $st)
                    <div class="row mb-3">
                        <div class="col-12 mt-5">
                                <div class="card card-body">
                                    <div class="container-fluid">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-8">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div id="carousel{{$st->id}}" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner" style="max-height: 60vh">
                                                            @forelse ($st->studioImage as $key=>$img)
                                                            <div class="carousel-item 
                                                            @if($key == 0)
                                                            active
                                                            @endif
                                                            ">
                                                            <img src="{{asset('assets/images/studio/'.$img->img)}}" style="height: 100%; width: 100%; object-fit: cover" alt="..." >
                                                            </div>   
                                                            @empty                                                             
                                                            <div class="carousel-item active">
                                                            <img src="{{asset('assets/images/logo-pfn.png')}}" class="d-block w-100" alt="...">
                                                            </div>
                                                            @endforelse
                                                        </div>
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{$st->id}}" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$st->id}}" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </button>
                                                        </div>                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="row mb-5">
                                                    <div class="col-12">
                                                        <h1 class="text-center text-danger fw-bold">{{$st->studio}}</h1>
                                                    </div>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-12 text-center">
                                                        <a type="button" href="{{route('detail.studio.user', $st->id)}}" class="btn btn-danger">Detail Studio</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endsection