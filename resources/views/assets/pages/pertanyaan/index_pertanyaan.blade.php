@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">List Pertanyaan</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">List Pertanyaan</h1> 
@endsection


@section('content')
    <div class="container-fluid">
        @include('alert.alert')
        <div class="row mb-3">
            <div class="col-6">
                <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#createPertanyaan"><i class="bx bx-plus bx-fw"></i> List Pertanyaan</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="table-responsive m-3">
                    <table class="table table-striped table-light table-middle table-data">
                        <thead>
                            <tr>
                                <th class="text-center">Pertanyaan</th>
                                <th class="text-center">Label</th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no =1;    
                            @endphp
                            @foreach ($pertanyaan as $per)
                                <tr>
                                    <td class="text-center">{{$per['pertanyaan']}}</td>
                                    <td class="text-center">{{$per['label']}}</td>       
                                    <td class="text-center"><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editPertanyaan{{$per['id']}}"><i class='bx bx-edit bx-fw'></i></button></td>
                                    <td class="text-center">
                                        <form action="{{route('delete.pertanyaan', $per['id'])}}" method="post">
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

<div class="modal fade" id="createPertanyaan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Pertanyaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{route('store.pertanyaan')}}" method="post">
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
                                    <label class="form-label" for="">Pertanyaan</label>
                                    <input type="text" class="form-control" name="pertanyaan" placeholder="Pertanyaan">
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

@foreach ($pertanyaan as $per)
    <div class="modal fade" id="editPertanyaan{{$per['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Pertanyaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="{{route('update.pertanyaan', $per['id'])}}" method="post">
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
                                    <label class="form-label" for="">Pertanyaan</label>
                                    <input type="text" class="form-control" value="{{old('pertanyaan', $per['pertanyaan'])}}" name="pertanyaan" placeholder="Pertanyaan">
                                </div>
                                <div class="row mb-3">
                                <label class="form-label" for="">Kategori</label>    
                                <input type="text" class="form-control" value="{{old('label', $per['label'])}}" name="label" placeholder="Label">
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