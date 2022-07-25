
@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item">Transaksi</li>
    <li class="breadcrumb-item active" aria-current="page">View Transaksi</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">View Transaksi</h1> 
@endsection
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
                <a href="{{route('index.transaksi')}}" type="button" class="btn btn-link"><i class="bx bx-left-arrow-alt bx-md text-dark"></i></a>
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
    </div>

@endsection