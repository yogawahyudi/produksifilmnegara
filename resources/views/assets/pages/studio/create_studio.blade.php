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
                <form action="{{route('store.studio')}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="">studio</label>
                        <input type="text" class="form-control" name="studio">
                    </div>
                    <div class="row mb-3">
                    <label for="">harga_setting</label>    
                    <input type="text" class="form-control" name="harga_setting">
                    </div>
                    <div class="row mb-3">
                    <label for="">harga_shooting</label>
                    <input type="text" class="form-control" name="harga_shooting">
                    </div>
                    <div class="row mb-3">
                    <label for="">over_setting</label>
                    <input type="text" class="form-control" name="overcharge_setting">
                    </div>
                    <div class="row mb-3">
                    <label for="">over_shotting</label>                    
                    <input type="text" class="form-control" name="overcharge_shooting">
                    </div>
                    <div class="row mb-3">
                    <label for="">luas</label>
                    <input type="text" class="form-control" name="luas">
                    </div>
                    <div class="row mb-3">
                    <label for="">tinggi</label>
                    <input type="text" class="form-control" name="tinggi">
                    </div>
                    <div class="row mb-5">
                    <label for="">fasilitas</label>
                    <input type="text" class="form-control" name="fasilitas">
                    </div>
                    <div class="row mb-5">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection