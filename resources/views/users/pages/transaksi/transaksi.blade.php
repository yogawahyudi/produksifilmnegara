

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
    <nav class="mt-5">
        <div class="nav nav-tabs" id="nav-tab" role="tablist" style="">
            <button class="nav-link text-dark fw-bold active" id="nav-transaction-tab" data-bs-toggle="tab" data-bs-target="#nav-transaction" type="button" role="tab" aria-controls="nav-transaction" aria-selected="true">Transaction</button>
            <button class="nav-link text-dark fw-bold" id="nav-tagihan-tab" data-bs-toggle="tab" data-bs-target="#nav-tagihan" type="button" role="tab" aria-controls="nav-tagihan" aria-selected="false">Tagihan</button>
            <button class="nav-link text-dark fw-bold" id="nav-selesai-tab" data-bs-toggle="tab" data-bs-target="#nav-selesai" type="button" role="tab" aria-controls="nav-selesai" aria-selected="false">Selesai</button>
            <button class="nav-link text-dark fw-bold" id="nav-cancel-tab" data-bs-toggle="tab" data-bs-target="#nav-cancel" type="button" role="tab" aria-controls="nav-cancel" aria-selected="false">Dibatalkan</button>

        </div>
    </nav>
    <div class="tab-content border border-top-0 rounded-bottom p-3 " id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-transaction" role="tabpanel" aria-labelledby="nav-transaction-tab">
            <div class="container-fluid">
                @forelse ($transaksi as $tran)
                                    @php
                                      foreach ($tran->transaksi_items as $item){
                                          $studio[] = $item->studio ;
                                          $tanggal[] = $item->tanggal;
                                      }
                                      $studio = array_unique($studio);
                                      $tanggal = array_unique($tanggal);

                                      foreach ($tran->tagihan as $item){
                                          $lunas[] = $item->lunas;
                                              $jenis[] = $item->jenis;
                                      }
                                      @endphp  
                    <div class="row mb-3 mt-3">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="form_pembayaran">
                            <div class="card card-body">
                                <div class="container-fluid mt-3 mb-3">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Studio :</h6>
                                      <ul>
                                          @foreach ($studio as $item)
                                          <li>{{$item}}</li>    
                                          @endforeach
                                          @php
                                          $studio = [];    
                                          @endphp
                                      </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Tanggal :</h6>
                                        <ul>
                                          @foreach ($tanggal as $item)
                                            <li>{{$item}}</li>    
                                          @endforeach
                                          @php
                                          $tanggal = [];    
                                          @endphp
                                      </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        @if (in_array(0, $lunas))
                                            @if  (in_array('pelunasan', $jenis))
                                            <h6>Status : <span class="badge bg-danger">Menunggu Pelunasan</span> </h6>                                          
                                            @else
                                            <h6>Status : <span class="badge bg-danger">Menunggu Pembayaran</span> </h6>
                                            @endif
                                        @else
                                            <h6>Status : <span class="badge bg-primary">Berlangsung</span> </h6>                                          
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 d-flex justify-content-between">
                                        <button class="btn btn-primary">Detail</button>
                                        @if (in_array(0, $lunas))
                                            <button class="btn btn-danger">Batalkan</button>
                                        @endif
                                          @php
                                          $lunas = [];    
                                            $jenis = [];    
                                          @endphp
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    
                @endforelse
            </div>
        </div>

        <div class="tab-pane fade" id="nav-tagihan" role="tabpanel" aria-labelledby="nav-tagihan-tab">
               <div class="container-fluid">
                <div class="col-12">
                    <div class="row mb-3 mt-3">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="form_pembayaran">
                            <div class="card card-body">
                                <div class="container-fluid mt-3 mb-3">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <div class="row">
                                            <h6> Tagihan : </h6>
                                        </div>
                                        <div class="row">
                                            <h6>Transaksi : </h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <div class="row">
                                            <h6>Jenis Tagihan : Pembayaran DP</h6>
                                        </div>
                                        <div class="row">
                                            <h6>Tagihan : Rp. 1.000.000 </h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Status : <span class="badge bg-danger">Menunggu Pembayaran</span> </h6>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 d-flex justify-content-between">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayar">Bayar Sekarang</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row mb-3 mt-3">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="form_pembayaran">
                            <div class="card card-body">
                                <div class="container-fluid mt-3 mb-3">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Studio : Studio 1</h6>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Tanggal : 22/08/2022</h6>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Status : <span class="badge bg-success">Selesai</span> </h6>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 d-flex justify-content-between">
                                        <button class="btn btn-primary">Detail</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="nav-cancel" role="tabpanel" aria-labelledby="nav-cancel-tab">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row mb-3 mt-3">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="form_pembayaran">
                            <div class="card card-body">
                                <div class="container-fluid mt-3 mb-3 text-black-50">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Studio : Studio 1</h6>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Tanggal : 22/08/2022</h6>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-lg-text-center">
                                        <h6>Status : <span class="badge bg-danger">Dibatalkan</span> </h6>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 d-flex justify-content-between">
                                        <button class="btn btn-primary">Detail</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bayar Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
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
                                         <table class="table table-hover align-middle">
                                            <tr>
                                                <td class="text-center">ID Transaksi</td>
                                                <td class="text-center">1</td>
                                                <td class="text-center">ID Tagihan</td>
                                                <td class="text-center">1</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Jenis Tagihan</td>
                                                <td class="text-center" >Pelunasan</td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Nama</td>
                                                <td class="text-center">Yoga</td>
                                                <td class="text-center">No Hp</td>
                                                <td class="text-center">082213462424</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Nominal</td>
                                                <td class="text-center" >Rp. 8.000.000</td>
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


@endsection