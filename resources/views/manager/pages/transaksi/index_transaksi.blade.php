@extends('manager.master_manager')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Transaksi</h1> 
@endsection

@section('content')
    <div class="container-fluid">
        @include('alert.alert')
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
@endsection