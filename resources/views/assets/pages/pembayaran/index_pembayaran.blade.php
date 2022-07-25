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
                        @forelse ($pembayaran as $pem)
                        <tr>
                            <td>{{$pem->tagihan->transaksi->nama}}</td>
                            <td>{{$pem->tagihan->transaksi->nama_per}}</td>
                            <td>{{$pem->tagihan->transaksi->no_hp}}</td>
                            <td>{{$pem->created_at}}</td>
                            <td><span class="badge bg-primary">{{$pem->tagihan->jenis}}<span></td>
                            @if ($pem->verified == 1)
                            <td><i class="bx bx-checkbox-checked bx-md text-primary">
                                <p class="d-none">1</p>
                            </td>
                            @else
                                <td><i class="bx bx-checkbox bx-md text-danger">
                                <p class="d-none">0</p>
                            </td>
                            @endif
                            <td>
                                <button class="btn btn-link"  data-bs-target="#verifPembayaran{{$pem->id}}" data-bs-toggle="modal">
                                    <i class="bx bx-show-alt bx-fw text-primary"></i></td>
                                </button>
                        </tr>
                        @empty
                            
                        @endforelse
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
                        @forelse ($pembayaran as $pem)
                        @if ($pem->verified == 0)
                        <tr>
                            <td>{{$pem->tagihan->transaksi->nama}}</td>
                            <td>{{$pem->tagihan->transaksi->nama_per}}</td>
                            <td>{{$pem->tagihan->transaksi->no_hp}}</td>
                            <td>{{$pem->created_at}}</td>
                            <td><span class="badge bg-primary">{{$pem->tagihan->jenis}}<span></td>
                            @if ($pem->verified == 1)
                            <td><i class="bx bx-checkbox-checked bx-md text-primary">
                                <p class="d-none">1</p>
                            </td>
                            @else
                                <td><i class="bx bx-checkbox bx-md text-danger">
                                <p class="d-none">0</p>
                            </td>
                            @endif
                            <td>
                                <button class="btn btn-link" data-bs-target="#verifPembayaran{{$pem->id}}" data-bs-toggle="modal">
                                    <i class="bx bx-show-alt bx-fw text-primary"></i></td>
                                </button>
                        </tr>
                        @else
                            
                        @endif
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
       </div>
    </div>
                        @forelse ($pembayaran as $pem)
                        @if ($pem->verified == 0)
                        <div class="modal fade" id="verifPembayaran{{$pem->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('verif.assets.pembayaran' , $pem->id)}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row mb-3 d-flex justify-content-center">
                                                <div class="col-10">
                                                    <div class="row mb-3">
                                                        <div class="text-center">
                                                            <img class="d-block w-100 mb-3" src="{{asset('assets/images/bukti-transfer/'.$pem->bukti_img)}}" alt="Bukti Transfer">'
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <td colspan="2" class="text-center">ID Transaksi</td>
                                                                <td colspan="2" class="text-center">{{$pem->tagihan->transaksi->id}}</td>
                                                            </tr>
                                                            <tr>                                                                
                                                                <td colspan="2" class="text-center">ID Tagihan</td>
                                                                <td colspan="2" class="text-center">{{$pem->tagihan->id}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center">ID Pembayaran</td>
                                                                <td colspan="2" class="text-center">{{$pem->id}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center">Jenis Tagihan</td>
                                                                <td class="text-center">{{$pem->tagihan->jenis}}</td>
                                                                <td class="text-center">Tanggal Pembayaran</td>
                                                                <td class="text-center">{{$pem->created_at}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center">Nama</td>
                                                                <td class="text-center">{{$pem->tagihan->transaksi->nama}}</td>
                                                                <td class="text-center">No Hp</td>
                                                                <td class="text-center">{{$pem->tagihan->transaksi->no_hp}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center">Nominal</td>
                                                                <td class="text-center" colspan="3">Rp.  {{number_format($pem->nominal,2,',','.')}}</td>
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
                                        <button type="submit" class="btn btn-primary" >Verifikasi</button> 
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        @else
                            
                        @endif
                        @empty
                        @endforelse


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