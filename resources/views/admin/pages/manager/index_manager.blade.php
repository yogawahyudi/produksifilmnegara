@extends('admin.master_admin')


@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Manager</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Manager</h1> 
@endsection
       
@section('content')
        <div class="row mb-5 mt-5" style="min-height: 70vh">
            <div class="col-12">
                <div class="row mb-5">
                    <div class="col-12">
                        <button class="btn btn-primary" data-bs-target="#addManager" data-bs-toggle="modal"><i class="bx bx-plus"></i> Manager</button>
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
                                @forelse ($managers as $manager)
                                    <tr>
                                        <td>{{$manager->name}}</td>
                                        <td>{{$manager->email}}</td>
                                        <td>{{$manager->no_hp}}</td>
                                        <td>{{$manager->jabatan}}</td>
                                        <td><button class="btn btn-primary"><i class="bx bx-pencil" data-bs-toggle="modal" data-bs-target="#edit{{$manager->id}}"></i></button></td>
                                        <td><button class="btn btn-danger"><i class="bx bx-trash"></i></button></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Belum ada manager</td>
                                    </tr> 
                                @endforelse                                
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>

        @forelse ($managers as $manager)
            <div class="modal fade" id="edit{{$manager->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-center">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Manager</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('update.admin.manager' , $manager->id)}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row mb-3 d-flex justify-content-center">
                                    <div class="col-10">
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Nama</label>
                                            <input type="text" name="name"  value="{{old('name', $manager->name)}}" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" name="email" value="{{old('email', $manager->email)}}" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">No Hp</label>
                                            <input type="text" name="no_hp" value="{{old('no_hp', $manager->no_hp)}}" class="form-control">
                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="form-label">Jabatan</label>
                                            <input type="text" name="jabatan" value="{{old('jabatan', $manager->jabatan)}}" class="form-control">
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

        <div class="modal fade" id="addManager" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-center">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Manager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('store.admin.manager')}}" method="post">
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