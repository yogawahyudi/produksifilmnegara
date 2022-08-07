@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Studio</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Studio</h1> 
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-6">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudio"><i class="bx bx-plus"></i> Studio</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-light align-middle table-data">
                        <thead>
                            <tr>
                                <td class="text-center">Studio</td>
                                <td class="text-center">Images</td>
                                <td class="text-center">Harga Setting</td>
                                <td class="text-center">Harga Shooting</td>
                                <td class="text-center">Overcharge Setting</td>
                                <td class="text-center">Overcharge Shooting</td>
                                <td class="text-center">Luas</td>
                                <td class="text-center">Tinggi</td>
                                <td class="text-center">Fasilitas</td>
                                <td class="no-sort"></td>
                                <td class="no-sort"></td>
                                <td class="no-sort"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;    
                            @endphp
                            @foreach ($studio as $td)
                                <tr>
                                    <td class="text-center">{{$td['studio']}}</td>
                                    {{-- pake carosel bos --}}
                                    
                                    <td>
                                        @if ($imgs[$i] !== null)
                                        <img src="{{asset('assets/images/studio/'.$imgs[$i++]->img)}}" alt="" srcset="" style="height: 200px; width: 200px; object-fit: contain"></td>
                                        @else
                                            
                                        @endif
                                    <td class="text-center">Rp.
                                    {{number_format($td['harga_setting'],2,',','.')}}
                                    </td>
                                    <td class="text-center">Rp.
                                    {{number_format($td['harga_shooting'],2,',','.')}}
                                    </td>
                                    <td class="text-center">Rp.
                                    {{number_format($td['overcharge_setting'],2,',','.')}}                                    
                                    </td>
                                    <td class="text-center">Rp.
                                    {{number_format($td['overcharge_shooting'],2,',','.')}}                                    
                                    </td>
                                    <td class="text-center">{{$td['luas']}} m2</td>
                                    <td class="text-center">{{$td['tinggi']}} m2</td>
                                    <td class="text-center">
                                        @php
                                            $fasilitas = explode(',', $td['fasilitas'])
                                        @endphp
                                            <ul>
                                                @foreach ($fasilitas as $fas)
                                                <li>{{$fas}}</li>
                                                @endforeach
                                            </ul>
                                    </td>
                                    <td class="text-center">
                                        <a type="button" href="{{route('index.imageStudio', $td->id)}}" class="btn btn-outline-primary">
                                            <i class='bx bx-image-add bx-fw'></i>
                                        </a>
                                    </td>                                   
                                    <td class="text-center"><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editStudi{{$td->id}}"><i class="bx bx-edit bx-fw"></i></button></td>
                                    <td class="text-center"><button class="btn btn-outline-danger"><i class="bx bx-trash bx-fw"></i></button></td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createStudio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-center">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Studio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3 d-flex justify-content-between">
                            <div class="col-5">
                                <div class="row mb-3">
                                    <label for="" class="label-form">Studio</label>
                                    <input type="text" class="form-control" name="studio">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Harga Setting</label>    
                                    <input type="text" class="form-control" name="harga_setting">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Harga Shooting</label>
                                    <input type="text" class="form-control" name="harga_shooting">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Harga Over Setting</label>
                                    <input type="text" class="form-control" name="overcharge_setting">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row mb-3">
                                    <label for="" class="label-form">Harga Over Shotting</label>                    
                                    <input type="text" class="form-control" name="overcharge_shooting">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Luas</label>
                                    <input type="text" class="form-control" name="luas">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Tinggi</label>
                                    <input type="text" class="form-control" name="tinggi">
                                </div>
                                <div class="row mb-5">
                                    <label for="" class="label-form">Fasilitas</label>
                                    <input type="text" class="form-control" name="fasilitas">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    @foreach ($studio as $st)
            <div class="modal fade" id="editStudi{{$st->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit {{$st->studio}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3 d-flex justify-content-between">
                            <div class="col-5">
                                <div class="row mb-3">
                                    <label for="" class="label-form">Studio</label>
                                    <input type="text" class="form-control" value="{{old('studio', $st->studio)}}" name="studio">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Harga Setting</label>    
                                    <input type="text" class="form-control" value="{{old('harga_setting', $st->harga_setting)}}" name="harga_setting">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Harga Shooting</label>
                                    <input type="text" class="form-control" value="{{old('harga_shooting', $st->harga_shooting)}}" name="harga_shooting">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Harga Over Setting</label>
                                    <input type="text" class="form-control" value="{{old('overcharge_setting', $st->overcharge_setting)}}" name="overcharge_setting">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row mb-3">
                                    <label for="" class="label-form">Harga Over Shotting</label>                    
                                    <input type="text" class="form-control" value="{{old('overcharge_shooting', $st->overcharge_shooting)}}" name="overcharge_shooting">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Luas</label>
                                    <input type="text" class="form-control" value="{{old('luas', $st->luas)}}" name="luas">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Tinggi</label>
                                    <input type="text" class="form-control" value="{{old('tinggi', $st->tinggi)}}" name="tinggi">
                                </div>
                                <div class="row mb-5">
                                    <label for="" class="label-form">Fasilitas</label>
                                    <input type="text" class="form-control" value="{{old('fasilitas', $st->fasilitas)}}" name="fasilitas">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endforeach

@endsection