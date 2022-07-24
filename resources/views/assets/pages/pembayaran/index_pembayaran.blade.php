@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Pembayaran</h1> 
@endsection

@section('content')
    <div class="container-fluid">
        @include('alert.alert')
       <div class="row mb-5 mt-5">
            <div class="col-12">
                <button class="btn btn-primary" id="s">Semua Pembayaran</button>
                <button class="btn btn-danger" id="bk">Butuh Konfirmasi</button>
            </div>
       </div>
       <div class="row" id="s">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nama Perusahaan</th>
                            <th>No Hp</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jenis Tagihan</th>
                            <th>Verified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Yoga</td>
                            <td>Dxcode</td>
                            <td>082213462424</td>
                            <td>22-08-2022</td>
                            <td><span class="badge bg-primary">DP<span></td>
                            <td><i class="bx bx-checkbox-checked bx-md text-primary">
                                <p class="d-none">1</p>
                            </td>
                            <td>
                                <button class="btn btn-link">
                                    <i class="bx bx-show-alt bx-fw text-primary"></i></td>
                                </button>
                        </tr>
                          <tr>
                            <td>Yoga</td>
                            <td>Dxcode</td>
                            <td>082213462424</td>
                            <td>22-10-2022</td>
                            <td><span class="badge bg-success">Pelunasan</span></td>
                            <td><i class="bx bx-checkbox text-danger bx-md"></i>
                            <p class="d-none">0</p>
                            </td>
                            <td>
                                <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#verifPembayaran">
                                    <i class="bx bx-show-alt bx-fw text-primary"></i></td>
                                </button>
                        </tr>
                    </tbody>
                </table>
            </div>
       </div>
        <div class="row d-none" id="bk">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nama Perusahaan</th>
                            <th>No Hp</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jenis Tagihan</th>
                            <th>Verified</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                          <tr>
                            <td>Yoga</td>
                            <td>Dxcode</td>
                            <td>082213462424</td>
                            <td>22-10-2022</td>
                            <td><span class="badge bg-success">Pelunasan</span></td>
                            <td><i class="bx bx-checkbox text-danger bx-md"></i>
                            <p class="d-none">0</p>
                            </td>
                            <td>
                                <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#verifPembayaran">
                                    <i class="bx bx-show-alt bx-fw text-primary"></i></td>
                                </button>
                        </tr>
                    </tbody>
                </table>
            </div>
       </div>
    </div>

    <div class="modal fade" id="verifPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row mb-3 d-flex justify-content-center">
                <div class="col-10">
                    <div class="row mb-3">
                        <div class="text-center">
                            <img class="d-block w-100 mb-3" alt="Bukti Transfer">'
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <tr>
                                <td class="text-center">ID Transaksi</td>
                                <td class="text-center">1</td>
                                <td class="text-center">ID Tagihan</td>
                                <td class="text-center">1</td>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <td class="text-center">Jenis Tagihan</td>
                                <td class="text-center">Pelunasan</td>
                                <td class="text-center">Tanggal Pembayaran</td>
                                <td class="text-center">22-08-2022</td>
                            </tr>
                            <tr>
                                <td class="text-center">Nama</td>
                                <td class="text-center">Yoga</td>
                                <td class="text-center">No Hp</td>
                                <td class="text-center">082213462424</td>
                            </tr>
                            <tr>
                                <td class="text-center">Nominal</td>
                                <td class="text-center" colspan="3">Rp. 8.000.000</td>
                            </tr>
                        </table>
                        <span class="text-danger">* Pastikan Nominal sudah sesuai dengan yang ada di bukti Transfer</span>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Verifikasi</button>
      </div>
    </div>
  </div>
</div>

    <script>
        $('document').ready(()=>{
            $('button#s').on('click', ()=>{
                $('div#s').removeClass('d-none');
                $('div#bk').addClass('d-none');
            })
          $('button#bk').on('click', ()=>{
                $('div#s').addClass('d-none');
                $('div#bk').removeClass('d-none');
            })  
        })
    </script>
@endsection