@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Management Respon</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Management Respon</h1> 
@endsection


@section('content')
    <div class="container-fluid">
        @include('alert.alert')
        <div class="row mb-3">
            <div class="col-6">
                <a href="{{route('index.knowledge')}}" class="me-5"><i class="bx bx-left-arrow-alt bx-lg" style="color: #000"></i></a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="table-responsive m-3">
                    <table class="table table-striped table-light table-middle table-data">
                        <thead>
                            <tr>
                                <th class="text-center">Respon</th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($respon as $res)
                                <tr>
                                    <td class="text-center">{{$res->respon}}</td>       
                                    <td class="text-center"><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editRespon{{$res->id}}"><i class='bx bx-edit bx-fw'></i></button></td>
                                    <td class="text-center">
                                        <form action="{{route('delete.respon', $res->id)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger"><i class='bx bx-trash bx-fw'></i></button>
                                        </form>
                                    </td>                             
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="createRespon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Respon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{route('store.respon')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                                <div class="row mb-3">
                                    <label class="form-label" for="">Respon</label>
                                    <input type="text" class="form-control" name="respon" placeholder="Respon">
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

@foreach ($respon as $res)
    <div class="modal fade" id="editRespon{{$res->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Respon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{route('update.respon', $res->id)}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-3">
                                <label class="form-label" for="">Respon</label>    
                                <input type="text" class="form-control" value="{{old('respon', $res->respon)}}" name="respon" placeholder="Respon">
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