
@extends('users.master_user')

@section('content')
<style>
    .nav-tabs {
flex-wrap: nowrap !important;
overflow-x: overlay !important;
overflow-y:hidden;
    }
    .dropzone-wrapper {
  border: 2px dashed #91b0b3;
  color: #92b0b3;
  position: relative;
  height: 150px;
}
.dropzone-desc {
  position: absolute;
  margin: 0 auto;
  left: 0;
  right: 0;
  text-align: center;
  width: 40%;
  top: 50px;
  font-size: 16px;
}
.dropzone,
.dropzone-edit,
.dropzone:focus,
.dropzone-edit:focus {
  position: absolute;
  outline: none !important;
  width: 100%;
  height: 150px;
  cursor: pointer;
  opacity: 0;
}

.dropzone-wrapper:hover,
.dropzone-wrapper.dragover {
  background: #ecf0f5;
}
</style>
    <div class="container-fluid">
        @include('alert.alert')
       <div class="row mb-5 mt-5">
            <div class="col-12">
                <a href="{{route('index.transaksi.user')}}" type="button" class="btn btn-link"><i class="bx bx-left-arrow-alt bx-md text-dark"></i></a>
            </div>
       </div>
       <div class="row mb-3 border-bottom border-2 border-secondary">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-6">
                        <p>Nama</p>
                        <p>Email</p>
                        <p>No Hp</p>
                    </div>
                    <div class="col-6">
                        <p>: {{$transaksi->nama}}</p>
                        <p>: {{$transaksi->email}}</p>
                        <p>: {{$transaksi->no_hp}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="row">
                    <div class="col-6">
                        <p>Nama Perusahaan</p>
                        <p>Email Perusahaan</p>
                        <p>No Hp Perusahaan</p>
                    </div>
                    <div class="col-6">
                        <p>: {{$transaksi->nama_per}}</p>
                        <p>: {{$transaksi->email_per}}</p>
                        <p>: {{$transaksi->no_hp_per}}</p>
                    </div>
                </div>
            </div>
       </div>

       @foreach ($transaksi->transaksi_items as $item)
       <div class="row p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="table-dark" colspan="4">
                        Items
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start">Studio</td>
                    <td class="text-center">{{$item->studio}}</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="text-start">Tanggal</td>
                    <td class="text-center">{{$item->tanggal}}</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="text-start">Durasi shooting</td>
                    <td class="text-center" >{{( $item->durasi_shooting - ($item->durasi_shooting % 12))}} Jam</td>
                    <td class="text-center">{{($item->durasi_shooting % 12)}} Jam</td>
                    <td class="text-center"></td>
                </tr> 
                <tr>
                    <td class="text-start">Durasi Setting</td>
                  <td class="text-center" >{{( $item->durasi_setting - ($item->durasi_setting % 12))}} Jam</td>
                    <td class="text-center">{{($item->durasi_setting % 12)}} Jam</td>
                    <td class="text-center"></td>
                </tr>
                <tr>
                    <td class="text-start">Harga Shooting / 12 Jam</td>
                    <td class="text-center">Rp. {{number_format($item->harga_shooting,2,',','.')}}</td>
                    <td class="text-center"> x {{( $item->durasi_shooting - ($item->durasi_shooting % 12)) /12}}</td>
                    <td class="text-center">Rp. {{number_format((( $item->durasi_shooting - ($item->durasi_shooting % 12)) /12) * $item->harga_shooting, 2,',','.')}}</td>
                </tr>
                <tr>
                    <td class="text-start">Harga Setting / 12 Jam</td>
                    <td class="text-center">Rp. {{number_format($item->harga_setting,2,',','.')}}</td>
                    <td class="text-center"> x {{( $item->durasi_setting - ($item->durasi_setting % 12)) /12}}</td>
                    <td class="text-center">Rp. {{number_format((( $item->durasi_setting - ($item->durasi_setting % 12)) /12) * $item->harga_setting,2,',','.')}}</td>
                </tr>
                <tr>
                    <td class="text-start">Harga Overcharge Shooting / Jam</td>
                    <td class="text-center">Rp. {{number_format($item->overcharge_shooting,2,',','.')}}</td>
                    <td class="text-center"> x {{$item->durasi_shooting % 12}}</td>
                    <td class="text-center">Rp. {{number_format(($item->durasi_shooting % 12) * $item->overcharge_shooting,2,',','.')}}</td>
                </tr>
                <tr>
                    <td class="text-start">Harga Overcharge Setting / Jam</td>
                    <td class="text-center">Rp. {{number_format($item->overcharge_shooting,2,',','.')}}</td>
                    <td class="text-center"> x {{$item->durasi_setting % 12}}</td>
                    <td class="text-center">Rp. {{number_format(($item->durasi_setting % 12) * $item->overcharge_shooting,2,',','.')}}</td>
                </tr>
            </tbody>
            <tfoot class="bg-dark text-white">
                <tr>
                    <td class="text-start" colspan="3">Subtotal</td>
                    <td class="tetxt-center">
                        Rp. {{number_format(((( $item->durasi_shooting - ($item->durasi_shooting % 12)) /12) * $item->harga_shooting) + ((( $item->durasi_setting - ($item->durasi_setting % 12)) /12) * $item->harga_setting) + (($item->durasi_shooting % 12) * $item->overcharge_shooting) + (($item->durasi_setting % 12) * $item->overcharge_shooting),2,',','.')}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
   
       @endforeach
        <div class="row">
        <div class="col-12">
            @foreach ($transaksi->tagihan as $item)
            @if ($item->lunas == 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="table-dark" colspan="2">Tagihan yang belum dibayarkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                ID Tagihan
                            </td>
                            <td>
                                {{$item->id}}
                            </td>
                        </tr>
                         <tr>
                            <td>
                                Transaksi ID
                            </td>
                            <td>
                                {{$item->transaksi_id}}
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Tagihan</td>
                            <td>{{$item->jenis}}</td>
                        </tr>
                        <tr>
                            <td>Nominal</td>
                            <td>Rp. {{number_format($item->nominal,2,',','.')}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center table-dark" colspan="2">
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="text-center mt-3 mb-5">
                    @if ($item->pembayaran !== null AND $item->pembayaran->verified == 0)
                    <Button class="btn btn-primary p-3"><i class="bx bx-loader-alt bx-spin bx-md mb-3"></i> <br> Pembayaran Sedang dalam proses verifikasi</Button>                        
                    @else
                    <Button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayar{{$item->id}}">Bayar Tagihan</Button>
                    @endif
                </div>
                
            </div>                
            @else
                
            @endif
            @endforeach
        </div>
        <div class="col-6">
            
        </div>
    </div>
</div>
     @foreach ($transaksi->tagihan as $item)
            @if ($item->lunas == 0)
    <div class="modal fade" id="bayar{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bayar Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('store.pembayaran.user',$item->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3 d-flex justify-content-center">
                        <div class="col-10">
                            <div class="row mb-3">
                                <div class="images-preview-div text-center"> </div>
                            </div>
                                <div class="row mb-3">
                                    <div class="dropzone-wrapper">
                                        <div class="dropzone-desc">
                                            <i class="bx bx-download"></i>
                                            <p>Choose an image file or drag it here.</p>
                                        </div>
                                        <input type="file" name="images" type="image" class="dropzone">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped align-middle">
                                            <tr>
                                                <td class="text-center">ID Transaksi</td>
                                                <td class="text-center">{{$item->id}}</td>
                                                <td class="text-center">ID Tagihan</td>
                                                <td class="text-center">{{$item->transaksi_id}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Jenis Tagihan</td>
                                                <td class="text-center" >{{$item->jenis}}</td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Nama</td>
                                                <td class="text-center">{{$transaksi->nama}}</td>
                                                <td class="text-center">No Hp</td>
                                                <td class="text-center">{{$transaksi->no_hp}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Nominal</td>
                                                <td class="text-center" > Rp. {{number_format($item->nominal,2,',','.')}}</td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" rowspan="2">Dibayarkan Ke : </td>
                                                <td class="text-center" >BCA 6241198160</td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">CIMB 703549022600</td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="text-danger">* Pastikan Nominal Sesuai Dengan Tagihan</span>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveImages">Upload</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <script >
$(function() {
// Multiple images preview with JavaScript
var previewImages = function(input, imgPreviewPlaceholder) {
if (input.files) {
var filesAmount = input.files.length;
if(filesAmount <= 5){
    for (i = 0; i < filesAmount; i++) {
    var reader = new FileReader();
    reader.onload = function(event) {
    $($.parseHTML('<img class="img-preview d-block w-100 mb-3">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
    }
    reader.readAsDataURL(input.files[i]);
    }
} else{
    $($.parseHTML(
            '<div class="row mb-3 fixed-bottom d-flex justify-content-end" id="alert-wrapper">'+
            '<div class="col-4">'+
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                    '<strong>Max 5 file</strong>'+
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                '</div>'+
            '</div>'+
        '</div>'
    )).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);  
     const alert = document.getElementById('alert-wrapper')
            setTimeout(hideElement, 5000) //milliseconds until timeout//
            function hideElement() {
                alert.remove()
            }  

    $('#saveImages').addClass('disabled')
    $('.img-preview').remove()
    $('.droppzone').value(null)
}
}
};
$('.dropzone').on('change', function() {
        $('.img-preview').remove()
previewImages(this, 'div.images-preview-div');
});
$('.dropzone-edit').on('change', function() {
        $('.img-preview').remove()
previewImages(this, 'div.images-preview-div-edit');
});
});
</script>
@endsection