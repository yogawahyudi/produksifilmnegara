@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Transaksi</h1> 
@endsection

@section('content')
    <div class="container-fluid">
        @include('alert.alert')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-5 mt-5 text-center">
                                <h1>SILAHKAN PILIH USER</h1>
                            </div>
                            <div class="row mb-5 d-flex align-items-center">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                                    <select name="user" id="selectUser" class="form-select">
                                        <option value="">Pilih User</option>
                                        @forelse ($users as $user)                                    
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center" id="pilih">
                                </div>
                            </div>
                            <div class="row mb-5">
                               <div class="col-12 text-center">
                                <h4>ATAU</h4>
                               </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-8 d-grid gap-2 mx-auto">
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createUser">Masukan User Baru</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-center">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Users Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('storeUser.transaksi')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3 d-flex justify-content-center">
                           <div class="col-10">
                                <div class="row mb-3">
                                    <label for="" class="label-form">Nama</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="label-form">No Hp</label>
                                    <input type="text" class="form-control" name="no_hp">
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>
        $('document').ready(()=>{
            $('#selectUser').on('change', ()=> {
                 $('div#pilih a').remove();
                param = $('#selectUser').val()
                url = "{{route('indexUser.transaksi', 'params')}}"
                newUrl = url.replace('params', param);

                $('div#pilih').append(
                '<a type="button" href="'+newUrl+'" class="btn btn-danger"><i class="bx bx-right-arrow-alt bx-md"></i></a>')
            })
        })
    </script>
@endsection