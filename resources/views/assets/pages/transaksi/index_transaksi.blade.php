@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Transaksi</h1> 
@endsection

@section('content')
    <div class="container-fluid">
        @include('alert.alert')
       <div class="row mb-5 mt-5">
            <div class="col-12">
                <a href="{{route('create.transaksi')}}" type="button" class="btn btn-danger"><i class="bx bx-plus"></i>Transaksi</a>
            </div>
       </div>
       
       <div class="row">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nama Perusahaan</th>
                            <th>No Hp</th>
                            <th>Tanggal &nbsp; &nbsp; </th>
                            <th>Studio</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
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
                        <tr>
                            <td>{{$tran->nama}}</td>
                            <td>{{$tran->nama_per}}</td>
                            <td>{{$tran->no_hp}}</td>
                            <td>
                                <ul>
                                    @foreach ($tanggal as $item)
                                        <li>{{$item}}</li>    
                                    @endforeach
                                    @php
                                        $tanggal = [];    
                                    @endphp
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach ($studio as $item)
                                        <li>{{$item}}</li>    
                                    @endforeach
                                    @php
                                        $studio = [];    
                                    @endphp
                                </ul>
                            </td>                            
                            <td>
                                @if (in_array(0, $lunas))
                                    @if  (in_array('pelunasan', $jenis))
                                        <h6>Status : <span class="badge bg-danger">Menunggu Pelunasan</span> </h6>                                          
                                    @else
                                        <h6>Status : <span class="badge bg-danger">Menunggu Pembayaran</span> </h6>
                                    @endif
                                @else
                                    @if ($tran->status_tran == "dibatalkan")
                                    <h6>Status : <span class="badge bg-danger">Dibatalkan</span> </h6>                                          
                                    @elseif($tran->status_tran == "selesai")
                                    <h6>Status : <span class="badge bg-success">Selesai</span> </h6>                                                                                  
                                    @else
                                    <h6>Status : <span class="badge bg-primary">Berlangsung</span> </h6>                                                                                                                      
                                    @endif
                                @endif                            
                            </td>
                            <td>
                                 <a class="btn btn-link" href="{{route('view.transaksi', $tran->id)}}"><i class="bx bx-show-alt bx-fw text-primary"></i></a>
                            </td>
                            <td>
                                @if ($tran->status_tran != 'selesai')
                                    @if  (in_array('pelunasan', $jenis) and in_array(1, $lunas) and !in_array('extends', $jenis))
                                    <a type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#extends">Extends</a>
                                    <form action="{{route('selesai.transaksi.assets', $tran->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success" >Selesai</button>
                                    </form>
                                    @endif
                                    @if  (in_array('extends', $jenis) and !in_array(0, $lunas))
                                    <form action="{{route('selesai.transaksi.assets', $tran->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success" >Selesai</button>
                                </form>
                                    @endif
                                    @if (in_array(0, $lunas))
                                    <a class="btn btn-link" href="{{route('cancel.transaksi.assets', $tran->id)}}"><i class="bx bx-x-circle bx-fw text-danger"></i></a>
                                    @endif
                                @endif
                                 

                                    @php
                                    $lunas = [];    
                                    $jenis = [];    
                                @endphp
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <th colspan="8" class="text-center">Belum ada transaksi</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
       </div>
    </div>
    @if ($transaksi->isNotEmpty())    
    <div class="modal fade" id="extends" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-center">
         <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Perpanjang</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="{{route('extends.transaksi.assets', $tran->id)}}" method="post">
             @csrf
             <div class="modal-body">
                 <div class="container-fluid">
                     <div class="row mb-3 d-flex justify-content-center">
                        <div class="col-10">
                             <div class="row">
                             <div class="input-group mb-3">
                                 <span for="" class="input-group-text">Durasi</span>
                                 <input type="number" name="durasi" class="form-control" value="1" min="1" step="1">
                                 <span class="input-group-text" id="basic-addon2">Jam</span>
                             </div>
                         </div>
                        </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-primary">Simpan</button>
             </div>
         </form>
         </div>
     </div>
    </div>
    @endif
@endsection