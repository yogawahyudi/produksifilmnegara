@extends('assets.master_assets')

@section('content')
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
                <form action="{{route('store.pertanyaan')}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="">Pertanyaan</label>
                        <input type="text" class="form-control" name="pertanyaan">
                    </div>
                    <div class="row mb-3">
                    <label for="">Kategori</label>    
                    <input type="text" class="form-control" name="label">
                    </div>
                    <div class="row mb-5">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection