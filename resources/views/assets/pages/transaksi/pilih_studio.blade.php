       @extends('assets.master_assets')
       
        @section('content')
        <div class="row mb-5 d-flex align-items-center" style="min-height: calc(100vh - 100px)">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <select name="selectStudio" id="selectStudio" class="form-select">
                    <option value="">Piih Studio</option>
                    @foreach ($studio as $st)
                    <option value="{{$st->id}}">{{$st->studio}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center" id="pilih">
            </div>
        </div>
            <script>
        $('document').ready(()=>{
            $('#selectStudio').on('change', ()=> {
                studi = $('#selectStudio').val()
                console.log(studi)
                user = "{{$users}}"
                url = "{{route('formPemesanan.transaksi', ['params1','params2'])}}"
                newUrl = url.replace('params1', user).replace('params2', studi);

                $('div#pilih').append(
                '<a type="button" href="'+newUrl+'" class="btn btn-danger"><i class="bx bx-right-arrow-alt bx-md"></i></a>')
            })
        })
    </script>
        @endsection