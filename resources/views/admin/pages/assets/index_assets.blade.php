@extends('admin.master_admin')


@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Assets</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Assets</h1> 
@endsection
       
@section('content')
        <div class="row mb-5 mt-5" style="min-height: 70vh">
            <div class="col-12">
                <div class="row mb-5">
                    <div class="col-12">
                        <button class="btn btn-primary" data-bs-target="#addAssets" data-bs-toggle="modal"><i class="bx bx-plus"></i> Assets</button>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($assets as $asset)
                                    <tr>
                                        <td>{{$asset->name}}</td>
                                        <td>{{$asset->email}}</td>
                                        <td>{{$asset->no_hp}}</td>
                                        <td>{{$asset->jabatan}}</td>
                                        <td><button class="btn btn-primary"><i class="bx bx-pencil" data-bs-toggle="modal" data-bs-target="#edit{{$asset->id}}"></i></button></td>
                                        <td><button class="btn btn-danger"><i class="bx bx-trash"></i></button></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Belum ada asset</td>
                                    </tr> 
                                @endforelse                                
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>

        @forelse ($assets as $asset)
            <div class="modal fade" id="edit{{$asset->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-center">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Manager</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('update.admin.assets', $asset->id)}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row mb-3 d-flex justify-content-center">
                                    <div class="col-10">
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Nama</label>
                                            <input type="text" name="name"  value="{{old('name', $asset->name)}}" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" name="email" value="{{old('email', $asset->email)}}" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">No Hp</label>
                                            <input type="text" name="no_hp" value="{{old('no_hp', $asset->no_hp)}}" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Jabatan</label>
                                            <input type="text" name="jabatan" value="{{old('jabatan', $asset->jabatan)}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="saveImages">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        @empty
            
        @endforelse

        <div class="modal fade" id="addAssets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-center">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Manager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('store.admin.assets')}}" method="post">
                    @csrf
                     <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row mb-3 d-flex justify-content-center">
                                    <div class="col-10">
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Nama</label>
                                            <input type="text" name="name" value="" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" name="email" value="" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">No Hp</label>
                                            <input type="text" name="no_hp" value="" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Jabatan</label>
                                            <input type="text" name="jabatan" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveImages">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
@endsection