@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Knowledge Base</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Knowledge Base</h1> 
@endsection


@section('content')
    <div class="container-fluid">
        @include('alert.alert')
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-6">
                <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#createKnowledge"><i class="bx bx-plus bx-fw"></i> Knowledge Base</button>
                <a type="button" href="{{route('index.respon')}}" class="btn btn-primary ms-3">Management Respon</a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="table-responsive m-3">
                    <table class="table table-striped table-light table-middle table-data">
                        <thead>
                            <tr>
                                <th class="text-center">Pattern</th>
                                <th class="text-center">Respon</th>
                                <th class="text-center">Label</th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($knowledge as $know)
                                <tr>
                                    <td class="text-center">{{$know->pattern}}</td>
                                    <td class="text-center">{{$know->respon}}</td>       
                                    <td class="text-center">{{$know->label}}</td>                                           
                                    <td class="text-center"><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editKnowledge{{$know->id}}"><i class='bx bx-edit bx-fw'></i></button></td>
                                    <td class="text-center">
                                        <form action="{{route('delete.knowledge', $know->id)}}" method="post">
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

<div class="modal fade" id="createKnowledge" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Knowledge</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{route('store.knowledge')}}" method="post">
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
                                    <label class="form-label" for="">Pattern</label>
                                    <input type="text" class="form-control" name="pattern" placeholder="Pattern">
                                </div>
                                <div class="row mb-3">
                                    <label class="form-label" for="">Respon</label>
                                    <input type="text" class="form-control" name="respon" placeholder="Respon">
                                </div>
                                <div class="row mb-3">
                                <label class="form-label" for="">Kategori</label>    
                                <input type="text" class="form-control" name="label" placeholder="Label">
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

@foreach ($knowledge as $know)
    <div class="modal fade" id="editKnowledge{{$know->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Knowledge</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{route('update.knowledge', $know->id)}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                                <div class="row mb-3">
                                    <label class="form-label" for="">Pattern</label>
                                    <input type="text" class="form-control" value="{{old('pattern', $know->pattern)}}" name="pattern" placeholder="Pattern">
                                </div>
                                <div class="row mb-3">
                                    <label class="form-label" for="">Respon</label>    
                                    <input type="text" class="form-control" value="{{old('respon', $know->respon)}}" name="respon" placeholder="Respon">
                                </div>
                                <div class="row mb-3">
                                    <label class="form-label" for="">Label</label>    
                                    <input type="text" class="form-control" value="{{old('label', $know->label)}}" name="label" placeholder="Label">
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